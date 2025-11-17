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

    // Akses URL gambar artikel
    public function getImageUrlAttribute()
    {
        if ($this->featured_image) {
            return asset('storage/articles/' . $this->featured_image);
        }
        return asset('img/default-article.jpg');
    }

    // Tambahkan relasi subContents
    public function subContents()
    {
        return $this->hasMany(ArticleSubContent::class)->orderBy('order');
    }

}
