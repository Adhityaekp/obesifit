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

        // Ambil artikel & video milik user login saja
        $articles = Article::where('user_id', $user->id)
            ->latest()
            ->paginate(3, ['*'], 'articles_page');

        $videos = EducationalVideo::where('user_id', $user->id)
            ->latest()
            ->paginate(3, ['*'], 'videos_page');

        return view('add-article-video', compact('articles', 'videos'));
    }


    // Simpan artikel baru
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'nullable|string|max:100',
            'featured_image' => 'nullable|image|max:5120', // max 5MB
            'read_time' => 'nullable|integer',
            'sub_contents' => 'nullable|string',
            'conclusion' => 'nullable|string',
        ]);

        $data['user_id'] = auth()->id();
        $data['excerpt'] = $data['conclusion'] ?? ''; // conclusion ke excerpt

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
                    'content' => $sub['content'],
                    'order' => $sub['order'],
                ]);
            }
        }

        return redirect()->route('articles-videos.create')->with('success', 'Artikel berhasil dibuat.');
    }

    public function show(Article $article)
    {
        // Load subcontents
        $article->load('subContents');

        return view('article-detail', compact('article'));
    }

    // Form edit artikel
    public function edit($id)
    {
        // Ambil artikel milik user yang sedang login
        $article = Article::with('subContents')
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        // Kirim data ke view edit
        return view('edit-article', [
            'article' => $article,
            'subContents' => $article->subContents()->orderBy('order')->get()
        ]);
    }

    // Update artikel
    public function update(Request $request, $id)
    {
        $article = Article::where('user_id', auth()->id())->findOrFail($id);
        $data = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'read_time' => 'required|integer',
            'featured_image' => 'nullable|image|max:5120',
            'excerpt' => 'nullable|string',
            'sub_contents' => 'nullable|string'
        ]);

        if ($request->hasFile('featured_image')) {
            if ($article->featured_image)
                \Storage::delete('public/' . $article->featured_image);
            $data['featured_image'] = $request->file('featured_image')->store('articles', 'public');
        }

        $article->update($data);

        // Hapus subcontents lama
        $article->subContents()->delete();
        if ($request->sub_contents) {
            foreach (json_decode($request->sub_contents) as $index => $sc) {
                $article->subContents()->create([
                    'title' => $sc->title,
                    'content' => $sc->content,
                    'order' => $index
                ]);
            }
        }

        return view('edit-article', [
            'article' => $article,
            'subContents' => $article->subContents()->orderBy('order')->get()
        ]);
    }

    // Hapus artikel
    public function destroy($id)
    {
        // Cari artikel milik user yang login
        $article = Article::where('user_id', auth()->id())->findOrFail($id);

        // Hapus sub-contents terkait terlebih dahulu
        $article->subContents()->delete();

        // Hapus file featured image jika ada
        if ($article->featured_image) {
            \Storage::delete('public/articles/' . $article->featured_image);
        }

        // Hapus artikel
        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Artikel beserta sub-contents berhasil dihapus.'
        ]);
    }

}
