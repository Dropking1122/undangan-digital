<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UndanganKu - Platform Undangan Digital</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body class="min-h-screen bg-white" style="font-family: 'Poppins', sans-serif;">

{{-- Nav --}}
<nav class="fixed top-0 left-0 right-0 bg-white/90 backdrop-blur-sm border-b border-gray-100 z-50">
    <div class="max-w-6xl mx-auto px-6 py-4 flex items-center justify-between">
        <h1 class="text-xl font-bold text-amber-700">💌 UndanganKu</h1>
        <div class="flex items-center gap-4">
            @auth
            <a href="{{ route('dashboard') }}" class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2 rounded-xl text-sm font-medium transition">Dashboard</a>
            @else
            <a href="{{ route('login') }}" class="text-gray-600 hover:text-amber-700 text-sm font-medium transition">Masuk</a>
            <a href="{{ route('register') }}" class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2 rounded-xl text-sm font-medium transition">Daftar Gratis</a>
            @endauth
        </div>
    </div>
</nav>

{{-- Hero --}}
<section class="pt-32 pb-20 px-6 text-center bg-gradient-to-br from-amber-50 via-white to-rose-50">
    <div class="max-w-4xl mx-auto">
        <div class="inline-block bg-amber-100 text-amber-700 text-xs font-medium px-4 py-1.5 rounded-full mb-6 tracking-wide uppercase">Platform Undangan Digital #1</div>
        <h1 class="text-5xl md:text-6xl font-bold text-gray-900 leading-tight mb-6" style="font-family: 'Playfair Display', serif;">
            Undangan Digital <br><span class="text-amber-600">Elegan & Modern</span>
        </h1>
        <p class="text-lg text-gray-600 mb-10 max-w-2xl mx-auto leading-relaxed">
            Buat undangan pernikahan digital yang memukau dengan ribuan template premium, live preview, dan fitur lengkap. Bagikan dalam hitungan menit.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="bg-amber-600 hover:bg-amber-700 text-white px-8 py-4 rounded-2xl font-semibold text-lg transition shadow-lg shadow-amber-200">
                Mulai Gratis Sekarang ✨
            </a>
            <a href="#template" class="border-2 border-gray-200 hover:border-amber-400 text-gray-700 px-8 py-4 rounded-2xl font-semibold text-lg transition">
                Lihat Template
            </a>
        </div>
    </div>
</section>

{{-- Features --}}
<section class="py-20 px-6">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4" style="font-family: 'Playfair Display', serif;">Semua yang Anda Butuhkan</h2>
            <p class="text-gray-500">Fitur lengkap untuk undangan digital yang sempurna</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
                ['🎨', 'Template Premium', 'Pilih dari koleksi template elegan yang dirancang oleh desainer profesional'],
                ['⚡', 'Live Preview', 'Lihat perubahan secara real-time saat Anda mengedit undangan'],
                ['🎵', 'Musik Latar', 'Upload musik lagu favorit sebagai background undangan digital Anda'],
                ['📸', 'Galeri Foto', 'Upload dan tampilkan momen indah dengan drag & drop yang mudah'],
                ['✉️', 'RSVP Online', 'Kelola konfirmasi kehadiran tamu secara digital dan real-time'],
                ['🔗', 'Link Mudah Dibagikan', 'Bagikan via WhatsApp dengan link personal dan nama tamu otomatis'],
            ] as [$icon, $title, $desc])
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-md transition">
                <div class="text-4xl mb-4">{{ $icon }}</div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ $title }}</h3>
                <p class="text-gray-500 text-sm leading-relaxed">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Templates --}}
