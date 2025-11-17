<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleSubContent extends Model
{
    use HasFactory;

    protected $table = 'article_subcontents'; // <- sesuaikan nama tabel di database

    protected $fillable = [
        'article_id',
        'title',
        'content',
        'order',
    ];

    public function article()
    {
        return $this->belongsTo(Article::class);
    }
}
