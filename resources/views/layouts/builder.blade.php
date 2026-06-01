<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Builder - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&family=Cormorant+Garamond:wght@300;400;600&family=Montserrat:wght@300;400;500&family=Great+Vibes&display=swap" rel="stylesheet">
</head>
<body class="h-screen overflow-hidden bg-gray-100">
    <header class="bg-white border-b border-gray-200 px-4 py-3 flex items-center justify-between z-10 relative shadow-sm">
        <div class="flex items-center gap-3">
            <a href="{{ route('dashboard') }}" wire:navigate class="text-amber-700 hover:text-amber-800 p-1">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            </a>
            <h1 class="font-semibold text-gray-800 text-sm">💌 UndanganKu Builder</h1>
        </div>
    </header>
    <div class="h-[calc(100vh-57px)] overflow-hidden">
        {{ $slot }}
    </div>
</body>
</html>
