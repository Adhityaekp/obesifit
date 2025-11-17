<?php

namespace App\Http\Controllers;

use App\Models\ConsultationRequest;
use App\Models\Notification;
use Illuminate\Http\Request;

class ConsultationRequestController extends Controller
{
    // Pasien membuat request konsultasi
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'reason' => 'nullable|string',
        ]);

        // Buat consultation request
        $consultation = ConsultationRequest::create([
            'patient_id' => auth()->id(),
            'doctor_id' => $request->doctor_id,
            'reason' => $request->reason,
        ]);

        // Buat notifikasi untuk dokter
        Notification::create([
            'user_id' => $request->doctor_id,
            'title' => 'Request Konsultasi Baru',
            'message' => 'Anda memiliki request konsultasi baru dari pasien ' . auth()->user()->full_name,
            'type' => 'info',
            'is_read' => false,
        ]);

        return response()->json($consultation, 201);
    }

    // Dokter approve request
    public function approve($id)
    {
        $consultation = ConsultationRequest::findOrFail($id);
        $consultation->update([
            'status' => 'approved',
            'approved_at' => now(),
        ]);

        // Insert notifikasi
        Notification::create([
            'user_id' => $consultation->patient_id,
            'title' => 'Konsultasi Disetujui',
            'message' => 'Dokter telah menyetujui permintaan konsultasi Anda.',
            'type' => 'success',
            'is_read' => false,
        ]);

        return response()->json([
            'message' => 'Konsultasi disetujui',
            'consultation' => $consultation
        ]);
    }

    public function complete($id)
    {
        $consultation = ConsultationRequest::findOrFail($id);

        // Pastikan status harus approved dulu
        if ($consultation->status !== 'approved') {
            return response()->json([
                'message' => 'Konsultasi belum dapat diselesaikan'
            ], 400);
        }

        // Update status menjadi completed
        $consultation->update([
            'status' => 'complete',
            'completed_at' => now(),
        ]);

        // =============== INSERT NOTIFICATION ===============
        // Kirim notifikasi ke pasien bahwa konsultasi selesai
        Notification::create([
            'user_id' => $consultation->patient_id,
            'title' => 'Konsultasi Selesai',
            'message' => 'Dokter telah menyelesaikan sesi konsultasi Anda.',
            'type' => 'success',
            'is_read' => false,
        ]);
        // =====================================================

        return response()->json([
            'message' => 'Konsultasi berhasil diselesaikan',
            'consultation' => $consultation
        ]);
    }

    // Dokter reject request
    public function reject(Request $request, $id)
    {
        $consultation = ConsultationRequest::findOrFail($id);
        $consultation->update([
            'status' => 'rejected',
            'doctor_note' => $request->doctor_note ?? null,
        ]);

        // Insert notifikasi
        Notification::create([
            'user_id' => $consultation->patient_id,
            'title' => 'Konsultasi Ditolak',
            'message' => 'Dokter menolak permintaan konsultasi Anda.',
            'type' => 'warning',
            'is_read' => false,
        ]);

        return response()->json([
            'message' => 'Konsultasi ditolak',
            'consultation' => $consultation
        ]);
    }

    // List request untuk dokter
    public function doctorRequests()
    {
        // Ambil request konsultasi dokter yang login, status pending, urut terbaru
        $requests = ConsultationRequest::with('patient')
            ->where('doctor_id', auth()->id())
            ->where('status', 'pending') // hanya pending
            ->orderBy('created_at', 'desc')
            ->get();

        // Format response untuk frontend
        $data = $requests->map(function ($request) {
            return [
                'id' => $request->id,
                'patient_name' => $request->patient->full_name ?? 'Pasien tidak ditemukan',
                'patient_id' => $request->patient_id,
                'patient_avatar' => $request->patient->profile_photo
                    ? asset('storage/' . $request->patient->profile_photo)
                    : asset('img/default-user.jpg'),
                'request_date' => $request->created_at->format('d M Y - H:i') . ' WIB',
                'status' => $request->status, // pending
                'reason' => $request->reason,
                'doctor_note' => $request->doctor_note,
                'approved_at' => $request->approved_at,
            ];
        });

        return response()->json($data);
    }

    public function doctorApprovedRequests()
    {
        $requests = ConsultationRequest::with('patient')
            ->where('doctor_id', auth()->id())
            ->where('status', 'approved')
            ->orderBy('updated_at', 'desc')
            ->get();

        $data = $requests->map(function ($request) {
            return [
                'id' => $request->id,
                'patient_name' => $request->patient->full_name ?? 'Pasien tidak ditemukan',
                'patient_id' => $request->patient_id,
                'patient_avatar' => $request->patient->profile_photo
                    ? asset('storage/' . $request->patient->profile_photo)
                    : asset('img/default-user.jpg'),
                'approved_at' => $request->approved_at,
                'status' => $request->status,
            ];
        });

        return response()->json($data);
    }

    public function doctorHistoryRequests()
    {
        $requests = ConsultationRequest::with('patient')
            ->where('doctor_id', auth()->id())
            ->where('status', 'complete')
            ->orderBy('updated_at', 'desc')
            ->get();

        $data = $requests->map(function ($request) {
            return [
                'id' => $request->id,
                'patient_name' => $request->patient->full_name ?? 'Pasien tidak ditemukan',
                'patient_id' => $request->patient_id,
                'patient_avatar' => $request->patient->profile_photo
                    ? asset('storage/' . $request->patient->profile_photo)
                    : asset('img/default-user.jpg'),
                'completed_at' => $request->completed_at ?? $request->updated_at,
                'status' => $request->status,
            ];
        });

        return response()->json($data);
    }

    // List request untuk pasien
    public function patientRequests(Request $request)
    {
        $patientId = auth()->id();

        // Jika ada query parameter status=complete, ambil semua yang complete
        if ($request->query('status') === 'complete') {
            $requests = ConsultationRequest::with('doctor') // supaya data dokter bisa dipakai di frontend
                ->where('patient_id', $patientId)
                ->where('status', 'complete')
                ->latest('created_at')
                ->get();
        } else {
            // default: ambil request terbaru tiap doctor
            $requests = ConsultationRequest::where('patient_id', $patientId)
                ->latest('created_at')
                ->get()
                ->groupBy('doctor_id')
                ->map(fn($group) => $group->first())
                ->values();
        }

        return response()->json($requests);
    }
}
