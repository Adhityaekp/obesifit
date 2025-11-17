<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\ConsultationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ChatController extends Controller
{
    // ================================
    //  KIRIM CHAT
    // ================================
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'consultation_id' => 'required|exists:consultation_requests,id',
            'message' => 'required_without:attachment_path|string',
            'type' => 'required|in:text,image,file',
            'attachment_path' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'Validasi gagal', 'errors' => $validator->errors()], 422);
        }

        $consultation = ConsultationRequest::findOrFail($request->consultation_id);

        // Pastikan user adalah bagian dari konsultasi
        if (!in_array(Auth::id(), [$consultation->patient_id, $consultation->doctor_id])) {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        // Hanya bisa chat jika konsultasi approved
        if ($consultation->status !== 'approved') {
            return response()->json(['message' => 'Konsultasi belum disetujui'], 403);
        }

        // Simpan pesan user
        $chat = Chat::create([
            'consultation_id' => $consultation->id,
            'sender_id' => Auth::id(),
            'message' => $request->message,
            'type' => $request->type,
            'attachment_path' => $request->attachment_path,
        ]);

        // ===================================
        //   AUTO-WELCOME MESSAGE DOKTER
        // ===================================
        $totalMessages = Chat::where('consultation_id', $consultation->id)->count();

        // Jika pesan pertama DAN yang mengirim adalah PASIEN
        if ($totalMessages == 1 && Auth::id() == $consultation->patient_id) {

            $doctorName = $consultation->doctor->full_name ?? 'Dokter';

            Chat::create([
                'consultation_id' => $consultation->id,
                'sender_id' => $consultation->doctor_id,
                'message' => "Halo, saya Dr. $doctorName. Ada yang bisa saya bantu hari ini?",
                'type' => 'text',
            ]);
        }

        return response()->json($chat, 201);
    }

    // ================================
    //  TANDAI PESAN DIBACA
    // ================================
    public function markAsRead($chatId)
    {
        $chat = Chat::findOrFail($chatId);
        $consultation = ConsultationRequest::find($chat->consultation_id);

        if (!$consultation || !in_array(Auth::id(), [$consultation->patient_id, $consultation->doctor_id])) {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $chat->update([
            'is_read' => true,
            'read_at' => now(),
        ]);

        return response()->json(['message' => 'Pesan ditandai dibaca', 'chat' => $chat]);
    }

    // ================================
    //  AMBIL CHAT BY CONSULTATION
    // ================================
    public function getByConsultation($consultationId)
    {
        $consultation = ConsultationRequest::findOrFail($consultationId);

        if (!in_array(Auth::id(), [$consultation->patient_id, $consultation->doctor_id])) {
            return response()->json(['message' => 'Akses ditolak'], 403);
        }

        $chats = $consultation->chats()->orderBy('created_at')->get();
        return response()->json($chats);
    }
}
