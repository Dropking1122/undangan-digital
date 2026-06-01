<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UndanganKu — Undangan Digital Pernikahan Elegan #1 Indonesia</title>
    <meta name="description" content="Buat undangan digital pernikahan elegan dalam hitungan menit. Bagikan via WhatsApp, kelola RSVP secara real-time, dan abadikan momen istimewa Anda.">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ config('app.url') }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="UndanganKu — Undangan Digital Pernikahan Elegan">
    <meta property="og:description" content="Buat undangan digital pernikahan elegan dalam hitungan menit.">
    <meta property="og:locale" content="id_ID">
    <meta property="og:site_name" content="UndanganKu">

    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "SoftwareApplication",
      "name": "UndanganKu",
      "description": "Platform undangan digital pernikahan terbaik di Indonesia",
      "url": "{{ config('app.url') }}",
      "applicationCategory": "BusinessApplication",
      "offers": { "@@type": "Offer", "price": "0", "priceCurrency": "IDR" },
      "aggregateRating": { "@@type": "AggregateRating", "ratingValue": "4.9", "ratingCount": "10000" }
    }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>
        :root {
            --gold: #C9A96E;
            --gold-l: #E8D5B0;
            --gold-d: #A0824A;
            --cream: #FDF8F0;
            --dark: #1A1A2E;
            --text: #4A4A5A;
        }
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        html { scroll-behavior: smooth; }
        body { font-family: 'Inter', sans-serif; color: var(--text); background: #fff; -webkit-font-smoothing: antialiased; }
        .serif { font-family: 'Cormorant Garamond', serif; }

        .btn-gold {
            background: linear-gradient(135deg, var(--gold), var(--gold-d));
            color: #fff; padding: 13px 28px; border-radius: 50px;
            font-weight: 600; font-size: 14px; text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all .3s; box-shadow: 0 4px 18px rgba(201,169,110,.35);
            border: none; cursor: pointer; white-space: nowrap;
        }
        .btn-gold:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(201,169,110,.45); }

        .btn-outline {
            border: 1.5px solid var(--gold-l); color: var(--gold-d);
            padding: 12px 26px; border-radius: 50px; font-weight: 600; font-size: 14px;
            text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
            transition: all .3s; background: transparent; cursor: pointer; white-space: nowrap;
        }
        .btn-outline:hover { background: var(--cream); border-color: var(--gold); transform: translateY(-2px); }

        .section-tag {
            display: inline-block; background: var(--cream); color: var(--gold-d);
            font-size: 11px; font-weight: 700; letter-spacing: 2px; text-transform: uppercase;
            padding: 5px 14px; border-radius: 50px; border: 1px solid var(--gold-l); margin-bottom: 16px;
        }

        .card { background: #fff; border-radius: 20px; border: 1px solid #F0EDE8; transition: all .3s; }
        .card:hover { transform: translateY(-4px); box-shadow: 0 20px 50px rgba(0,0,0,.07); }

        @@keyframes fadeUp { from { opacity:0; transform:translateY(24px); } to { opacity:1; transform:translateY(0); } }
        .fade-up   { animation: fadeUp .65s ease both; }
        .fade-up-2 { animation: fadeUp .65s .15s ease both; }

        @@keyframes float { 0%,100% { transform:translateY(0); } 50% { transform:translateY(-6px); } }
        .float   { animation: float 3s ease-in-out infinite; }
        .float-d { animation: float 3s 1.5s ease-in-out infinite; }

        /* Nav */
        .nav-link {
            color: #4A4A5A; text-decoration: none; font-size: 13.5px; font-weight: 500;
            transition: color .2s; padding: 6px 2px; position: relative;
        }
        .nav-link:hover { color: var(--gold); }

        /* Grids */
        .hero-grid        { display: grid; grid-template-columns: 1fr 1fr; gap: 72px; align-items: center; }
        .stats-grid       { display: grid; grid-template-columns: repeat(4, 1fr); }
        .steps-grid       { display: grid; grid-template-columns: repeat(3, 1fr); gap: 40px; position: relative; }
        .steps-line       { position:absolute; top:50px; left:calc(16.67% + 24px); right:calc(16.67% + 24px); height:2px; background:linear-gradient(90deg,#C9A96E,#E8D5B0,#C9A96E); z-index:0; }
        .features-grid    { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .featured-grid    { display: grid; grid-template-columns: 1fr 1fr; gap: 56px; align-items: center; }
        .templates-grid   { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .testimonials-grid{ display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .pricing-grid     { display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; }
        .footer-grid      { display: grid; grid-template-columns: 2fr 1fr 1fr 1fr; gap: 44px; }

        @@media (max-width: 1024px) {
            .features-grid    { grid-template-columns: repeat(2, 1fr); }
            .testimonials-grid{ grid-template-columns: repeat(2, 1fr); }
        }

        @@media (max-width: 768px) {
            .nav-desktop { display: none !important; }
            .nav-btn-desktop { display: none !important; }
            .hamburger   { display: flex !important; }
            .hero-grid   { grid-template-columns: 1fr; gap: 40px; }
            .stats-grid  { grid-template-columns: repeat(2, 1fr); }
            .stats-grid > div { border-right: none !important; border-bottom: 1px solid rgba(255,255,255,.1); padding: 16px; }
            .stats-grid > div:nth-child(odd) { border-right: 1px solid rgba(255,255,255,.1) !important; }
            .steps-grid  { grid-template-columns: 1fr; gap: 32px; }
            .steps-line  { display: none; }
            .features-grid  { grid-template-columns: 1fr 1fr; }
            .featured-grid  { grid-template-columns: 1fr; gap: 32px; }
            .templates-grid { grid-template-columns: 1fr 1fr; }
            .testimonials-grid { grid-template-columns: 1fr; }
            .pricing-grid { grid-template-columns: 1fr; }
            .pricing-grid > div { transform: none !important; }
            .footer-grid  { grid-template-columns: 1fr 1fr; gap: 32px; }
        }

        @@media (max-width: 480px) {
            .features-grid  { grid-template-columns: 1fr; }
            .templates-grid { grid-template-columns: 1fr; }
            .footer-grid    { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

{{-- ===== NAVBAR ===== --}}
<header id="navbar" style="position:fixed;top:0;left:0;right:0;z-index:100;background:rgba(255,255,255,.97);backdrop-filter:blur(12px);border-bottom:1px solid rgba(201,169,110,.12);">
    <div style="max-width:1200px;margin:0 auto;padding:0 24px;">
        <div style="height:64px;display:flex;align-items:center;justify-content:space-between;gap:16px;">

            {{-- Logo --}}
            <a href="/" style="display:flex;align-items:center;gap:10px;text-decoration:none;flex-shrink:0;">
                <div style="width:34px;height:34px;background:linear-gradient(135deg,#C9A96E,#A0824A);border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z"/>
                        <polyline points="22,6 12,13 2,6"/>
                    </svg>
                </div>
                <span class="serif" style="font-size:21px;font-weight:600;color:#1A1A2E;letter-spacing:.3px;">UndanganKu</span>
            </a>

            {{-- Desktop nav --}}
            <nav class="nav-desktop" style="display:flex;align-items:center;gap:28px;">
                <a href="#cara-kerja" class="nav-link">Cara Kerja</a>
                <a href="#fitur"      class="nav-link">Fitur</a>
                <a href="#template"  class="nav-link">Template</a>
                <a href="#harga"     class="nav-link">Harga</a>
            </nav>

            {{-- Desktop CTA --}}
            <div class="nav-btn-desktop" style="display:flex;align-items:center;gap:10px;">
                @auth
                    <a href="{{ route('dashboard') }}" class="btn-gold">Dashboard</a>
                @else
                    <a href="{{ route('login') }}"    class="nav-link" style="padding:9px 16px;">Masuk</a>
                    <a href="{{ route('register') }}" class="btn-gold">Mulai Gratis</a>
                @endauth
            </div>

            {{-- Hamburger --}}
            <button id="hamburgerBtn" class="hamburger"
                style="display:none;background:none;border:1px solid #E8D5B0;border-radius:8px;padding:8px;cursor:pointer;color:#4A4A5A;align-items:center;justify-content:center;">
                <svg id="iconMenu"  width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg id="iconClose" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display:none;"><path d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div id="mobileMenu" style="display:none;border-top:1px solid #F0EDE8;padding:16px 0 20px;">
            <div style="display:flex;flex-direction:column;gap:2px;">
                <a href="#cara-kerja" class="nav-link" style="padding:10px 4px;border-bottom:1px solid #F5F2EE;font-size:15px;" onclick="closeMobileMenu()">Cara Kerja</a>
                <a href="#fitur"      class="nav-link" style="padding:10px 4px;border-bottom:1px solid #F5F2EE;font-size:15px;" onclick="closeMobileMenu()">Fitur</a>
                <a href="#template"  class="nav-link" style="padding:10px 4px;border-bottom:1px solid #F5F2EE;font-size:15px;" onclick="closeMobileMenu()">Template</a>
                <a href="#harga"     class="nav-link" style="padding:10px 4px;border-bottom:1px solid #F5F2EE;font-size:15px;" onclick="closeMobileMenu()">Harga</a>
                <div style="display:flex;flex-direction:column;gap:10px;margin-top:14px;">
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn-gold" style="justify-content:center;">Dashboard</a>
                    @else
                        <a href="{{ route('register') }}" class="btn-gold" style="justify-content:center;">Mulai Gratis — Gratis!</a>
                        <a href="{{ route('login') }}"    class="btn-outline" style="justify-content:center;">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>

{{-- ===== HERO ===== --}}
<section style="padding:112px 24px 88px;background:linear-gradient(150deg,#FEFAF4 0%,#FDF8F0 50%,#FEFBF5 100%);position:relative;overflow:hidden;">
    <div style="position:absolute;top:-80px;right:-60px;width:500px;height:500px;background:radial-gradient(circle,rgba(201,169,110,.09),transparent 70%);border-radius:50%;pointer-events:none;"></div>
    <div style="position:absolute;bottom:-60px;left:-80px;width:400px;height:400px;background:radial-gradient(circle,rgba(201,169,110,.06),transparent 70%);border-radius:50%;pointer-events:none;"></div>

    <div style="max-width:1200px;margin:0 auto;">
        <div class="hero-grid">
            {{-- Left --}}
            <div class="fade-up">
                <div class="section-tag">Platform Undangan Digital #1 Indonesia</div>
                <h1 class="serif" style="font-size:clamp(36px,5.5vw,58px);line-height:1.13;color:#1A1A2E;margin-bottom:20px;font-weight:600;">
                    Undangan Pernikahan<br>Digital yang <span style="color:#C9A96E;font-style:italic;">Memukau</span>
                </h1>
                <p style="font-size:16px;line-height:1.85;color:#6B6B7B;margin-bottom:36px;max-width:460px;">
                    Buat undangan digital elegan dalam hitungan menit. Bagikan via WhatsApp, kelola RSVP secara real-time, dan abadikan momen istimewa Anda.
                </p>
                <div style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:44px;">
                    <a href="{{ route('register') }}" class="btn-gold">
                        Buat Undangan Gratis
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                    <a href="/demo-wedding" target="_blank" class="btn-outline">
                        <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                        Lihat Demo
                    </a>
                </div>
                <div style="display:flex;align-items:center;gap:24px;flex-wrap:wrap;">
                    @foreach([['10K+','Pasangan bahagia'],['50K+','Undangan terkirim'],['4.9/5','Rating pengguna']] as [$n,$l])
                    <div>
                        <div class="serif" style="font-size:24px;font-weight:600;color:#1A1A2E;line-height:1;">{{ $n }}</div>
                        <div style="font-size:11px;color:#9B9BAB;margin-top:3px;letter-spacing:.3px;">{{ $l }}</div>
                    </div>
                    @if(!$loop->last)<div style="width:1px;height:32px;background:#E8D5B0;"></div>@endif
                    @endforeach
                </div>
            </div>

            {{-- Right: Mock invitation card --}}
            <div style="position:relative;" class="fade-up-2">
                <div style="background:white;border-radius:24px;box-shadow:0 32px 80px rgba(0,0,0,.1);overflow:hidden;border:1px solid rgba(201,169,110,.1);">
                    <div style="background:linear-gradient(135deg,#FDF8F0,#FBF1E1);padding:40px 32px;text-align:center;border-bottom:1px solid rgba(201,169,110,.1);">
                        <p style="font-size:9px;letter-spacing:4px;color:#C9A96E;text-transform:uppercase;margin-bottom:12px;">THE WEDDING OF</p>
                        <h2 class="serif" style="font-size:34px;color:#1A1A2E;font-weight:500;">Budi &amp; Sari</h2>
                        <div style="width:40px;height:1px;background:#C9A96E;margin:12px auto;"></div>
                        <p style="font-size:13px;color:#888;">20 September 2026</p>
                        <p style="font-size:11px;color:#bbb;margin-top:4px;display:flex;align-items:center;justify-content:center;gap:4px;">
                            <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            Gedung Serbaguna Harmoni
                        </p>
                    </div>
                    <div style="padding:18px 32px;display:grid;grid-template-columns:1fr 1fr 1fr;border-bottom:1px solid #F5F5F5;">
                        @foreach([['247','Dilihat'],['38','RSVP Hadir'],['12','Ucapan']] as [$n,$l])
                        <div style="text-align:center;">
                            <div style="font-weight:700;font-size:22px;color:#1A1A2E;">{{ $n }}</div>
                            <div style="font-size:10px;color:#bbb;margin-top:2px;">{{ $l }}</div>
                        </div>
                        @endforeach
                    </div>
                    <div style="padding:14px 24px;display:flex;align-items:center;justify-content:space-between;">
                        <span style="font-size:11px;color:#aaa;">undanganku.id/budi-sari</span>
                        <div style="background:#25D366;color:white;padding:6px 14px;border-radius:50px;font-size:11px;font-weight:600;display:flex;align-items:center;gap:5px;">
                            <svg width="12" height="12" viewBox="0 0 24 24" fill="currentColor"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                            Bagikan WA
                        </div>
                    </div>
                </div>

                {{-- Floating badge: Music --}}
                <div class="float" style="position:absolute;top:-16px;right:-16px;background:white;border-radius:14px;padding:10px 14px;box-shadow:0 8px 28px rgba(0,0,0,.09);display:flex;align-items:center;gap:8px;border:1px solid #F0F0F0;">
                    <div style="width:30px;height:30px;background:#FDF8F0;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="15" height="15" fill="none" stroke="#C9A96E" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
                    </div>
                    <div>
                        <div style="font-size:10px;font-weight:600;color:#1A1A2E;">Musik aktif</div>
                        <div style="font-size:9px;color:#bbb;">Perfect In White</div>
                    </div>
                </div>

                {{-- Floating badge: RSVP --}}
                <div class="float-d" style="position:absolute;bottom:-16px;left:-16px;background:white;border-radius:14px;padding:10px 14px;box-shadow:0 8px 28px rgba(0,0,0,.09);display:flex;align-items:center;gap:8px;border:1px solid #F0F0F0;">
                    <div style="width:30px;height:30px;background:#F0FDF4;border-radius:8px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="15" height="15" fill="none" stroke="#15803D" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                    </div>
                    <div>
                        <div style="font-size:10px;font-weight:600;color:#1A1A2E;">RSVP baru masuk</div>
                        <div style="font-size:9px;color:#bbb;">Rini Setiawan — Hadir</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== STATS BAR ===== --}}
<div style="background:linear-gradient(135deg,#1A1A2E,#2A2A45);padding:32px 24px;">
    <div style="max-width:1200px;margin:0 auto;">
        <div class="stats-grid">
            @foreach([
                ['10.000+', 'Pasangan Bahagia',    'M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z'],
                ['50.000+', 'Undangan Dibuat',      'M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2zM22 6l-10 7L2 6'],
                ['200+',    'Template Tersedia',    'M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z'],
                ['4.9/5',   'Rating Kepuasan',      'M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z'],
            ] as [$n,$l,$path])
            <div style="text-align:center;padding:8px 16px;{{ !$loop->last ? 'border-right:1px solid rgba(255,255,255,.08);' : '' }}">
                <div style="width:36px;height:36px;background:rgba(201,169,110,.15);border-radius:10px;display:flex;align-items:center;justify-content:center;margin:0 auto 10px;">
                    <svg width="18" height="18" fill="none" stroke="#C9A96E" stroke-width="1.8" viewBox="0 0 24 24"><path d="{{ $path }}" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <div class="serif" style="font-size:30px;font-weight:600;color:white;line-height:1;">{{ $n }}</div>
                <div style="font-size:12px;color:rgba(255,255,255,.4);margin-top:5px;letter-spacing:.3px;">{{ $l }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ===== CARA KERJA ===== --}}
<section id="cara-kerja" style="padding:96px 24px;background:#fff;">
    <div style="max-width:1200px;margin:0 auto;text-align:center;">
        <div class="section-tag">Cara Kerja</div>
        <h2 class="serif" style="font-size:clamp(28px,4vw,44px);color:#1A1A2E;margin-bottom:14px;font-weight:600;">Mudah dalam 3 Langkah</h2>
        <p style="color:#6B6B7B;font-size:15px;margin-bottom:56px;max-width:440px;margin-left:auto;margin-right:auto;line-height:1.8;">Dari pilih template hingga undangan siap dibagikan, semua selesai dalam hitungan menit.</p>

        <div class="steps-grid">
            <div class="steps-line"></div>
            @foreach([
                ['01',
                 'M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                 'Pilih Template',
                 'Telusuri koleksi template elegan. Pilih yang paling cocok dengan tema pernikahanmu.'],
                ['02',
                 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z',
                 'Isi & Kustomisasi',
                 'Masukkan detail acara, upload foto, pilih musik, dan sesuaikan warna sesuai selera.'],
                ['03',
                 'M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z',
                 'Bagikan & Pantau',
                 'Publish undangan, bagikan link personal via WhatsApp, dan pantau RSVP real-time.'],
            ] as [$step, $iconPath, $title, $desc])
            <div style="position:relative;z-index:1;">
                <div style="width:100px;height:100px;background:{{ $loop->iteration===2 ? 'linear-gradient(135deg,#C9A96E,#A0824A)' : 'white' }};border:{{ $loop->iteration===2 ? 'none' : '2px solid #E8D5B0' }};border-radius:50%;display:flex;flex-direction:column;align-items:center;justify-content:center;margin:0 auto 24px;box-shadow:{{ $loop->iteration===2 ? '0 12px 36px rgba(201,169,110,.4)' : '0 4px 16px rgba(0,0,0,.06)' }};">
                    <svg width="28" height="28" fill="none" stroke="{{ $loop->iteration===2 ? 'white' : '#C9A96E' }}" stroke-width="1.8" viewBox="0 0 24 24"><path d="{{ $iconPath }}" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    <span style="font-size:9px;font-weight:700;color:{{ $loop->iteration===2 ? 'rgba(255,255,255,.65)' : '#C9A96E' }};letter-spacing:1px;margin-top:3px;">{{ $step }}</span>
                </div>
                <h3 style="font-size:18px;font-weight:700;color:#1A1A2E;margin-bottom:10px;">{{ $title }}</h3>
                <p style="font-size:13.5px;line-height:1.8;color:#6B6B7B;max-width:220px;margin:0 auto;">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== FITUR ===== --}}
<section id="fitur" style="padding:96px 24px;background:var(--cream);">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:56px;">
            <div class="section-tag">Fitur Lengkap</div>
            <h2 class="serif" style="font-size:clamp(28px,4vw,44px);color:#1A1A2E;margin-bottom:14px;font-weight:600;">Semua yang Anda Butuhkan</h2>
            <p style="color:#6B6B7B;font-size:15px;line-height:1.8;">Fitur profesional untuk undangan digital yang sempurna</p>
        </div>
        <div class="features-grid">
            @foreach([
                ['M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10',
                 'Template Premium',
                 'Koleksi template elegan dirancang desainer profesional, selalu diperbarui.',
                 '#FDF8F0', '#C9A96E'],
                ['M13 10V3L4 14h7v7l9-11h-7z',
                 'Live Preview',
                 'Lihat perubahan secara real-time saat Anda mengedit. Apa yang dilihat adalah hasilnya.',
                 '#EEF6FF', '#3B82F6'],
                ['M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3',
                 'Musik Latar',
                 'Upload lagu favorit sebagai backsound. Mendukung MP3, OGG, WAV.',
                 '#FFF8F0', '#F59E0B'],
                ['M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z',
                 'Galeri Foto',
                 'Upload puluhan foto untuk galeri yang menawan dan berkesan.',
                 '#F0FFF4', '#10B981'],
                ['M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4',
                 'RSVP Online',
                 'Tamu konfirmasi kehadiran secara digital. Pantau statistik real-time.',
                 '#FFF0F5', '#EC4899'],
                ['M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z',
                 'Hadiah Digital',
                 'Tambahkan rekening bank & e-wallet (DANA, OVO, GoPay).',
                 '#F5F0FF', '#8B5CF6'],
                ['M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253',
                 'Buku Tamu',
                 'Tamu kirim ucapan selamat langsung di halaman undangan.',
                 '#FFFFF0', '#D97706'],
                ['M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1',
                 'Link Personal',
                 'Setiap tamu mendapat link dengan namanya sendiri (?to=Nama).',
                 '#F0FFFF', '#0EA5E9'],
                ['M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                 'Analitik',
                 'Pantau kunjungan, RSVP, dan aktivitas tamu di dashboard.',
                 '#FFF5F0', '#EF4444'],
            ] as [$iconPath, $title, $desc, $bg, $iconColor])
            <div class="card" style="padding:26px;">
                <div style="width:48px;height:48px;background:{{ $bg }};border-radius:14px;display:flex;align-items:center;justify-content:center;margin-bottom:16px;">
                    <svg width="22" height="22" fill="none" stroke="{{ $iconColor }}" stroke-width="1.8" viewBox="0 0 24 24"><path d="{{ $iconPath }}" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <h3 style="font-size:15.5px;font-weight:700;color:#1A1A2E;margin-bottom:8px;">{{ $title }}</h3>
                <p style="font-size:13px;line-height:1.75;color:#6B6B7B;">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== TEMPLATE SHOWCASE ===== --}}
<section id="template" style="padding:96px 24px;background:#fff;">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:56px;">
            <div class="section-tag">Template</div>
            <h2 class="serif" style="font-size:clamp(28px,4vw,44px);color:#1A1A2E;margin-bottom:14px;font-weight:600;">Pilih Template Favoritmu</h2>
            <p style="color:#6B6B7B;font-size:15px;line-height:1.8;">Setiap template dirancang dengan detail untuk hari paling berkesan</p>
        </div>

        {{-- Featured --}}
        <div class="featured-grid" style="background:linear-gradient(135deg,#FDF8F0,#FBF1E1);border-radius:28px;padding:48px;margin-bottom:28px;border:1px solid rgba(201,169,110,.15);">
            <div>
                <div style="display:inline-block;background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 14px;border-radius:50px;margin-bottom:18px;">Terpopuler</div>
                <h3 class="serif" style="font-size:clamp(26px,4vw,38px);color:#1A1A2E;margin-bottom:14px;font-weight:600;">Elegant Gold</h3>
                <p style="font-size:14px;line-height:1.85;color:#6B6B7B;margin-bottom:24px;">Template mewah dengan nuansa emas yang timeless. Cocok untuk pernikahan formal dan semi-formal. Dilengkapi animasi halus dan font serif premium.</p>
                <div style="display:flex;flex-wrap:wrap;gap:7px;margin-bottom:28px;">
                    @foreach(['Animasi halus','Countdown timer','Galeri foto','Buku tamu','RSVP online'] as $f)
                    <span style="background:white;border:1px solid #E8D5B0;color:#A0824A;font-size:11.5px;padding:5px 12px;border-radius:50px;display:flex;align-items:center;gap:5px;">
                        <svg width="11" height="11" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                        {{ $f }}
                    </span>
                    @endforeach
                </div>
                <div style="display:flex;gap:14px;flex-wrap:wrap;">
                    <a href="/demo-wedding" target="_blank" class="btn-gold">Lihat Demo Live</a>
                    <a href="{{ route('register') }}" class="btn-outline">Pakai Template Ini</a>
                </div>
            </div>
            <div style="background:white;border-radius:20px;overflow:hidden;box-shadow:0 20px 56px rgba(0,0,0,.09);">
                <div style="background:linear-gradient(135deg,#FDF8F0,#FBF1E1);padding:40px 32px;text-align:center;">
                    <p style="font-size:8px;letter-spacing:4px;color:#C9A96E;text-transform:uppercase;margin-bottom:10px;">THE WEDDING OF</p>
                    <p class="serif" style="font-size:28px;color:#3d2b1f;font-weight:500;">Budi Santoso</p>
                    <p style="font-size:17px;color:#C9A96E;margin:4px 0;">&</p>
                    <p class="serif" style="font-size:28px;color:#3d2b1f;font-weight:500;">Sari Dewi</p>
                    <div style="width:36px;height:1px;background:#C9A96E;margin:14px auto;"></div>
                    <p style="font-size:11px;color:#999;">Sabtu, 20 September 2026</p>
                </div>
                <div style="padding:16px;display:flex;justify-content:center;">
                    <div style="background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;padding:11px 28px;border-radius:50px;font-size:13px;font-weight:600;display:flex;align-items:center;gap:7px;">
                        <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                        Buka Undangan
                    </div>
                </div>
            </div>
        </div>

        {{-- Other templates --}}
        <div class="templates-grid">
            @foreach([
                ['Minimalist White','Bersih, elegan, dan modern. Tampilan minimalis yang tidak lekang oleh waktu.','#F8F8F8','#333333','Gratis'],
                ['Rustic Garden','Hangat dengan sentuhan bunga dan alam. Cocok untuk pernikahan outdoor.','linear-gradient(135deg,#F5EFE6,#EDE3D5)','#5D4037','Premium'],
                ['Modern Navy','Elegan bernuansa biru navy yang maskulin dan mewah.','linear-gradient(135deg,#1A2F4E,#243B55)','#FFFFFF','Premium'],
            ] as [$name,$desc,$bg,$textColor,$badge])
            <div style="border-radius:20px;overflow:hidden;border:1px solid #F0EDE8;">
                <div style="padding:40px 24px;text-align:center;background:{{ $bg }};min-height:160px;display:flex;flex-direction:column;align-items:center;justify-content:center;">
                    <p class="serif" style="font-size:24px;color:{{ $textColor }};font-weight:500;">The Wedding Of</p>
                    <p class="serif" style="font-size:15px;color:{{ $textColor }};opacity:.55;margin-top:4px;">Nama & Nama</p>
                </div>
                <div style="background:white;padding:20px 22px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:7px;">
                        <h3 style="font-size:15px;font-weight:700;color:#1A1A2E;">{{ $name }}</h3>
                        <span style="background:{{ $badge==='Gratis' ? '#F0FDF4' : '#FFF7ED' }};color:{{ $badge==='Gratis' ? '#15803D' : '#C2410C' }};font-size:10px;font-weight:700;padding:3px 10px;border-radius:50px;">{{ $badge }}</span>
                    </div>
                    <p style="font-size:12.5px;color:#6B6B7B;margin-bottom:14px;line-height:1.7;">{{ $desc }}</p>
                    <a href="{{ route('register') }}" style="display:block;text-align:center;padding:9px;background:{{ $badge==='Gratis' ? 'linear-gradient(135deg,#C9A96E,#A0824A)' : '#F5F5F5' }};color:{{ $badge==='Gratis' ? 'white' : '#555' }};border-radius:10px;font-size:12.5px;font-weight:600;text-decoration:none;">
                        {{ $badge==='Gratis' ? 'Pakai Template' : 'Lihat Template' }}
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:36px;">
            <a href="{{ route('register') }}" class="btn-outline">Lihat Semua Template</a>
        </div>
    </div>
</section>

{{-- ===== TESTIMONI ===== --}}
<section style="padding:96px 24px;background:var(--cream);">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:56px;">
            <div class="section-tag">Testimoni</div>
            <h2 class="serif" style="font-size:clamp(28px,4vw,44px);color:#1A1A2E;margin-bottom:14px;font-weight:600;">Kata Pasangan Bahagia</h2>
            <p style="color:#6B6B7B;font-size:15px;line-height:1.8;">Dipercaya ribuan pasangan di seluruh Indonesia</p>
        </div>
        <div class="testimonials-grid">
            @foreach([
                ['Anita & Dimas','Jakarta','UndanganKu bikin undangan pernikahan kami jadi lebih berkesan. Tamu sangat terkesan, RSVP online sangat membantu!','Elegant Gold'],
                ['Rina & Bowo','Surabaya','Mudah sekali! Dalam 30 menit undangan sudah jadi dan langsung bisa dibagikan ke grup WhatsApp.','Minimalist'],
                ['Dewi & Fajar','Bandung','Fitur personal keren banget — setiap tamu dapat link dengan namanya sendiri. Banyak yang langsung rekomen UndanganKu!','Elegant Gold'],
            ] as [$name,$city,$review,$template])
            <div class="card" style="padding:28px;position:relative;">
                <svg style="position:absolute;top:16px;right:20px;opacity:.07;" width="48" height="48" viewBox="0 0 24 24" fill="#C9A96E"><path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/></svg>
                <div style="display:flex;gap:2px;margin-bottom:14px;">
                    @for($i=0;$i<5;$i++)
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#C9A96E"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    @endfor
                </div>
                <p style="font-size:13.5px;line-height:1.85;color:#4A4A5A;margin-bottom:20px;font-style:italic;">"{{ $review }}"</p>
                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:16px;border-top:1px solid #F5F5F5;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:40px;height:40px;background:linear-gradient(135deg,#C9A96E,#A0824A);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:14px;flex-shrink:0;">{{ substr($name,0,1) }}</div>
                        <div>
                            <div style="font-size:13px;font-weight:700;color:#1A1A2E;">{{ $name }}</div>
                            <div style="font-size:11px;color:#bbb;">{{ $city }}</div>
                        </div>
                    </div>
                    <span style="font-size:10px;background:#FDF8F0;color:#A0824A;padding:3px 10px;border-radius:50px;border:1px solid #E8D5B0;">{{ $template }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== PRICING ===== --}}
