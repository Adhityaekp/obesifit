<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use App\Models\User;

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

            // Cek jika email sudah diverifikasi
            if (!$user->hasVerifiedEmail()) {
                $user->is_online = false; // set offline karena logout
                $user->save();

                Auth::logout();
                return back()->withErrors([
                    'email' => 'Email belum diverifikasi. Silakan cek email Anda untuk verifikasi.',
                ]);
            }

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

    // Proses register dokter
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

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => 'doctor',
            'specialization' => $request->specialization,
            'license_number' => $request->license_number,
            'is_active' => false, // menunggu konfirmasi admin
        ]);

        // Opsional: tidak perlu verifikasi email, tinggal redirect
        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Tunggu konfirmasi dari admin.');
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