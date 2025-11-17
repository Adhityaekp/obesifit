<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHealthProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'height',
        'weight',
        'blood_type',
        'blood_pressure',
        'disease_history',
        'allergies',
        'target_weight',
        'workout_frequency_per_week',
        'workout_progress',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
