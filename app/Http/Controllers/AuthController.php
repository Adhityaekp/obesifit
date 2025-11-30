<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Models\User;
use App\Models\Notification;

class AuthController extends Controller
{
    // Tampilkan form login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Proses login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials, $request->remember)) {
            $request->session()->regenerate();

            $user = Auth::user();

            // Update is_online
            $user->is_online = true;
            $user->save();

            // ✅ Cek verifikasi email
            if (!$user->hasVerifiedEmail()) {

                // set offline + logout
                $user->is_online = false;
                $user->save();

                Auth::logout();

                return back()->withErrors([
                    'email' => 'Email belum diverifikasi. Silakan cek email Anda untuk verifikasi.',
                ]);
            }

            // ✅ Cek role admin → redirect ke admin dashboard
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // ✅ Selain admin → redirect default
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah',
        ]);
    }

    // Logout
    public function logout(Request $request)
    {
        $user = Auth::user();

        if ($user) {
            $user->is_online = false;
            $user->save();
        }

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }

    // Tampilkan form register dokter
    public function showDoctorRegisterForm()
    {
        return view('auth.register-doctor');
    }

    public function registerDoctor(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'specialization' => 'required|string|max:255',
            'license_number' => 'required|string|max:255',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required',
        ], [
            'terms.required' => 'Anda harus menyetujui Syarat & Ketentuan dan Kebijakan Privasi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // ✅ Create Doctor (status menunggu approval admin)
        $doctor = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'doctor',
            'specialization' => $request->specialization,
            'license_number' => $request->license_number,
            'is_active' => false,
        ]);


        // ✅ ✅ =============== INSERT NOTIFICATION ===============
        // Cari semua admin
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::create([
                'user_id' => $admin->id,
                'title' => 'Pengajuan Dokter Baru',
                'message' => 'Dokter ' . $doctor->first_name . ' ' . $doctor->last_name . ' mendaftar dan menunggu persetujuan Anda.',
                'type' => 'info',
                'is_read' => false,
            ]);
        }
        // ✅ =====================================================


        return redirect()->route('login')
            ->with('success', 'Pendaftaran berhasil! Tunggu konfirmasi dari admin.');
    }

    // Tampilkan form register
    public function showRegisterForm()
    {
        return view('auth.register-user');
    }

    // Proses register
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'terms' => 'required',
        ], [
            'terms.required' => 'Anda harus menyetujui Syarat & Ketentuan dan Kebijakan Privasi.',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'user',
            'specialization' => null,
            'license_number' => null,
            'is_active' => false,
        ]);

        // Trigger event untuk mengirim email verifikasi
        event(new Registered($user));

        // Login user sementara (opsional)
        auth()->login($user);

        return redirect('/email/verify')->with('success', 'Registrasi berhasil! Silakan verifikasi email Anda.');
    }

    // Tampilkan halaman verifikasi email
    public function showVerifyEmail()
    {
        return view('auth.verify-email');
    }

    // Resend email verifikasi
    public function resendVerificationEmail(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect('/dashboard');
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('success', 'Link verifikasi baru telah dikirim ke email Anda!');
    }
}