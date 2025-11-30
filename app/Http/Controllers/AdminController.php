<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Models\EducationalVideo;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $doctorCount = User::where('role', 'doctor')->count();
        $userCount = User::where('role', 'user')->count();
        $articleCount = Article::count();
        $videoCount = EducationalVideo::count();

        $pendingDoctors = User::where('role', 'doctor')
            ->where('is_active', false)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // ✅ Ambil filter
        $search = $request->input('search');
        $role = $request->input('role');
        $category = $request->input('category');

        // ✅ Query Users
        $users = User::query()
            ->whereIn('role', ['doctor', 'user'])
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                });
            })
            ->when($role, fn($q) => $q->where('role', $role))
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->appends(['tab' => 'users'])
            ->withQueryString();

        // ✅ Query Articles dengan creator
        $articles = Article::query()
            ->with('user') // Load relationship dengan user/creator
            ->when($category, fn($q) => $q->where('category', $category))
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->appends(['tab' => 'content'])
            ->withQueryString();

        // ✅ Query Videos dengan creator
        $videos = EducationalVideo::query()
            ->with('creator') // Load relationship dengan creator
            ->when($category, fn($q) => $q->where('category', $category))
            ->orderBy('created_at', 'desc')
            ->paginate(5)
            ->appends(['tab' => 'video'])
            ->withQueryString();

        return view('admin.dashboard', compact(
            'doctorCount',
            'userCount',
            'articleCount',
            'videoCount',
            'pendingDoctors',
            'users',
            'articles',
            'videos',
            'search',
            'role',
            'category'
        ));
    }

    public function verifyDoctor($id)
    {
        try {
            $doctor = User::where('role', 'doctor')->findOrFail($id);

            // Update status dokter
            $doctor->forceFill([
                'is_active' => true,
                'email_verified_at' => now(),
            ])->save();

            // Buat notifikasi untuk dokter
            Notification::create([
                'user_id' => $doctor->id,
                'title' => 'Akun Dokter Telah Diverifikasi',
                'message' => 'Selamat! Akun dokter Anda telah diverifikasi oleh admin. Sekarang Anda dapat login dan mulai menggunakan fitur dokter.',
                'type' => 'success',
                'is_read' => false,
            ]);

            return redirect()->back()
                ->with('success', 'Dokter ' . $doctor->first_name . ' ' . $doctor->last_name . ' berhasil diverifikasi!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal memverifikasi dokter: ' . $e->getMessage());
        }
    }

    public function rejectDoctor($id)
    {
        try {
            $doctor = User::where('role', 'doctor')->findOrFail($id);

            // Simpan data dokter untuk notifikasi sebelum dihapus
            $doctorName = $doctor->first_name . ' ' . $doctor->last_name;
            $doctorEmail = $doctor->email;

            // Hapus dokter dari database
            $doctor->delete();

            // Optional: Kirim email pemberitahuan penolakan
            // Mail::to($doctorEmail)->send(new DoctorRejectionMail($doctorName));

            return redirect()->back()
                ->with('success', 'Dokter ' . $doctorName . ' berhasil ditolak dan dihapus dari sistem.');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Gagal menolak dokter: ' . $e->getMessage());
        }
    }

    public function editUser($id)
    {
        try {
            $user = User::findOrFail($id);
            return response()->json([
                'success' => true,
                'user' => $user
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'User tidak ditemukan'
            ], 404);
        }
    }

    public function updateUser(Request $request, $id)
    {
        try {
            $user = User::findOrFail($id);

            $validator = Validator::make($request->all(), [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|email|unique:users,email,' . $id,
                'phone' => 'nullable|string|max:20',
                'role' => 'required|in:user,doctor,admin',
                'is_active' => 'required|boolean',
                'specialization' => 'nullable|string|max:255',
                'license_number' => 'nullable|string|max:255'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $user->update($request->all());

            return response()->json([
                'success' => true,
                'message' => 'User berhasil diupdate'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);

            // Prevent admin from deleting themselves
            if ($user->id === Auth::id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak dapat menghapus akun sendiri'
                ], 422);
            }

            $userName = $user->first_name . ' ' . $user->last_name;
            $user->delete();

            return response()->json([
                'success' => true,
                'message' => 'User ' . $userName . ' berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus user: ' . $e->getMessage()
            ], 500);
        }
    }

    public function changePassword(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required|string',
                'new_password' => 'required|string|min:8|confirmed',
            ], [
                'current_password.required' => 'Kata sandi saat ini wajib diisi',
                'new_password.required' => 'Kata sandi baru wajib diisi',
                'new_password.min' => 'Kata sandi baru minimal 8 karakter',
                'new_password.confirmed' => 'Konfirmasi kata sandi tidak cocok',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'errors' => $validator->errors()
                ], 422);
            }

            $user = Auth::user();

            // Check current password
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Kata sandi saat ini tidak sesuai'
                ], 422);
            }

            // Update password
            $user->update([
                'password' => Hash::make($request->new_password)
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Kata sandi berhasil diubah!'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengubah kata sandi: ' . $e->getMessage()
            ], 500);
        }
    }

    public function users(Request $request)
    {
        // Stats
        $totalUsers = User::count();
        $activeDoctors = User::where('role', 'doctor')->where('is_active', true)->count();
        $pendingDoctorsCount = User::where('role', 'doctor')->where('is_active', false)->count();

        // Get pending doctors for quick actions
        $pendingDoctors = User::where('role', 'doctor')
            ->where('is_active', false)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // Filters
        $search = $request->input('search');
        $role = $request->input('role');
        $status = $request->input('status');

        // Query Users
        $users = User::query()
            ->when($search, function ($q) use ($search) {
                $q->where(function ($query) use ($search) {
                    $query->where('first_name', 'like', "%$search%")
                        ->orWhere('last_name', 'like', "%$search%")
                        ->orWhere('email', 'like', "%$search%");
                });
            })
            ->when($role, fn($q) => $q->where('role', $role))
            ->when($status === 'active', fn($q) => $q->where('is_active', true))
            ->when($status === 'inactive', fn($q) => $q->where('is_active', false))
            ->orderBy('created_at', 'desc')
            ->paginate(10)
            ->withQueryString();

        return view('admin.managemen_user', compact(
            'totalUsers',
            'activeDoctors',
            'pendingDoctorsCount',
            'pendingDoctors',
            'users',
            'search',
            'role',
            'status'
        ));
    }
}