<section id="harga" style="padding:96px 24px;background:#fff;">
    <div style="max-width:1000px;margin:0 auto;text-align:center;">
        <div class="section-tag">Harga</div>
        <h2 class="serif" style="font-size:clamp(28px,4vw,44px);color:#1A1A2E;margin-bottom:14px;font-weight:600;">Transparan, Tanpa Biaya Tersembunyi</h2>
        <p style="color:#6B6B7B;font-size:15px;margin-bottom:56px;line-height:1.8;">Mulai gratis selamanya. Upgrade kapan saja tanpa kontrak.</p>
        <div class="pricing-grid" style="align-items:start;">
            @foreach([
                ['Basic','Gratis','Selamanya',['1 undangan aktif','Template gratis','RSVP & Buku Tamu','Link personal tamu','Galeri 5 foto'],false,'#FAFAFA','#1A1A2E'],
                ['Premium','Rp 99.000','/bulan',['5 undangan aktif','Semua template premium','Upload musik latar','Galeri 50 foto','Analitik lengkap','Prioritas support'],true,'linear-gradient(135deg,#1A1A2E,#2A2A45)','white'],
                ['Business','Rp 249.000','/bulan',['Unlimited undangan','Custom domain','White label','Galeri unlimited','API access','Dedicated support'],false,'#FAFAFA','#1A1A2E'],
            ] as [$name,$price,$per,$features,$popular,$bg,$textColor])
            <div style="background:{{ $bg }};border-radius:24px;padding:32px 28px;position:relative;{{ $popular ? 'box-shadow:0 20px 56px rgba(26,26,46,.25);' : 'border:1px solid #EEEBE6;' }}">
                @if($popular)
                <div style="position:absolute;top:-13px;left:50%;transform:translateX(-50%);background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 14px;border-radius:50px;white-space:nowrap;">Paling Populer</div>
                @endif
                <h3 style="font-size:20px;font-weight:700;color:{{ $textColor }};margin-bottom:8px;">{{ $name }}</h3>
                <div style="margin-bottom:8px;">
                    <span class="serif" style="font-size:38px;font-weight:600;color:{{ $textColor }};">{{ $price }}</span>
                    <span style="font-size:13px;color:{{ $popular ? 'rgba(255,255,255,.4)' : '#9B9BAB' }};">{{ $per }}</span>
                </div>
                <div style="height:1px;background:{{ $popular ? 'rgba(255,255,255,.1)' : '#EEEBE6' }};margin:20px 0;"></div>
                <ul style="list-style:none;text-align:left;margin-bottom:28px;">
                    @foreach($features as $f)
                    <li style="display:flex;align-items:center;gap:9px;padding:7px 0;font-size:13.5px;color:{{ $textColor }};{{ !$loop->first ? 'border-top:1px solid '.($popular ? 'rgba(255,255,255,.06)' : '#F0EDE8').';' : '' }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#C9A96E" stroke-width="2.5"><path d="M20 6L9 17l-5-5" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        {{ $f }}
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('register') }}" style="display:block;text-align:center;padding:13px;background:{{ $popular ? 'linear-gradient(135deg,#C9A96E,#A0824A)' : 'linear-gradient(135deg,#1A1A2E,#2A2A45)' }};color:white;border-radius:50px;font-size:13.5px;font-weight:700;text-decoration:none;">
                    {{ $name==='Basic' ? 'Mulai Gratis' : 'Pilih '.$name }}
                </a>
            </div>
            @endforeach
        </div>
        <p style="margin-top:28px;font-size:12px;color:#bbb;display:flex;align-items:center;justify-content:center;gap:16px;flex-wrap:wrap;">
            <span style="display:flex;align-items:center;gap:5px;">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="1" y="4" width="22" height="16" rx="2" ry="2"/><line x1="1" y1="10" x2="23" y2="10"/></svg>
                Pembayaran aman
            </span>
            <span style="display:flex;align-items:center;gap:5px;">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M9 14l6-6m-4-1l-1 1m4 4l-1 1M3 12a9 9 0 1018 0 9 9 0 00-18 0z"/></svg>
                Garansi uang kembali 7 hari
            </span>
            <span style="display:flex;align-items:center;gap:5px;">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                Data terlindungi
            </span>
        </p>
    </div>
