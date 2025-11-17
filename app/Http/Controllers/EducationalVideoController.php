<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EducationalVideo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class EducationalVideoController extends Controller
{
    // List semua video milik user login
    public function index()
    {
        // Ambil video terbaru, relasi creator, paginasi 3 per halaman
        $videos = EducationalVideo::with('creator')->latest()->paginate(3);

        // Kirim ke view
        return view('articles-videos', compact('videos'));
    }

    // Detail video
    public function show(EducationalVideo $video)
    {
        return view('video-detail', compact('video'));
    }

    // Buat video baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'video_url' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:2048', // opsional upload gambar
            'duration' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $data = $validator->validated();
        $data['user_id'] = Auth::id();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')->store('videos', 'public');
        }

        $video = EducationalVideo::create($data);

        return response()->json($video, 201);
    }

    public function edit($id)
    {
        $video = EducationalVideo::where('user_id', auth()->id())->findOrFail($id);

        return view('edit-video', compact('video'));
    }

    public function update(Request $request, $id)
    {
        $video = EducationalVideo::where('user_id', auth()->id())->findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:255',
            'excerpt' => 'nullable|string',
            'video_url' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|max:2048',
            'duration' => 'nullable|integer',
        ]);

        if ($request->hasFile('thumbnail')) {
            if ($video->thumbnail) {
                \Storage::delete('public/videos/' . $video->thumbnail);
            }
            $validated['thumbnail'] = $request->file('thumbnail')->store('videos', 'public');
        }

        $video->update($validated);

        return redirect()->route('videos.edit', $video->id)
            ->with('success', 'Video berhasil diperbarui!');
    }

    public function filter(Request $request)
    {
        $category = $request->query('category');

        $query = EducationalVideo::query();

        if ($category && $category !== 'Semua') {
            $query->where('category', $category);
        }

        $videos = $query->latest()->take(6)->get()->map(function ($video) {
            return [
                'id' => $video->id,
                'title' => $video->title,
                'category' => $video->category,
                'excerpt' => $video->excerpt,
                'thumbnail_url' => $video->thumbnail ? asset('storage/' . $video->thumbnail) : asset('/img/default-video.jpg'),
                'video_url' => $video->video_url,
                'duration' => $video->duration,
                'views' => $video->views,
                'creator' => [
                    'name' => $video->creator->name ?? 'Admin',
                ],
            ];
        });

        return response()->json($videos);
    }

    // Hapus video
    public function destroy($id)
    {
        $video = EducationalVideo::where('user_id', auth()->id())->findOrFail($id);

        if ($video->thumbnail) {
            \Storage::delete('public/' . $video->thumbnail);
        }

        $video->delete();

        return response()->json([
            'success' => true,
            'message' => 'Video berhasil dihapus.'
        ]);
    }

}
