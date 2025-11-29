<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'title',
        'category',
        'excerpt',
        'featured_image',
        'read_time',
        'views',
        'likes',
    ];

    // Relasi ke user (penulis artikel)
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Akses URL gambar artikel
    public function getImageUrlAttribute()
    {
        if (empty($this->featured_image)) {
            return asset('img/default-article.jpg');
        }

        return asset('storage/' . ltrim($this->featured_image, '/'));
    }

    // Tambahkan relasi subContents
    public function subContents()
    {
        return $this->hasMany(ArticleSubContent::class)->orderBy('order');
    }

}