<section id="template" class="py-20 px-6 bg-gray-50">
    <div class="max-w-6xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl font-bold text-gray-900 mb-4" style="font-family: 'Playfair Display', serif;">Template Pilihan</h2>
            <p class="text-gray-500">Desain elegan untuk hari istimewa Anda</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
                ['👑', 'Elegant Gold', 'Mewah dengan sentuhan emas yang timeless', false],
                ['🤍', 'Minimalist', 'Bersih, modern, dan penuh keanggunan', false],
                ['🌸', 'Rustic Garden', 'Hangat dengan nuansa alam yang romantic', true],
            ] as [$icon, $name, $desc, $premium])
            <div class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 hover:shadow-lg transition cursor-pointer group">
                <div class="h-52 bg-gradient-to-br from-amber-50 to-rose-50 flex items-center justify-center relative">
                    <div class="text-center">
                        <div class="text-5xl mb-3">{{ $icon }}</div>
                        <p class="text-sm font-medium text-gray-600">{{ $name }}</p>
                    </div>
                    @if($premium)<div class="absolute top-4 right-4 bg-amber-500 text-white text-xs px-2 py-1 rounded-full">Premium</div>@endif
                    <div class="absolute inset-0 bg-amber-600/0 group-hover:bg-amber-600/10 transition flex items-center justify-center">
                        <span class="opacity-0 group-hover:opacity-100 bg-amber-600 text-white text-sm px-4 py-2 rounded-xl transition">Preview</span>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="font-semibold text-gray-900">{{ $name }}</h3>
                    <p class="text-gray-500 text-sm mt-1">{{ $desc }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Pricing --}}
<section class="py-20 px-6">
    <div class="max-w-4xl mx-auto text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-4" style="font-family: 'Playfair Display', serif;">Harga Terjangkau</h2>
        <p class="text-gray-500 mb-12">Mulai gratis, upgrade kapan saja</p>
        <div class="grid md:grid-cols-3 gap-8">
            @foreach([
                ['Basic', 'Gratis', ['1 undangan', 'Template dasar', 'RSVP & Guestbook', 'Link personal'], false],
                ['Premium', 'Rp 99.000', ['3 undangan', 'Semua template', 'Upload musik', 'Galeri tak terbatas', 'Prioritas support'], true],
                ['Business', 'Rp 249.000', ['10 undangan', 'Semua fitur Premium', 'Custom domain', 'API access', 'Dedicated support'], false],
            ] as [$name, $price, $features, $popular])
            <div class="rounded-2xl p-8 {{ $popular ? 'bg-amber-600 text-white shadow-xl shadow-amber-200 scale-105' : 'bg-white border border-gray-200 text-gray-900' }}">
                @if($popular)<div class="text-amber-200 text-xs font-medium uppercase tracking-wide mb-3">Paling Populer</div>@endif
                <h3 class="text-lg font-bold mb-2">{{ $name }}</h3>
                <p class="text-3xl font-bold mb-6">{{ $price }}</p>
                <ul class="space-y-2 mb-8 text-left">
                    @foreach($features as $f)
                    <li class="flex items-center gap-2 text-sm"><span class="{{ $popular ? 'text-amber-200' : 'text-amber-500' }}">✓</span> {{ $f }}</li>
                    @endforeach
                </ul>
                <a href="{{ route('register') }}" class="{{ $popular ? 'bg-white text-amber-700 hover:bg-amber-50' : 'bg-amber-600 hover:bg-amber-700 text-white' }} block w-full py-3 rounded-xl font-semibold text-sm transition text-center">
                    Pilih {{ $name }}
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-20 px-6 bg-amber-600 text-center">
    <div class="max-w-2xl mx-auto">
        <h2 class="text-3xl font-bold text-white mb-4" style="font-family: 'Playfair Display', serif;">Siap Membuat Undangan Impian?</h2>
        <p class="text-amber-100 mb-8">Bergabung dengan ribuan pasangan yang telah mempercayakan undangan digitalnya kepada kami</p>
        <a href="{{ route('register') }}" class="bg-white text-amber-700 hover:bg-amber-50 px-8 py-4 rounded-2xl font-semibold text-lg transition inline-block">
            Mulai Gratis — Tidak Perlu Kartu Kredit 🎉
        </a>
    </div>
</section>

<footer class="bg-gray-900 text-gray-400 py-12 px-6 text-center">
    <h3 class="text-white font-bold text-xl mb-2">💌 UndanganKu</h3>
    <p class="text-sm">Platform Undangan Digital untuk hari istimewa Anda</p>
    <p class="text-xs mt-6">© {{ date('Y') }} UndanganKu. All rights reserved.</p>
</footer>

</body>
</html>
