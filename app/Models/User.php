<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'alamat',
        'birth_date',
        'password',
        'role',
        'specialization',
        'license_number',
        'profile_photo',
        'is_active',
        'practice_start_time',
        'practice_end_time',
        'practice_days',
        'is_online',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // Accessor untuk nama lengkap
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    // Accessor untuk foto profil
    public function getProfilePhotoUrlAttribute()
    {
        if ($this->profile_photo) {
            return asset('storage/profile-photos/' . $this->profile_photo);
        }
        return asset('img/default-user.jpg');
    }

    // Method untuk role checking
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    public function isDoctor()
    {
        return $this->role === 'doctor';
    }

    public function isUser()
    {
        return $this->role === 'user';
    }

    public function healthProfile()
    {
        return $this->hasOne(UserHealthProfile::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function educationalVideos()
    {
        return $this->hasMany(EducationalVideo::class, 'user_id');
    }

    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    // Konsultasi sebagai pasien
    public function consultationsAsPatient()
    {
        return $this->hasMany(ConsultationRequest::class, 'patient_id');
    }

    // Konsultasi sebagai dokter
    public function consultationsAsDoctor()
    {
        return $this->hasMany(ConsultationRequest::class, 'doctor_id');
    }

    // Chat yang dikirim user
    public function chats()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }

    // Ambil semua pasien dokter ini
    public function patients()
    {
        return $this->hasManyThrough(
            User::class,
            ConsultationRequest::class,
            'doctor_id',  // FK di consultation_requests
            'id',         // PK di users
            'id',         // PK di this user
            'patient_id'  // FK di consultation_requests
        )->where('consultation_requests.status', 'approved');
    }

    // Ambil semua dokter pasien ini
    public function doctors()
    {
        return $this->hasManyThrough(
            User::class,
            ConsultationRequest::class,
            'patient_id',
            'id',
            'id',
            'doctor_id'
        )->where('consultation_requests.status', 'approved');
    }

    public function notificationsCustom()
    {
        return $this->hasMany(Notification::class);
    }

}