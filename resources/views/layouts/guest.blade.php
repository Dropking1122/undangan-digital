<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — @yield('title', 'Masuk')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }
        .font-serif { font-family: 'Cormorant Garamond', serif; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4" style="background:linear-gradient(150deg,#FEFAF4,#FDF5E8,#FEFBF5);">

    <div class="w-full max-w-md">
        {{-- Logo --}}
        <div class="text-center mb-8">
            <a href="/" class="inline-flex flex-col items-center gap-2 no-underline">
                <div style="width:48px;height:48px;background:linear-gradient(135deg,#C9A96E,#A0824A);border-radius:14px;display:flex;align-items:center;justify-content:center;box-shadow:0 8px 24px rgba(201,169,110,.3);">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
                <span class="font-serif text-2xl font-semibold" style="color:#1A1A2E;">UndanganKu</span>
                <span class="text-xs" style="color:#9B9BAB;letter-spacing:.5px;">Platform Undangan Digital</span>
            </a>
        </div>

        {{-- Card --}}
        <div style="background:white;border-radius:24px;box-shadow:0 20px 60px rgba(0,0,0,.07);border:1px solid rgba(201,169,110,.1);padding:36px;">
            {{ $slot }}
        </div>

        {{-- Back to home --}}
        <div class="text-center mt-6">
            <a href="/" style="font-size:13px;color:#9B9BAB;text-decoration:none;display:inline-flex;align-items:center;gap:5px;transition:color .2s;" onmouseover="this.style.color='#C9A96E'" onmouseout="this.style.color='#9B9BAB'">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Kembali ke Beranda
            </a>
        </div>
    </div>

</body>
</html>
