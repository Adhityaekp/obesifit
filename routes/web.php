<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\EducationalVideoController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\ConsultationRequestController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('landingpage'))->name('landingpage');
Route::get('/konsultasi', fn() => view('user.konsultasi'))->name('konsultasi');

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::get('/register-doctor', [AuthController::class, 'showDoctorRegisterForm'])->name('register.doctor');
Route::post('/register-doctor', [AuthController::class, 'registerDoctor']);

Route::get('/email/verify', [AuthController::class, 'showVerifyEmail'])
    ->middleware('auth')
    ->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, 'verify'])
    ->middleware(['auth', 'signed'])
    ->name('verification.verify');

Route::post('/email/verification-notification', [AuthController::class, 'resendVerificationEmail'])
    ->middleware(['auth', 'throttle:6,1'])
    ->name('verification.send');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::put('/profile/photo', [UserController::class, 'updatePhoto'])->name('profile.photo.update');
    Route::get('/doctors', [UserController::class, 'getDoctors'])->name('getDoctors');
    Route::get('/doctor-menu', [UserController::class, 'doctor_menu'])->name('doctor_menu');
    Route::get('/profile', [UserController::class, 'edit'])->name('profile');
    Route::put('/profile', [UserController::class, 'update'])->name('profile.update');
    Route::get('/user/health', [UserController::class, 'editHealthProfile'])->name('user.health.edit');
    Route::post('/user/health', [UserController::class, 'updateHealthProfile'])->name('user.health.update');
    Route::post('/user/health/suggest', [UserController::class, 'suggestHealthTargets'])->name('user.health.suggest');
    Route::post('/profile/change-password', [UserController::class, 'changePassword'])->name('profile.change-password');
    Route::delete('/profile/delete-account', [UserController::class, 'deleteAccount'])->name('profile.delete-account');

    Route::get('/articles-videos', [ArticleController::class, 'index'])->name('articles-videos');
    Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('articles.show');
    Route::get('/articles-videos/create', [ArticleController::class, 'create'])->name('articles-videos.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');

    // Store Video (dari form tab “Kelola Video”)
    Route::post('/videos', [EducationalVideoController::class, 'store'])->name('videos.store');

    // Detail Video
    Route::get('/videos/{video}', [EducationalVideoController::class, 'show'])->name('videos.show');

    // Edit Video
    Route::get('/videos/{id}/edit', [EducationalVideoController::class, 'edit'])->name('videos.edit');
    Route::put('/videos/{id}', [EducationalVideoController::class, 'update'])->name('videos.update');
    Route::get('/videos/filter', [EducationalVideoController::class, 'filter'])->name('videos.filter');

    // Artikel
    Route::delete('articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');

    // Route untuk halaman edit artikel
    Route::get('articles/{id}/edit', [ArticleController::class, 'edit'])->name('articles.edit');
    Route::put('articles/{id}', [ArticleController::class, 'update'])->name('articles.update');

    // Video
    Route::delete('videos/{id}', [EducationalVideoController::class, 'destroy'])->name('videos.destroy');

    Route::post('/subscribe', [SubscriptionController::class, 'create'])->name('subscribe');
    Route::post('/subscription/update-status', [SubscriptionController::class, 'updateStatus'])->name('subscription.update');

    // =========================
    // Consultation Requests
    // =========================

    // Pasien membuat request konsultasi
    Route::post('/consultations', [ConsultationRequestController::class, 'store'])
        ->name('consultations.store');

    // Dokter approve request
    Route::post('/consultations/{id}/approve', [ConsultationRequestController::class, 'approve'])
        ->name('consultations.approve');

    Route::post('/consultations/{id}/complete', [ConsultationRequestController::class, 'complete'])
        ->name('consultations.complete');

    // Dokter reject request
    Route::post('/consultations/{id}/reject', [ConsultationRequestController::class, 'reject'])
        ->name('consultations.reject');

    // List request untuk dokter
    Route::get('/consultations/doctor', [ConsultationRequestController::class, 'doctorRequests'])
        ->name('consultations.doctor');

    Route::get(
        '/consultations/doctor/approved',
        [ConsultationRequestController::class, 'doctorApprovedRequests']
    )
        ->name('consultations.doctor.approved');

    Route::get(
        '/consultations/doctor/history',
        [ConsultationRequestController::class, 'doctorHistoryRequests']
    )->name('consultations.doctor.history');

    // List request untuk pasien
    Route::get('/consultations/patient', [ConsultationRequestController::class, 'patientRequests'])
        ->name('consultations.patient');

    Route::post('/chats', [ChatController::class, 'store'])
        ->name('chats.store');

    // Tandai pesan sebagai dibaca
    Route::post('/chats/{id}/read', [ChatController::class, 'markAsRead'])
        ->name('chats.read');

    // Ambil semua chat berdasarkan consultation_id
    Route::get('/consultations/{id}/chats', [ChatController::class, 'getByConsultation'])
        ->name('consultations.chats');

    Route::get('/notifications', [NotificationController::class, 'index'])
        ->name('notifications.index');

    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount']);


    // Notifikasi dibaca
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.read');

    // Semua dibaca
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.readAll');

    Route::get('/notifications/all', [NotificationController::class, 'all']);

});

Route::get('/admin/dashboard', [AdminController::class, 'index'])
    ->middleware(['auth', 'admin'])
    ->name('admin.dashboard');
