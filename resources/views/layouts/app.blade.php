<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} — Dashboard</title>
    <meta name="description" content="Dashboard UndanganKu — kelola undangan digital pernikahan Anda.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;600&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --gold: #C9A96E; --dark: #1A1A2E; }
        body { font-family: 'Inter', sans-serif; }
        .font-serif { font-family: 'Cormorant Garamond', serif; }
    </style>
</head>
<body class="min-h-screen antialiased" style="background:#F7F5F2;">

<nav style="background:white;border-bottom:1px solid #EDE9E3;position:sticky;top:0;z-index:50;">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            {{-- Logo --}}
            <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-2.5 group">
                <div style="width:34px;height:34px;background:linear-gradient(135deg,#C9A96E,#A0824A);border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0;">💌</div>
                <span class="font-serif text-xl font-semibold" style="color:#1A1A2E;letter-spacing:0.3px;">UndanganKu</span>
            </a>

            {{-- User info + logout --}}
            <div class="flex items-center gap-3 sm:gap-4">
                <div class="hidden sm:flex items-center gap-2">
                    <div style="width:32px;height:32px;background:linear-gradient(135deg,#E8D5B0,#C9A96E);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;font-weight:700;color:#1A1A2E;flex-shrink:0;">
                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                    </div>
                    <span class="text-sm font-medium text-gray-700">{{ auth()->user()->name }}</span>
                </div>
                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="text-sm text-gray-500 hover:text-red-500 transition-colors font-medium px-3 py-1.5 rounded-lg hover:bg-red-50">
                        Keluar
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    {{ $slot }}
</main>

<footer class="mt-16 border-t border-gray-200 py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <p class="text-xs text-gray-400">© {{ date('Y') }} UndanganKu · Platform Undangan Digital Indonesia</p>
    </div>
</footer>

</body>
</html>