</section>

{{-- ===== CTA ===== --}}
<section style="padding:96px 24px;background:linear-gradient(135deg,#1A1A2E 0%,#2A2A45 50%,#1A1A2E 100%);position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;opacity:.03;background-image:radial-gradient(circle,#C9A96E 1px,transparent 1px);background-size:40px 40px;"></div>
    <div style="max-width:680px;margin:0 auto;text-align:center;position:relative;z-index:1;">
        <div style="width:64px;height:64px;background:rgba(201,169,110,.15);border-radius:20px;display:flex;align-items:center;justify-content:center;margin:0 auto 24px;">
            <svg width="30" height="30" fill="none" stroke="#C9A96E" stroke-width="1.8" viewBox="0 0 24 24"><path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z" stroke-linecap="round" stroke-linejoin="round"/><polyline points="22,6 12,13 2,6" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </div>
        <h2 class="serif" style="font-size:clamp(28px,5vw,48px);color:white;margin-bottom:18px;font-weight:600;line-height:1.2;">
            Hari Istimewa Anda <span style="color:#C9A96E;font-style:italic;">Layak</span> yang Terbaik
        </h2>
        <p style="font-size:16px;color:rgba(255,255,255,.5);margin-bottom:36px;line-height:1.85;">Bergabung dengan lebih dari 10.000 pasangan yang telah mempercayakan undangan digital mereka kepada UndanganKu.</p>
        <a href="{{ route('register') }}" class="btn-gold" style="font-size:15px;padding:15px 38px;">
            Buat Undangan Sekarang — Gratis!
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
        </a>
        <p style="font-size:12px;color:rgba(255,255,255,.2);margin-top:18px;letter-spacing:.3px;">Tidak perlu kartu kredit · Setup dalam 5 menit · Gratis selamanya untuk paket Basic</p>
    </div>
