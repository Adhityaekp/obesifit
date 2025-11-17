<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Subscription;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    public function create(Request $request)
    {
        $user = auth()->user();
        $package = $request->package;

        $plans = [
            'bulanan' => ['price' => 99000, 'duration_days' => 30],
            '3bulan' => ['price' => 249000, 'duration_days' => 90],
            'tahunan' => ['price' => 899000, 'duration_days' => 365],
        ];

        if (!isset($plans[$package])) {
            return response()->json(['message' => 'Paket tidak valid'], 400);
        }

        $plan = $plans[$package];
        $invoice = 'INV-' . strtoupper(uniqid());

        // Simpan ke DB
        $subscription = \App\Models\Subscription::create([
            'user_id' => $user->id,
            'plan_name' => ucfirst($package),
            'price' => $plan['price'],
            'duration_days' => $plan['duration_days'],
            'status' => 'pending',
            'invoice_number' => $invoice,
        ]);

        // Midtrans config
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $invoice,
                'gross_amount' => $plan['price'],
            ],
            'customer_details' => [
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($params);
            $subscription->update(['payment_token' => $snapToken]);

            return response()->json(['snapToken' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Gagal membuat Snap Token',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateStatus(Request $request)
    {
        $request->validate([
            'order_id' => 'required|string',
            'status' => 'required|string',
        ]);

        $subscription = Subscription::where('invoice_number', $request->order_id)->first();

        if (!$subscription) {
            return response()->json(['success' => false, 'message' => 'Subscription not found'], 404);
        }

        if ($request->status === 'active') {
            $subscription->update([
                'status' => 'active',
                'start_date' => now(),
                'end_date' => now()->addDays($subscription->duration_days),
            ]);
        } else {
            $subscription->update(['status' => $request->status]);
        }

        return response()->json(['success' => true]);
    }


    // Webhook untuk update status otomatis
    public function handleCallback(Request $request)
    {
        $serverKey = config('midtrans.serverKey');
        $hash = hash('sha512', $request->order_id . $request->status_code . $request->gross_amount . $serverKey);

        if ($hash === $request->signature_key) {
            $status = $request->transaction_status;

            $subscription = Subscription::where('invoice_number', $request->order_id)->first();
            if ($subscription) {
                if (in_array($status, ['capture', 'settlement'])) {
                    $subscription->status = 'active';
                } elseif ($status === 'expire') {
                    $subscription->status = 'expired';
                } elseif ($status === 'cancel') {
                    $subscription->status = 'cancelled';
                }
                $subscription->save();
            }
        }

        return response()->json(['success' => true]);
    }
}
