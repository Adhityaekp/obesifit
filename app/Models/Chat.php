<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;

    protected $fillable = [
        'consultation_id',
        'sender_id',
        'message',
        'type',
        'is_read',
        'read_at',
        'attachment_path',
    ];

    public function consultation()
    {
        return $this->belongsTo(ConsultationRequest::class, 'consultation_id');
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }
}
