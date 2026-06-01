<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">

    <title>{{ $title ?? 'Undangan Digital' }}</title>
    <meta name="description" content="{{ $description ?? 'Undangan digital pernikahan elegan.' }}">

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

    <meta name="twitter:card"        content="summary_large_image">
    <meta name="twitter:title"       content="{{ $title ?? 'Undangan Digital' }}">
    <meta name="twitter:description" content="{{ $description ?? 'Undangan digital pernikahan elegan.' }}">

    <meta name="theme-color" content="#1a0f05">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400;1,600&family=Great+Vibes&family=Poppins:wght@300;400;500;600&family=Lato:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        * { -webkit-tap-highlight-color: transparent; box-sizing: border-box; }
        html { scroll-behavior: smooth; }
        body {
            margin: 0;
            background: #0d0d0d;
            font-family: 'Lato', sans-serif;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }
        /* Phone frame wrapper */
        #phone-frame {
            max-width: 430px;
            min-height: 100vh;
            margin: 0 auto;
            position: relative;
            background: #fffdf7;
            box-shadow: 0 0 80px rgba(0,0,0,.5);
            overflow: hidden;
        }
        /* Desktop decoration */
        @media (min-width: 500px) {
            body::before {
                content: '';
                position: fixed;
                inset: 0;
                background: radial-gradient(ellipse at center, #1a0f05 0%, #0d0d0d 70%);
                z-index: -1;
            }
        }
    </style>
</head>
<body>
    <div id="phone-frame">
        {{ $slot }}
    </div>
</body>
</html>
