<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - @yield('title', 'Login')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gradient-to-br from-amber-50 to-rose-50 flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="/" wire:navigate>
                <h1 class="text-3xl font-bold text-amber-700">💌 UndanganKu</h1>
                <p class="text-gray-500 text-sm mt-1">Platform Undangan Digital</p>
            </a>
        </div>
        <div class="bg-white rounded-2xl shadow-xl p-8">
            {{ $slot }}
        </div>
    </div>
</body>
</html>
