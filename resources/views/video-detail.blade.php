<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $video->title }} - OBESIFIT</title>
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
</head>

<body class="font-poppins bg-light">

    <!-- Video Header -->
    <section class="bg-white pt-24 pb-8">
        <div class="container mx-auto px-4 max-w-4xl">
            <h1 class="text-3xl font-bold mb-4">{{ $video->title }}</h1>

            <div class="flex items-center space-x-4 mb-6">
                <div class="w-12 h-12 bg-primary rounded-full flex items-center justify-center">
                    <i class="fas fa-user text-white"></i>
                </div>
                <div>
                    <div class="font-semibold text-dark">{{ $video->creator->full_name }}</div>
                    <div class="text-sm text-gray-600">{{ ucfirst($video->category) }}</div>
                </div>
            </div>

            <div class="relative rounded-2xl overflow-hidden mb-6">
                @if (Str::startsWith($video->video_url, 'https://www.youtube.com') ||
                        Str::startsWith($video->video_url, 'https://youtu.be'))
                    <!-- YouTube Embed -->
                    <div class="relative w-full pb-[56.25%] h-0">
                        <iframe class="absolute top-0 left-0 w-full h-full rounded-lg" src="{{ $video->video_url }}"
                            title="{{ $video->title }}" frameborder="0"
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                            allowfullscreen>
                        </iframe>
                    </div>
                @else
                    <!-- Local MP4 -->
                    <video controls class="w-full h-auto rounded-lg">
                        <source src="{{ asset('storage/videos/' . $video->video_url) }}" type="video/mp4">
                        Browser anda tidak mendukung video tag.
                    </video>
                @endif
            </div>


            <p class="text-gray-700 mb-4">{{ $video->excerpt }}</p>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-8 mt-12">
        <div class="container mx-auto px-4 text-center">
            &copy; 2025 OBESIFIT. All rights reserved.
        </div>
    </footer>

</body>

</html>
