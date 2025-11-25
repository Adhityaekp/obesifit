<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ArticleSubContent;
use App\Models\EducationalVideo;

class ArticleController extends Controller
{
    // List artikel
    public function index()
    {
        $search = request()->query('search');
        $category = request()->query('category');
        $sort = request()->query('sort');

        // ==================== ARTIKEL ====================
        $articles = Article::with('author')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('author', function ($q) use ($search) {
                        $q->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    });
            })
            ->when($category && $category != 'Semua Kategori', function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->when($sort, function ($query) use ($sort) {
                if ($sort == 'Terbaru')
                    $query->latest();
                elseif ($sort == 'Terlama')
                    $query->oldest();
                elseif ($sort == 'Durasi Terpendek')
                    $query->orderBy('read_time', 'asc');
            })
            ->paginate(3, ['*'], 'articles_page'); // Pagination khusus artikel

        // ==================== VIDEO ====================
        $videos = EducationalVideo::with('creator')
            ->when($search, function ($query, $search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhereHas('creator', function ($q) use ($search) {
                        $q->where('first_name', 'like', "%{$search}%")
                            ->orWhere('last_name', 'like', "%{$search}%");
                    });
            })
            ->when($category && $category != 'Semua Kategori', function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->when($sort, function ($query) use ($sort) {
                if ($sort == 'Terbaru')
                    $query->latest();
                elseif ($sort == 'Terlama')
                    $query->oldest();
                elseif ($sort == 'Durasi Terpendek')
                    $query->orderBy('duration', 'asc');
            })
            ->paginate(3, ['*'], 'videos_page'); // Pagination khusus video

        return view('articles-videos', compact('articles', 'videos', 'search', 'category', 'sort'));
    }

    // Form buat artikel baru
    public function create()
    {
        $user = Auth::user();

        // Query untuk articles
        if ($user->role === 'admin') {
            // Admin melihat semua artikel
            $articles = Article::with('user') // Load relationship untuk lihat pembuat
                ->latest()
                ->paginate(3, ['*'], 'articles_page');
        } else {
            // User biasa hanya melihat artikel miliknya sendiri
            $articles = Article::where('user_id', $user->id)
                ->latest()
                ->paginate(3, ['*'], 'articles_page');
        }

        // Query untuk videos
        if ($user->role === 'admin') {
            // Admin melihat semua video
            $videos = EducationalVideo::with('creator') // Load relationship untuk lihat pembuat
                ->latest()
                ->paginate(3, ['*'], 'videos_page');
        } else {
            // User biasa hanya melihat video miliknya sendiri
            $videos = EducationalVideo::where('user_id', $user->id)
                ->latest()
                ->paginate(3, ['*'], 'videos_page');
        }

        return view('add-article-video', compact('articles', 'videos'));
    }

    // Simpan artikel baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|max:5120',
            'read_time' => 'nullable|integer',
            'sub_contents' => 'nullable|string',
            'conclusion' => 'nullable|string',
        ]);

        $data['user_id'] = auth()->id();

        // Clean HTML sebelum disimpan
        if (!empty($data['conclusion'])) {
            $data['excerpt'] = $this->cleanHtml($data['conclusion']);
        } else {
            $data['excerpt'] = '';
        }

        // Upload gambar
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('articles', 'public');
            $data['featured_image'] = $path;
        }

        // Simpan artikel
        $article = Article::create($data);

        // Simpan sub-contents dengan order
        if (!empty($data['sub_contents'])) {
            $subContents = json_decode($data['sub_contents'], true);
            foreach ($subContents as $sub) {
                ArticleSubContent::create([
                    'article_id' => $article->id,
                    'title' => $sub['title'],
                    'content' => $this->cleanHtml($sub['content']), // Clean sub-content juga
                    'order' => $sub['order'],
                ]);
            }
        }

        return redirect()->route('articles-videos.create')->with('success', 'Artikel berhasil dibuat.');
    }

    // Tambahkan method untuk clean HTML
    private function cleanHtml($html)
    {
        // Hapus semua tag kecuali yang diizinkan
        $allowedTags = '<p><br><strong><b><em><i><u><ul><ol><li><h1><h2><h3><h4><h5><h6>';
        $cleaned = strip_tags($html, $allowedTags);

        // Hapus semua atribut style dan class
        $cleaned = preg_replace('/<(.*?) style="(.*?)">/i', '<$1>', $cleaned);
        $cleaned = preg_replace('/<(.*?) class="(.*?)">/i', '<$1>', $cleaned);

        // Hapus inline styles lainnya
        $cleaned = preg_replace('/ style="[^"]*"/', '', $cleaned);
        $cleaned = preg_replace('/ class="[^"]*"/', '', $cleaned);

        return trim($cleaned);
    }

    public function show(Article $article)
    {
        // Load subcontents
        $article->load(['subContents', 'user']);

        return view('article-detail', compact('article'));
    }

    public function edit($id)
    {
        try {
            $article = Article::with('subContents')->findOrFail($id);

            // Authorization check - hanya pemilik atau admin yang bisa edit
            if (auth()->user()->role !== 'admin' && $article->user_id !== auth()->id()) {
                abort(403, 'Unauthorized action.');
            }

            return response()->json([
                'success' => true,
                'article' => $article
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan'
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $article = Article::findOrFail($id);

            // Authorization check
            if (auth()->user()->role !== 'admin' && $article->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action.'
                ], 403);
            }

            $data = $request->validate([
                'title' => 'required|string|max:255',
                'category' => 'nullable|string|max:100',
                'featured_image' => 'nullable|image|max:5120',
                'read_time' => 'nullable|integer',
                'sub_contents' => 'nullable|string',
                'conclusion' => 'nullable|string',
            ]);

            $data['excerpt'] = $data['conclusion'] ?? '';

            // Upload gambar baru jika ada
            if ($request->hasFile('featured_image')) {
                // Hapus gambar lama jika ada
                if ($article->featured_image) {
                    Storage::disk('public')->delete($article->featured_image);
                }

                $path = $request->file('featured_image')->store('articles', 'public');
                $data['featured_image'] = $path;
            }

            // Update artikel
            $article->update($data);

            // Update sub-contents
            if (!empty($data['sub_contents'])) {
                // Hapus sub-contents lama
                ArticleSubContent::where('article_id', $article->id)->delete();

                // Buat sub-contents baru
                $subContents = json_decode($data['sub_contents'], true);
                foreach ($subContents as $sub) {
                    ArticleSubContent::create([
                        'article_id' => $article->id,
                        'title' => $sub['title'],
                        'content' => $sub['content'],
                        'order' => $sub['order'],
                    ]);
                }
            }

            return redirect()->route('articles.show', $article->id)
                ->with('success', 'Artikel berhasil diupdate');
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengupdate artikel: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $article = Article::findOrFail($id);

            // Authorization check
            if (auth()->user()->role !== 'admin' && $article->user_id !== auth()->id()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized action.'
                ], 403);
            }

            // Hapus gambar jika ada
            if ($article->featured_image) {
                Storage::disk('public')->delete($article->featured_image);
            }

            // Hapus sub-contents
            ArticleSubContent::where('article_id', $article->id)->delete();

            // Hapus artikel
            $article->delete();

            return response()->json([
                'success' => true,
                'message' => 'Artikel berhasil dihapus'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus artikel: ' . $e->getMessage()
            ], 500);
        }
    }
}
