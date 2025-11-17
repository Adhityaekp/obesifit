<!-- article-detail.blade.php -->
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>10 Pola Makan Sehat untuk Keluarga - OBESIFIT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="/favicon.ico">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#4EAC92',
                        secondary: '#3A8C74',
                        accent: '#2C6B58',
                        dark: '#1F2937',
                        light: '#F9FAFB'
                    },
                    fontFamily: {
                        'poppins': ['Poppins', 'sans-serif']
                    }
                }
            }
        }
    </script>
    <style>
        .article-content h2 {
            font-size: 1.5rem;
            font-weight: bold;
            color: #1F2937;
            margin: 2rem 0 1rem 0;
        }

        .article-content p {
            margin-bottom: 1rem;
            line-height: 1.7;
            color: #4B5563;
        }

        .sticky-sidebar {
            position: sticky;
            top: 100px;
        }

        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background: #E5E7EB;
            z-index: 1000;
        }

        .reading-progress-bar {
            height: 100%;
            background: linear-gradient(90deg, #4EAC92, #3A8C74);
            width: 0%;
            transition: width 0.3s ease;
        }
    </style>
</head>

<body class="font-poppins bg-light">
    <!-- Reading Progress Bar -->
    <div class="reading-progress">
        <div class="reading-progress-bar" id="reading-progress"></div>
    </div>

    <!-- Article Header -->
    <section class="bg-white pt-24 pb-8">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">

                <!-- Kategori -->
                @if ($article->category)
                    <div class="text-sm text-primary font-semibold mb-2">
                        {{ $article->category }}
                    </div>
                @endif

                <!-- Judul -->
                <h1 class="text-3xl font-bold mb-4">{{ $article->title }}</h1>

                <!-- Excerpt / Kesimpulan singkat -->
                @if ($article->excerpt)
                    <p class="text-gray-600 mb-6">{{ $article->excerpt }}</p>
                @endif

                <div class="flex items-center space-x-4 mb-8">
                    <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                        <i class="fas fa-user text-white"></i>
                    </div>
                    <div>
                        <div class="font-semibold text-dark">Dr. Sarah Wijaya</div>
                        <div class="text-sm text-gray-600">
                            Ahli Gizi & Nutritionist
                            &bull;
                            {{ \Carbon\Carbon::parse($article->created_at)->timezone('Asia/Jakarta')->format('d F Y') }}
                            &bull;
                            {{ $article->read_time }} menit baca
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl overflow-hidden mb-8">
                    @if ($article->featured_image)
                        <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : asset('img/default-article.jpg') }}"
                            class="w-full h-64 md:h-96 object-cover">
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Article Content -->
    <section class="py-8 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <div class="flex flex-col lg:flex-row gap-8">
                    <!-- Main Content -->
                    <div class="lg:w-2/3 article-content">
                        @foreach ($article->subContents as $index => $sub)
                            <h2 id="section-{{ $index }}">{{ $sub->title }}</h2>
                            <p>{!! nl2br(e($sub->content)) !!}</p>
                        @endforeach
                    </div>

                    <!-- Sidebar -->
                    <div class="lg:w-1/3 sticky top-24">
                        <div class="bg-white p-4 rounded-lg shadow">
                            <h3 class="font-bold mb-4">Daftar Isi</h3>
                            <nav class="space-y-2">
                                @foreach ($article->subContents as $index => $sub)
                                    <a href="#section-{{ $index }}"
                                        class="block text-gray-600 hover:text-primary transition">
                                        {{ $sub->title }}
                                    </a>
                                @endforeach
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>

</html>
