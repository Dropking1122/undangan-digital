<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">

    <title>{{ $title ?? 'Undangan Digital' }}</title>
    <meta name="description" content="{{ $description ?? 'Undangan digital pernikahan elegan.' }}">

    {{-- Open Graph (WhatsApp, Facebook, dll) --}}
    <meta property="og:type"        content="website">
    <meta property="og:title"       content="{{ $title ?? 'Undangan Digital' }}">
    <meta property="og:description" content="{{ $description ?? 'Undangan digital pernikahan elegan.' }}">
    <meta property="og:locale"      content="id_ID">
    <meta property="og:site_name"   content="UndanganKu">
    @isset($invitation)
    @php $galleries = $invitation->galleries; @endphp
    @if($galleries && $galleries->isNotEmpty())
    <meta property="og:image" content="{{ $galleries->first()->getUrl() }}">
    <meta property="og:image:width"  content="600">
    <meta property="og:image:height" content="600">
    @endif
    @endisset

    {{-- Twitter Card --}}
    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $title ?? 'Undangan Digital' }}">
    <meta name="twitter:description" content="{{ $description ?? 'Undangan digital pernikahan elegan.' }}">

    {{-- Theme color for mobile browser --}}
    <meta name="theme-color" content="#ffffff">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,700;1,400&family=Poppins:wght@300;400;500;600&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,400&family=Great+Vibes&display=swap" rel="stylesheet">
    <style>
        * { -webkit-tap-highlight-color: transparent; }
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-white antialiased">
    {{ $slot }}
</body>
</html>
