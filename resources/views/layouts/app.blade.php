<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') }} - Dashboard</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-50">
    <nav class="bg-white border-b border-gray-200 px-6 py-4">
        <div class="max-w-7xl mx-auto flex items-center justify-between">
            <a href="{{ route('dashboard') }}" wire:navigate class="text-xl font-bold text-amber-700">💌 UndanganKu</a>
            <div class="flex items-center gap-4">
                <span class="text-gray-600 text-sm">{{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="text-sm text-gray-500 hover:text-red-600 transition">Logout</button>
                </form>
            </div>
        </div>
    </nav>
    <main class="max-w-7xl mx-auto px-6 py-8">
        {{ $slot }}
    </main>
</body>
</html>
