<?php
// app/Http/Controllers/UserController.php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\EducationalVideo;
use App\Models\UserHealthProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{

    public function dashboard()
    {
        // Ambil 3 artikel terbaru
        $articles = \App\Models\Article::latest()->take(3)->get();

        // Ambil semua video untuk ditampilkan awal
        $videos = \App\Models\EducationalVideo::latest()->take(6)->get();

        // Ambil daftar kategori unik
        $categories = \App\Models\EducationalVideo::select('category')
            ->distinct()
            ->pluck('category')
            ->filter()
            ->values();

        // Kirim ke view 'home.blade.php'
        return view('home', compact('articles', 'videos', 'categories'));
    }

    public function __construct()
    {
        $this->middleware('auth');
        // Hanya admin yang bisa akses semua fitur kecuali profile
    }

    // Display all users
    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('users.index', compact('users'));
    }

    // Show user profile
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    // Update user profile
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Gunakan fill dan save untuk update
        $user->fill([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        if ($user->save()) {
            return redirect()->back()->with('success', 'Profil berhasil diperbarui!');
        }

        return redirect()->back()->with('error', 'Gagal memperbarui profil!');
    }

    // Show edit form
    // public function edit($id)
    // {
    //     $user = User::findOrFail($id);
    //     return view('users.edit', compact('user'));
    // }

    public function edit()
    {
        $user = Auth::user()->load('healthProfile', 'subscriptions'); // load relasi subscriptions juga
        $health = $user->healthProfile;

        // Ambil subscription aktif terakhir
        $activeSubscription = $user->subscriptions()
            ->where('status', 'active')
            ->where('end_date', '>', now())
            ->latest('end_date')
            ->first();

        // Ambil semua subscription untuk riwayat
        $subscriptions = $user->subscriptions()->orderByDesc('start_date')->get();

        return view('profile', compact('user', 'health', 'activeSubscription', 'subscriptions'));
    }

    // Update user
    public function update(Request $request)
    {
        $user = Auth::user();

        $rules = [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:20',
            'alamat' => 'nullable|string|max:255',
            'birth_date' => 'nullable|date',
        ];

        if ($user->isDoctor()) {
            $rules['license_number'] = 'required|string|max:255|unique:users,license_number,' . $user->id;
            $rules['specialization'] = 'required|string|max:255';
            $rules['practice_start_time'] = 'required|date_format:H:i';
            $rules['practice_end_time'] = 'required|date_format:H:i|after:practice_start_time';
            $rules['practice_days'] = 'required|string'; // bisa diubah jadi array validation jika ingin multiple select
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Update data
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->alamat = $request->alamat;
        $user->birth_date = $request->birth_date; // ✅ tambahkan ini

        if ($user->isDoctor()) {
            $user->license_number = $request->license_number;
            $user->specialization = $request->specialization;
            $user->practice_start_time = $request->practice_start_time;
            $user->practice_end_time = $request->practice_end_time;
            $user->practice_days = $request->practice_days;
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }

    public function updatePhoto(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'photo' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $path = $file->store('profile_photos', 'public');

            // Hapus foto lama jika ada
            if ($user->profile_photo && \Storage::exists('public/' . $user->profile_photo)) {
                \Storage::delete('public/' . $user->profile_photo);
            }

            $user->profile_photo = $path;
            $user->save();
        }

        return back()->with('success', 'Foto profil berhasil diperbarui!');
    }

    // Change password
    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required'],
            'new_password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Password lama tidak sesuai.']);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return back()->with('success', 'Password berhasil diperbarui.');
    }

    public function deleteAccount(Request $request)
    {
        $user = Auth::user();
        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Akun Anda telah dihapus permanen.');
    }


    public function editHealthProfile()
    {
        $user = Auth::user()->load('healthProfile');
        $health = $user->healthProfile;

        return view('user.health', compact('user', 'health'));
    }

    public function updateHealthProfile(Request $request)
    {
        $user = Auth::user();

        $validated = $request->validate([
            'height' => 'nullable|numeric|min:0',
            'weight' => 'nullable|numeric|min:0',
            'blood_type' => 'nullable|string|max:3',
            'blood_pressure' => 'nullable|string|max:10',
            'disease_history' => 'nullable|string',
            'allergies' => 'nullable|string',
            'target_weight' => 'nullable|numeric|min:0',
            'workout_frequency_per_week' => 'nullable|integer|min:0',
            'workout_progress' => 'nullable|numeric|min:0|max:100',
        ]);

        // Update atau create data kesehatan
        UserHealthProfile::updateOrCreate(
            ['user_id' => $user->id],
            $validated
        );

        return redirect()->back()->with('success', 'Data kesehatan berhasil diperbarui.');
    }

    public function suggestHealthTargets(Request $request)
    {
        $height = $request->input('height'); // cm
        $weight = $request->input('weight'); // kg
        $bloodPressure = $request->input('blood_pressure'); // e.g. 120/80

        if (!$height || !$weight) {
            return response()->json([
                'message' => 'Masukkan tinggi dan berat badan terlebih dahulu.',
            ], 400);
        }

        // hitung BMI
        $heightInMeters = $height / 100;
        $bmi = $weight / ($heightInMeters * $heightInMeters);

        // Tentukan target berat ideal
        $targetWeight = null;
        if ($bmi < 18.5) {
            $targetWeight = 18.5 * ($heightInMeters ** 2);
        } elseif ($bmi > 24.9) {
            $targetWeight = 24.9 * ($heightInMeters ** 2);
        } else {
            $targetWeight = $weight;
        }

        // Frekuensi olahraga berdasarkan BMI
        if ($bmi < 25) {
            $workout = 3;
        } elseif ($bmi < 30) {
            $workout = 4;
        } else {
            $workout = 5;
        }

        // Tekanan darah: jika tinggi, tambahkan saran
        $bpAdvice = '';
        if (preg_match('/(\d+)\/(\d+)/', $bloodPressure, $m)) {
            $systolic = (int) $m[1];
            $diastolic = (int) $m[2];
            if ($systolic > 130 || $diastolic > 80) {
                $bpAdvice = 'Perhatikan tekanan darah, kurangi garam dan perbanyak olahraga.';
            }
        }

        return response()->json([
            'target_weight' => round($targetWeight, 1),
            'workout_frequency_per_week' => $workout,
            'advice' => $bpAdvice,
            'bmi' => round($bmi, 1),
        ]);
    }

    // Show create user form (untuk admin)
    public function create()
    {
        return view('users.create');
    }

    public function doctor_menu()
    {
        return view('dokter.doctor-dashboard');
    }

    // Store new user (untuk admin)
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'phone' => 'nullable|string|max:15',
            'password' => 'required|min:8|confirmed',
            'role' => 'required|in:user,doctor,admin',
            'specialization' => 'nullable|string|max:255',
            'license_number' => 'nullable|string|unique:users',
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
            'role' => $request->role,
            'specialization' => $request->specialization,
            'license_number' => $request->license_number,
        ]);

        if ($user) {
            return redirect()->route('users.index')
                ->with('success', 'Pengguna berhasil ditambahkan!');
        }

        return redirect()->back()->with('error', 'Gagal menambahkan pengguna!');
    }

    public function getDoctors()
    {
        $doctors = User::where('role', 'doctor')
            ->where('is_active', true)
            ->select('id', 'first_name', 'last_name', 'specialization', 'profile_photo', 'practice_days', 'practice_start_time', 'practice_end_time', 'is_online')
            ->get();

        return response()->json($doctors);
    }

}