</section>

{{-- ===== FOOTER ===== --}}
<footer style="background:#0D0D1A;padding:60px 24px 28px;">
    <div style="max-width:1200px;margin:0 auto;">
        <div class="footer-grid" style="margin-bottom:44px;">
            <div>
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:18px;">
                    <div style="width:34px;height:34px;background:linear-gradient(135deg,#C9A96E,#A0824A);border-radius:9px;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                    </div>
                    <span class="serif" style="font-size:20px;font-weight:600;color:white;">UndanganKu</span>
                </div>
                <p style="font-size:13px;line-height:1.85;color:rgba(255,255,255,.3);max-width:240px;">Platform undangan digital pernikahan terbaik dan terpercaya di Indonesia sejak 2024.</p>
            </div>
            @foreach([
                ['Produk',     ['Template','Fitur','Harga','Roadmap']],
                ['Perusahaan', ['Tentang Kami','Blog','Karir','Press']],
                ['Bantuan',    ['Pusat Bantuan','WhatsApp','Tutorial','FAQ']],
            ] as [$col,$links])
            <div>
                <h4 style="font-size:12px;font-weight:700;color:rgba(255,255,255,.7);margin-bottom:16px;letter-spacing:1px;text-transform:uppercase;">{{ $col }}</h4>
                <ul style="list-style:none;">
                    @foreach($links as $link)
                    <li style="margin-bottom:10px;">
                        <a href="#" style="font-size:13px;color:rgba(255,255,255,.3);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#C9A96E'" onmouseout="this.style.color='rgba(255,255,255,.3)'">{{ $link }}</a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
        <div style="border-top:1px solid rgba(255,255,255,.06);padding-top:24px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
            <p style="font-size:12px;color:rgba(255,255,255,.18);">© {{ date('Y') }} UndanganKu. Hak Cipta Dilindungi.</p>
            <div style="display:flex;gap:20px;flex-wrap:wrap;">
                @foreach(['Kebijakan Privasi','Syarat & Ketentuan','Cookie'] as $link)
                <a href="#" style="font-size:12px;color:rgba(255,255,255,.18);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='rgba(255,255,255,.5)'" onmouseout="this.style.color='rgba(255,255,255,.18)'">{{ $link }}</a>
                @endforeach
            </div>
        </div>
    </div>
</footer>

<script>
// Smooth scroll
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        const href = a.getAttribute('href');
        if (href === '#') return;
        e.preventDefault();
        const el = document.querySelector(href);
        if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
    });
});

// Mobile menu toggle (pure JS — no Alpine dependency needed on landing page)
const hamburgerBtn = document.getElementById('hamburgerBtn');
const mobileMenu   = document.getElementById('mobileMenu');
const iconMenu     = document.getElementById('iconMenu');
const iconClose    = document.getElementById('iconClose');

function closeMobileMenu() {
    mobileMenu.style.display = 'none';
    iconMenu.style.display  = 'block';
    iconClose.style.display = 'none';
}

if (hamburgerBtn) {
    hamburgerBtn.addEventListener('click', () => {
        const isOpen = mobileMenu.style.display === 'block';
        mobileMenu.style.display  = isOpen ? 'none'  : 'block';
        iconMenu.style.display    = isOpen ? 'block' : 'none';
        iconClose.style.display   = isOpen ? 'none'  : 'block';
    });
}
</script>

</body>
</html>
