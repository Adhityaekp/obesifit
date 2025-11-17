<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationalVideo extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'excerpt',
        'thumbnail',
        'video_url',
        'duration',
        'views',
        'likes',
    ];

    // Relasi ke user (creator)
    public function creator()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Akses URL thumbnail
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail) {
            return asset('storage/videos/' . $this->thumbnail);
        }
        return asset('img/default-video.jpg');
    }
}
