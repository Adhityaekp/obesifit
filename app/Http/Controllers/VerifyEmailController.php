<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Auth\Events\Verified;

class VerifyEmailController extends Controller
{
    public function verify(Request $request, $id, $hash)
    {
        $user = \App\Models\User::find($id);

        if (!$user) {
            return redirect('/login')->with('error', 'User tidak ditemukan.');
        }

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect('/login')->with('error', 'Link verifikasi tidak valid.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect('/dashboard')->with('info', 'Email sudah terverifikasi.');
        }

        if ($user->markEmailAsVerified()) {
            event(new Verified($user));
        }

        // Aktifkan user setelah verifikasi email
        $user->update(['is_active' => true]);

        return redirect('/dashboard')->with('success', 'Email berhasil diverifikasi! Akun Anda sekarang aktif.');
    }
}