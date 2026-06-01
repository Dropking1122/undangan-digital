<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; -webkit-font-smoothing: antialiased; }
        .font-serif { font-family: 'Cormorant Garamond', serif; }
    </style>
</head>
<body class="min-h-screen antialiased" style="background:#F7F5F2;">

<nav style="background:white;border-bottom:1px solid #EDE9E3;position:sticky;top:0;z-index:50;box-shadow:0 1px 3px rgba(0,0,0,.04);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2.5 no-underline" style="text-decoration:none;">
                <div style="width:34px;height:34px;background:linear-gradient(135deg,#C9A96E,#A0824A);border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
                <span class="font-serif text-xl font-semibold" style="color:#1A1A2E;letter-spacing:0.3px;">UndanganKu</span>
            </a>

            {{-- Right side --}}
            <div class="flex items-center gap-3">
                {{-- User badge --}}
                <div class="hidden sm:flex items-center gap-2.5 px-3 py-1.5 rounded-xl" style="background:#F7F5F2;">
                    <div style="width:28px;height:28px;background:linear-gradient(135deg,#C9A96E,#A0824A);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:12px;font-weight:700;color:white;flex-shrink:0;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="text-sm font-medium" style="color:#4A4A5A;">{{ auth()->user()->name }}</span>
                </div>

                {{-- Logout --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="flex items-center gap-1.5 text-sm font-medium px-3 py-1.5 rounded-lg transition-all" style="color:#9B9BAB;border:1px solid #EDE9E3;background:white;cursor:pointer;"
                        onmouseover="this.style.color='#DC2626';this.style.borderColor='#FCA5A5';this.style.background='#FEF2F2'"
                        onmouseout="this.style.color='#9B9BAB';this.style.borderColor='#EDE9E3';this.style.background='white'">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M9 21H5a2 2 0 01-2-2V5a2 2 0 012-2h4M16 17l5-5-5-5M21 12H9" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <span class="hidden sm:inline">Keluar</span>
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{ $slot }}
</main>

<footer class="mt-16 border-t py-6" style="border-color:#EDE9E3;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-xs" style="color:#C4BFBA;">© {{ date('Y') }} UndanganKu &middot; Platform Undangan Digital Indonesia</p>
    </div>
</footer>

</body>
</html>
