<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UndanganKu — Undangan Digital Pernikahan Elegan #1 Indonesia</title>
    <meta name="description" content="Buat undangan digital pernikahan elegan dalam hitungan menit. Bagikan via WhatsApp, kelola RSVP secara real-time, dan abadikan momen istimewa Anda.">
    <meta name="keywords" content="undangan digital, undangan pernikahan online, undangan nikah digital, undangan pernikahan whatsapp, RSVP online">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ config('app.url') }}">

    {{-- Open Graph --}}
    <meta property="og:type"        content="website">
    <meta property="og:url"         content="{{ config('app.url') }}">
    <meta property="og:title"       content="UndanganKu — Undangan Digital Pernikahan Elegan">
    <meta property="og:description" content="Buat undangan digital pernikahan elegan dalam hitungan menit. Bagikan via WhatsApp, kelola RSVP secara real-time.">
    <meta property="og:locale"      content="id_ID">
    <meta property="og:site_name"   content="UndanganKu">
    <meta name="twitter:card"       content="summary_large_image">
    <meta name="twitter:title"      content="UndanganKu — Undangan Digital Pernikahan">
    <meta name="twitter:description" content="Buat undangan digital pernikahan elegan dalam hitungan menit.">

    {{-- JSON-LD Structured Data --}}
    <script type="application/ld+json">
    {
      "@@context": "https://schema.org",
      "@@type": "SoftwareApplication",
      "name": "UndanganKu",
      "description": "Platform undangan digital pernikahan terbaik di Indonesia",
      "url": "{{ config('app.url') }}",
      "applicationCategory": "BusinessApplication",
      "offers": {
        "@@type": "Offer",
        "price": "0",
        "priceCurrency": "IDR"
      },
      "aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "4.9",
        "ratingCount": "10000"
      }
    }
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --gold:#C9A96E; --gold-l:#E8D5B0; --gold-d:#A0824A; --cream:#FDF8F0; --dark:#1A1A2E; --text:#4A4A5A; }
        *   { box-sizing:border-box; margin:0; padding:0; }
        html{ scroll-behavior:smooth; }
        body{ font-family:'Inter',sans-serif; color:var(--text); background:#fff; -webkit-font-smoothing:antialiased; }
        .serif{ font-family:'Cormorant Garamond',serif; }
        .btn-gold{
            background:linear-gradient(135deg,var(--gold),var(--gold-d));
            color:#fff; padding:13px 28px; border-radius:50px;
            font-weight:600; font-size:14px; text-decoration:none;
            display:inline-flex; align-items:center; gap:8px;
            transition:all .3s; box-shadow:0 4px 18px rgba(201,169,110,.35);
            border:none; cursor:pointer; white-space:nowrap;
        }
        .btn-gold:hover{ transform:translateY(-2px); box-shadow:0 8px 28px rgba(201,169,110,.45); }
        .btn-outline{
            border:2px solid var(--gold); color:var(--gold-d);
            padding:11px 26px; border-radius:50px; font-weight:600; font-size:14px;
            text-decoration:none; display:inline-flex; align-items:center; gap:8px;
            transition:all .3s; background:transparent; cursor:pointer; white-space:nowrap;
        }
        .btn-outline:hover{ background:var(--cream); transform:translateY(-2px); }
        .tag{
            display:inline-block; background:var(--cream); color:var(--gold-d);
            font-size:11px; font-weight:700; letter-spacing:2px; text-transform:uppercase;
            padding:5px 14px; border-radius:50px; border:1px solid var(--gold-l); margin-bottom:16px;
        }
        .card{ background:#fff; border-radius:20px; border:1px solid #F0EDE8; transition:all .3s; }
        .card:hover{ transform:translateY(-5px); box-shadow:0 20px 50px rgba(0,0,0,.08); }

        /* Fade-in animation */
        @@keyframes fadeUp{ from{ opacity:0; transform:translateY(24px); } to{ opacity:1; transform:translateY(0); } }
        .fade-up{ animation:fadeUp .65s ease both; }
        .fade-up-2{ animation:fadeUp .65s .15s ease both; }
        .fade-up-3{ animation:fadeUp .65s .3s ease both; }

        /* Floating badges pulse */
        @@keyframes float{ 0%,100%{ transform:translateY(0); } 50%{ transform:translateY(-6px); } }
        .float{ animation:float 3s ease-in-out infinite; }
        .float-d{ animation:float 3s 1.5s ease-in-out infinite; }
    </style>
</head>
<body x-data="{ mobileOpen: false }">

{{-- ===== NAVBAR ===== --}}
<header style="position:fixed;top:0;left:0;right:0;z-index:100;background:rgba(255,255,255,.97);backdrop-filter:blur(12px);border-bottom:1px solid rgba(201,169,110,.12);">
    <div style="max-width:1200px;margin:0 auto;padding:0 20px;">
        <div style="height:64px;display:flex;align-items:center;justify-content:space-between;gap:16px;">
            {{-- Logo --}}
            <a href="/" style="display:flex;align-items:center;gap:9px;text-decoration:none;flex-shrink:0;">
                <div style="width:34px;height:34px;background:linear-gradient(135deg,#C9A96E,#A0824A);border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:17px;">💌</div>
                <span class="serif" style="font-size:21px;font-weight:600;color:#1A1A2E;">UndanganKu</span>
            </a>

            {{-- Desktop nav --}}
            <nav style="display:flex;align-items:center;gap:28px;" class="hidden-mobile">
                <a href="#cara-kerja" style="color:#4A4A5A;text-decoration:none;font-size:13.5px;font-weight:500;transition:color .2s;" onmouseover="this.style.color='#C9A96E'" onmouseout="this.style.color='#4A4A5A'">Cara Kerja</a>
                <a href="#fitur"      style="color:#4A4A5A;text-decoration:none;font-size:13.5px;font-weight:500;transition:color .2s;" onmouseover="this.style.color='#C9A96E'" onmouseout="this.style.color='#4A4A5A'">Fitur</a>
                <a href="#template"  style="color:#4A4A5A;text-decoration:none;font-size:13.5px;font-weight:500;transition:color .2s;" onmouseover="this.style.color='#C9A96E'" onmouseout="this.style.color='#4A4A5A'">Template</a>
                <a href="#harga"     style="color:#4A4A5A;text-decoration:none;font-size:13.5px;font-weight:500;transition:color .2s;" onmouseover="this.style.color='#C9A96E'" onmouseout="this.style.color='#4A4A5A'">Harga</a>
            </nav>

            {{-- Desktop CTA --}}
            <div style="display:flex;align-items:center;gap:10px;" class="hidden-mobile">
                @auth
                <a href="{{ route('dashboard') }}" class="btn-gold">Dashboard</a>
                @else
                <a href="{{ route('login') }}"    style="color:#4A4A5A;text-decoration:none;font-size:13.5px;font-weight:500;padding:9px 18px;">Masuk</a>
                <a href="{{ route('register') }}" class="btn-gold">Mulai Gratis</a>
                @endauth
            </div>

            {{-- Hamburger (mobile) --}}
            <button @click="mobileOpen=!mobileOpen" class="show-mobile"
                style="background:none;border:1px solid #E8D5B0;border-radius:8px;padding:8px;cursor:pointer;color:#4A4A5A;">
                <svg x-show="!mobileOpen" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M4 6h16M4 12h16M4 18h16"/></svg>
                <svg x-show="mobileOpen"  width="20" height="20" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
        </div>

        {{-- Mobile menu --}}
        <div x-show="mobileOpen" x-transition style="border-top:1px solid #F0EDE8;padding:16px 0 20px;">
            <div style="display:flex;flex-direction:column;gap:4px;">
                <a href="#cara-kerja" @click="mobileOpen=false" style="padding:10px 4px;color:#4A4A5A;text-decoration:none;font-size:15px;font-weight:500;border-bottom:1px solid #F5F2EE;">Cara Kerja</a>
                <a href="#fitur"      @click="mobileOpen=false" style="padding:10px 4px;color:#4A4A5A;text-decoration:none;font-size:15px;font-weight:500;border-bottom:1px solid #F5F2EE;">Fitur</a>
                <a href="#template"  @click="mobileOpen=false" style="padding:10px 4px;color:#4A4A5A;text-decoration:none;font-size:15px;font-weight:500;border-bottom:1px solid #F5F2EE;">Template</a>
                <a href="#harga"     @click="mobileOpen=false" style="padding:10px 4px;color:#4A4A5A;text-decoration:none;font-size:15px;font-weight:500;border-bottom:1px solid #F5F2EE;">Harga</a>
                <div style="display:flex;flex-direction:column;gap:10px;margin-top:12px;">
                    @auth
                    <a href="{{ route('dashboard') }}" class="btn-gold" style="justify-content:center;">Dashboard</a>
                    @else
                    <a href="{{ route('register') }}" class="btn-gold" style="justify-content:center;">Mulai Gratis — Gratis!</a>
                    <a href="{{ route('login') }}" class="btn-outline" style="justify-content:center;">Masuk</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
</header>

{{-- ===== HERO ===== --}}
<section style="padding:108px 20px 80px;background:linear-gradient(150deg,#FEFAF4 0%,#FDF8F0 50%,#FEF9F5 100%);position:relative;overflow:hidden;">
    <div style="position:absolute;top:-80px;right:-60px;width:480px;height:480px;background:radial-gradient(circle,rgba(201,169,110,.1),transparent 70%);border-radius:50%;pointer-events:none;"></div>
    <div style="position:absolute;bottom:-40px;left:-60px;width:360px;height:360px;background:radial-gradient(circle,rgba(201,169,110,.07),transparent 70%);border-radius:50%;pointer-events:none;"></div>

    <div style="max-width:1200px;margin:0 auto;">
        <div class="hero-grid">
            {{-- Left --}}
            <div class="fade-up">
                <div class="tag">✨ Platform Undangan Digital #1 Indonesia</div>
                <h1 class="serif" style="font-size:clamp(36px,5.5vw,58px);line-height:1.13;color:#1A1A2E;margin-bottom:20px;font-weight:600;">
                    Undangan Pernikahan Digital yang <span style="color:#C9A96E;font-style:italic;">Memukau</span>
                </h1>
                <p style="font-size:16px;line-height:1.8;color:#6B6B7B;margin-bottom:36px;max-width:460px;">
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
                <div style="display:flex;align-items:center;gap:20px;flex-wrap:wrap;">
                    @foreach([['10K+','Pasangan bahagia'],['50K+','Undangan terkirim'],['4.9★','Rating pengguna']] as [$n,$l])
                    <div>
                        <div class="serif" style="font-size:24px;font-weight:600;color:#1A1A2E;line-height:1;">{{ $n }}</div>
                        <div style="font-size:11px;color:#9B9BAB;margin-top:2px;">{{ $l }}</div>
                    </div>
                    @if(!$loop->last)<div style="width:1px;height:32px;background:#E8D5B0;"></div>@endif
                    @endforeach
                </div>
            </div>

            {{-- Right: Mock invitation card --}}
            <div style="position:relative;" class="fade-up-2">
                <div style="background:white;border-radius:24px;box-shadow:0 32px 80px rgba(0,0,0,.11);overflow:hidden;border:1px solid rgba(201,169,110,.12);">
                    <div style="background:linear-gradient(135deg,#FDF8F0,#FBF1E1);padding:40px 32px;text-align:center;border-bottom:1px solid rgba(201,169,110,.12);">
                        <p style="font-size:9px;letter-spacing:4px;color:#C9A96E;text-transform:uppercase;margin-bottom:12px;">THE WEDDING OF</p>
                        <h2 class="serif" style="font-size:34px;color:#1A1A2E;">Budi & Sari</h2>
                        <div style="width:40px;height:1px;background:#C9A96E;margin:12px auto;"></div>
                        <p style="font-size:13px;color:#777;">20 September 2026</p>
                        <p style="font-size:11px;color:#aaa;margin-top:4px;">📍 Gedung Serbaguna Harmoni</p>
                    </div>
                    <div style="padding:18px 32px;display:grid;grid-template-columns:1fr 1fr 1fr;border-bottom:1px solid #F5F5F5;">
                        @foreach([['247','Dilihat'],['38','RSVP Hadir'],['12','Ucapan']] as [$n,$l])
                        <div style="text-align:center;">
                            <div style="font-weight:700;font-size:22px;color:#1A1A2E;">{{ $n }}</div>
                            <div style="font-size:10px;color:#aaa;">{{ $l }}</div>
                        </div>
                        @endforeach
                    </div>
                    <div style="padding:14px 24px;display:flex;align-items:center;justify-content:space-between;">
                        <span style="font-size:11px;color:#777;">undanganku.id/budi-sari</span>
                        <div style="background:#25D366;color:white;padding:6px 14px;border-radius:50px;font-size:11px;font-weight:600;">Bagikan WA</div>
                    </div>
                </div>
                <div class="float"  style="position:absolute;top:-14px;right:-14px;background:white;border-radius:16px;padding:10px 14px;box-shadow:0 8px 28px rgba(0,0,0,.09);display:flex;align-items:center;gap:8px;border:1px solid #F0F0F0;">
                    <span style="font-size:18px;">🎵</span>
                    <div><div style="font-size:10px;font-weight:600;color:#1A1A2E;">Musik aktif</div><div style="font-size:9px;color:#aaa;">Perfect In White</div></div>
                </div>
                <div class="float-d" style="position:absolute;bottom:-14px;left:-14px;background:white;border-radius:16px;padding:10px 14px;box-shadow:0 8px 28px rgba(0,0,0,.09);display:flex;align-items:center;gap:8px;border:1px solid #F0F0F0;">
                    <span style="font-size:18px;">✅</span>
                    <div><div style="font-size:10px;font-weight:600;color:#1A1A2E;">RSVP baru masuk</div><div style="font-size:9px;color:#aaa;">Rini Setiawan — Hadir</div></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ===== STATS BAR ===== --}}
<div style="background:linear-gradient(135deg,#1A1A2E,#2D2D4E);padding:32px 20px;">
    <div style="max-width:1200px;margin:0 auto;">
        <div class="stats-grid">
            @foreach([['10.000+','Pasangan Bahagia','💑'],['50.000+','Undangan Dibuat','💌'],['200+','Template Tersedia','🎨'],['4.9/5','Rating Kepuasan','⭐']] as [$n,$l,$ic])
            <div style="text-align:center;padding:8px 16px;{{ !$loop->last?'border-right:1px solid rgba(255,255,255,.1);':'' }}">
                <div style="font-size:22px;margin-bottom:6px;">{{ $ic }}</div>
                <div class="serif" style="font-size:30px;font-weight:600;color:white;line-height:1;">{{ $n }}</div>
                <div style="font-size:12px;color:rgba(255,255,255,.5);margin-top:4px;">{{ $l }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

{{-- ===== CARA KERJA ===== --}}
<section id="cara-kerja" style="padding:88px 20px;background:#fff;">
    <div style="max-width:1200px;margin:0 auto;text-align:center;">
        <div class="tag">Cara Kerja</div>
        <h2 class="serif" style="font-size:clamp(28px,4vw,44px);color:#1A1A2E;margin-bottom:14px;font-weight:600;">Mudah dalam 3 Langkah</h2>
        <p style="color:#6B6B7B;font-size:15px;margin-bottom:56px;max-width:460px;margin-left:auto;margin-right:auto;">Dari pilih template hingga undangan siap dibagikan, semua selesai dalam hitungan menit.</p>
        <div class="steps-grid" style="position:relative;">
            <div class="steps-line"></div>
            @foreach([
                ['01','🎨','Pilih Template','Telusuri koleksi template elegan. Pilih yang paling cocok dengan tema pernikahanmu.'],
                ['02','✏️','Isi & Kustomisasi','Masukkan detail acara, upload foto, pilih musik, dan sesuaikan warna sesuai selera.'],
                ['03','🚀','Bagikan & Pantau','Publish undangan, bagikan link personal via WhatsApp, dan pantau RSVP real-time.'],
            ] as [$step,$icon,$title,$desc])
            <div style="position:relative;z-index:1;">
                <div style="width:100px;height:100px;background:{{ $loop->iteration===2?'linear-gradient(135deg,#C9A96E,#A0824A)':'white' }};border:{{ $loop->iteration===2?'none':'2px solid #E8D5B0' }};border-radius:50%;display:flex;flex-direction:column;align-items:center;justify-content:center;margin:0 auto 24px;box-shadow:{{ $loop->iteration===2?'0 12px 36px rgba(201,169,110,.4)':'0 4px 16px rgba(0,0,0,.06)' }};">
                    <span style="font-size:30px;">{{ $icon }}</span>
                    <span style="font-size:9px;font-weight:700;color:{{ $loop->iteration===2?'rgba(255,255,255,.7)':'#C9A96E' }};letter-spacing:1px;">{{ $step }}</span>
                </div>
                <h3 style="font-size:18px;font-weight:700;color:#1A1A2E;margin-bottom:10px;">{{ $title }}</h3>
                <p style="font-size:13.5px;line-height:1.75;color:#6B6B7B;max-width:220px;margin:0 auto;">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== FITUR ===== --}}
<section id="fitur" style="padding:88px 20px;background:var(--cream);">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:56px;">
            <div class="tag">Fitur Lengkap</div>
            <h2 class="serif" style="font-size:clamp(28px,4vw,44px);color:#1A1A2E;margin-bottom:14px;font-weight:600;">Semua yang Anda Butuhkan</h2>
            <p style="color:#6B6B7B;font-size:15px;">Fitur profesional untuk undangan digital yang sempurna</p>
        </div>
        <div class="features-grid">
            @foreach([
                ['🎨','Template Premium','Koleksi template elegan dirancang desainer profesional, selalu diperbarui.','#FDF8F0'],
                ['⚡','Live Preview','Lihat perubahan secara real-time saat Anda mengedit. WYSIWYG.','#F0F8FF'],
                ['🎵','Musik Latar','Upload lagu favorit sebagai backsound. Mendukung MP3, OGG, WAV.','#FFF8F0'],
                ['📸','Galeri Foto','Upload puluhan foto untuk galeri yang menawan.','#F0FFF4'],
                ['✉️','RSVP Online','Tamu konfirmasi kehadiran secara digital. Pantau statistik real-time.','#FFF0F5'],
                ['💰','Hadiah Digital','Tambahkan rekening bank & e-wallet (DANA, OVO, GoPay).','#F5F0FF'],
                ['📖','Buku Tamu','Tamu kirim ucapan selamat langsung di halaman undangan.','#FFFFF0'],
                ['🔗','Link Personal','Setiap tamu mendapat link dengan namanya sendiri (?to=Nama).','#F0FFFF'],
                ['📊','Analitik','Pantau kunjungan, RSVP, dan aktivitas tamu di dashboard.','#FFF5F0'],
            ] as [$ic,$t,$d,$bg])
            <div class="card" style="padding:26px;">
                <div style="width:48px;height:48px;background:{{ $bg }};border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px;margin-bottom:14px;">{{ $ic }}</div>
                <h3 style="font-size:16px;font-weight:700;color:#1A1A2E;margin-bottom:8px;">{{ $t }}</h3>
                <p style="font-size:13px;line-height:1.7;color:#6B6B7B;">{{ $d }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== TEMPLATE SHOWCASE ===== --}}
<section id="template" style="padding:88px 20px;background:#fff;">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:56px;">
            <div class="tag">Template</div>
            <h2 class="serif" style="font-size:clamp(28px,4vw,44px);color:#1A1A2E;margin-bottom:14px;font-weight:600;">Pilih Template Favoritmu</h2>
            <p style="color:#6B6B7B;font-size:15px;">Setiap template dirancang dengan detail untuk hari paling berkesan</p>
        </div>

        {{-- Featured --}}
        <div class="featured-grid" style="background:linear-gradient(135deg,#FDF8F0,#FBF1E1);border-radius:28px;padding:44px;margin-bottom:28px;border:1px solid rgba(201,169,110,.18);">
            <div>
                <div style="display:inline-block;background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;font-size:10px;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 12px;border-radius:50px;margin-bottom:18px;">Terpopuler</div>
                <h3 class="serif" style="font-size:clamp(26px,4vw,38px);color:#1A1A2E;margin-bottom:14px;">Elegant Gold</h3>
                <p style="font-size:14px;line-height:1.8;color:#6B6B7B;margin-bottom:24px;">Template mewah dengan nuansa emas yang timeless. Cocok untuk pernikahan formal dan semi-formal. Dilengkapi animasi halus dan font serif premium.</p>
                <div style="display:flex;flex-wrap:wrap;gap:7px;margin-bottom:28px;">
                    @foreach(['Animasi halus','Countdown timer','Galeri foto','Buku tamu','RSVP online'] as $f)
                    <span style="background:white;border:1px solid #E8D5B0;color:#A0824A;font-size:11px;padding:4px 12px;border-radius:50px;">✓ {{ $f }}</span>
                    @endforeach
                </div>
                <div style="display:flex;gap:14px;flex-wrap:wrap;">
                    <a href="/demo-wedding" target="_blank" class="btn-gold">Lihat Demo Live</a>
                    <a href="{{ route('register') }}" class="btn-outline">Pakai Template Ini</a>
                </div>
            </div>
            <div style="background:white;border-radius:20px;overflow:hidden;box-shadow:0 20px 56px rgba(0,0,0,.1);">
                <div style="background:linear-gradient(135deg,#FDF8F0,#FBF1E1);padding:40px 32px;text-align:center;">
                    <p style="font-size:8px;letter-spacing:4px;color:#C9A96E;text-transform:uppercase;margin-bottom:10px;">THE WEDDING OF</p>
                    <p class="serif" style="font-size:28px;color:#3d2b1f;">Budi Santoso</p>
                    <p style="font-size:17px;color:#C9A96E;margin:4px 0;">&</p>
                    <p class="serif" style="font-size:28px;color:#3d2b1f;">Sari Dewi</p>
                    <div style="width:36px;height:1px;background:#C9A96E;margin:14px auto;"></div>
                    <p style="font-size:11px;color:#888;">Sabtu, 20 September 2026</p>
                    <p style="font-size:10px;color:#aaa;margin-top:3px;">📍 Gedung Serbaguna Harmoni</p>
                </div>
                <div style="padding:14px;display:flex;justify-content:center;">
                    <div style="background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;padding:11px 28px;border-radius:50px;font-size:13px;font-weight:600;">Buka Undangan 💌</div>
                </div>
            </div>
        </div>

        {{-- Other templates --}}
        <div class="templates-grid">
            @foreach([
                ['Minimalist White','Bersih, elegan, dan modern. Tampilan minimalis yang tidak lekang oleh waktu.','#F8F8F8','border:1px solid #E8E8E8','#333','Gratis'],
                ['Rustic Garden','Hangat dengan sentuhan bunga dan alam. Cocok untuk pernikahan outdoor.','linear-gradient(135deg,#F5EFE6,#EDE3D5)','border:1px solid #D4C5B0','#5D4037','Premium'],
                ['Modern Navy','Elegan bernuansa biru navy yang maskulin dan mewah.','linear-gradient(135deg,#1A2F4E,#243B55)','border:none','#FFFFFF','Premium'],
            ] as [$name,$desc,$bg,$border,$textColor,$badge])
            <div class="card" style="border-radius:20px;overflow:hidden;background:{{ $bg }};{{ $border }};border:none;">
                <div style="padding:36px 24px;text-align:center;min-height:180px;display:flex;flex-direction:column;align-items:center;justify-content:center;">
                    <p class="serif" style="font-size:24px;color:{{ $textColor }};">The Wedding Of</p>
                    <p class="serif" style="font-size:16px;color:{{ $textColor }};opacity:.65;margin-top:2px;">Nama & Nama</p>
                </div>
                <div style="background:white;padding:18px 22px;border-top:1px solid rgba(0,0,0,.06);">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:6px;">
                        <h3 style="font-size:15px;font-weight:700;color:#1A1A2E;">{{ $name }}</h3>
                        <span style="background:{{ $badge==='Gratis'?'#E8F5E9':'#FFF3E0' }};color:{{ $badge==='Gratis'?'#2E7D32':'#E65100' }};font-size:10px;font-weight:700;padding:3px 10px;border-radius:50px;">{{ $badge }}</span>
                    </div>
                    <p style="font-size:12px;color:#6B6B7B;margin-bottom:14px;">{{ $desc }}</p>
                    <a href="{{ route('register') }}" style="display:block;text-align:center;padding:9px;background:{{ $badge==='Gratis'?'linear-gradient(135deg,#C9A96E,#A0824A)':'#F5F5F5' }};color:{{ $badge==='Gratis'?'white':'#333' }};border-radius:10px;font-size:12.5px;font-weight:600;text-decoration:none;">
                        {{ $badge==='Gratis'?'Pakai Template':'Lihat Template' }} →
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div style="text-align:center;margin-top:36px;">
            <a href="{{ route('register') }}" class="btn-outline">Lihat Semua Template →</a>
        </div>
    </div>
</section>

{{-- ===== TESTIMONI ===== --}}
<section style="padding:88px 20px;background:var(--cream);">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:56px;">
            <div class="tag">Testimoni</div>
            <h2 class="serif" style="font-size:clamp(28px,4vw,44px);color:#1A1A2E;margin-bottom:14px;font-weight:600;">Kata Pasangan Bahagia</h2>
            <p style="color:#6B6B7B;font-size:15px;">Dipercaya ribuan pasangan di seluruh Indonesia</p>
        </div>
        <div class="testimonials-grid">
            @foreach([
                ['Anita & Dimas','Jakarta','UndanganKu bikin undangan pernikahan kami jadi lebih berkesan. Tamu sangat terkesan, RSVP online sangat membantu!','Elegant Gold'],
                ['Rina & Bowo','Surabaya','Mudah sekali! Dalam 30 menit undangan sudah jadi dan langsung bisa dibagikan ke grup WhatsApp.','Minimalist'],
                ['Dewi & Fajar','Bandung','Fitur personal keren banget — setiap tamu dapat link dengan namanya sendiri. Banyak yang langsung rekomen UndanganKu!','Elegant Gold'],
            ] as [$name,$city,$review,$template])
            <div class="card" style="padding:26px;position:relative;">
                <div style="font-size:64px;color:#C9A96E;line-height:1;opacity:.15;position:absolute;top:16px;right:20px;font-family:Georgia,serif;">"</div>
                <div style="display:flex;gap:2px;margin-bottom:14px;">
                    @for($i=0;$i<5;$i++)<span style="color:#C9A96E;">★</span>@endfor
                </div>
                <p style="font-size:13.5px;line-height:1.8;color:#4A4A5A;margin-bottom:18px;font-style:italic;">"{{ $review }}"</p>
                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:16px;border-top:1px solid #F5F5F5;">
                    <div style="display:flex;align-items:center;gap:10px;">
                        <div style="width:40px;height:40px;background:linear-gradient(135deg,#C9A96E,#A0824A);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:15px;">{{ substr($name,0,1) }}</div>
                        <div>
                            <div style="font-size:13px;font-weight:700;color:#1A1A2E;">{{ $name }}</div>
                            <div style="font-size:11px;color:#aaa;">{{ $city }}</div>
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
<section id="harga" style="padding:88px 20px;background:#fff;">
    <div style="max-width:1000px;margin:0 auto;text-align:center;">
        <div class="tag">Harga</div>
        <h2 class="serif" style="font-size:clamp(28px,4vw,44px);color:#1A1A2E;margin-bottom:14px;font-weight:600;">Transparan, Tanpa Biaya Tersembunyi</h2>
        <p style="color:#6B6B7B;font-size:15px;margin-bottom:56px;">Mulai gratis selamanya. Upgrade kapan saja tanpa kontrak.</p>
        <div class="pricing-grid" style="align-items:start;">
            @foreach([
                ['Basic','Gratis','Selamanya',['1 undangan aktif','Template gratis','RSVP & Buku Tamu','Link personal tamu','Galeri 5 foto'],false,'#F8F8F8','#1A1A2E'],
                ['Premium','Rp 99.000','/bulan',['5 undangan aktif','Semua template premium','Upload musik latar','Galeri 50 foto','Analitik lengkap','Prioritas support'],true,'linear-gradient(135deg,#1A1A2E,#2D2D4E)','white'],
                ['Business','Rp 249.000','/bulan',['Unlimited undangan','Custom domain','White label','Galeri unlimited','API access','Dedicated support'],false,'#F8F8F8','#1A1A2E'],
            ] as [$name,$price,$per,$features,$popular,$bg,$textColor])
            <div style="background:{{ $bg }};border-radius:24px;padding:32px 26px;position:relative;{{ $popular?'transform:scale(1.04);box-shadow:0 20px 56px rgba(201,169,110,.22);':'border:1px solid #F0EDE8;' }}">
                @if($popular)
                <div style="position:absolute;top:-13px;left:50%;transform:translateX(-50%);background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;font-size:10px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:4px 14px;border-radius:50px;white-space:nowrap;">✨ Paling Populer</div>
                @endif
                <h3 style="font-size:21px;font-weight:700;color:{{ $textColor }};margin-bottom:8px;">{{ $name }}</h3>
                <div style="margin-bottom:8px;">
                    <span class="serif" style="font-size:40px;font-weight:600;color:{{ $textColor }};">{{ $price }}</span>
                    <span style="font-size:13px;color:{{ $popular?'rgba(255,255,255,.45)':'#9B9BAB' }};">{{ $per }}</span>
                </div>
                <div style="height:1px;background:{{ $popular?'rgba(255,255,255,.12)':'#F0EDE8' }};margin:20px 0;"></div>
                <ul style="list-style:none;text-align:left;margin-bottom:28px;">
                    @foreach($features as $f)
                    <li style="display:flex;align-items:center;gap:9px;padding:6px 0;font-size:13.5px;color:{{ $textColor }};{{ !$loop->first?'border-top:1px solid '.($popular?'rgba(255,255,255,.07)':'#F5F5F5').';':'' }}">
                        <svg width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="#C9A96E" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
                        {{ $f }}
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('register') }}" style="display:block;text-align:center;padding:13px;background:{{ $popular?'linear-gradient(135deg,#C9A96E,#A0824A)':'linear-gradient(135deg,#1A1A2E,#2D2D4E)' }};color:white;border-radius:50px;font-size:13.5px;font-weight:700;text-decoration:none;">
                    {{ $name==='Basic'?'Mulai Gratis':'Pilih '.$name }}
                </a>
            </div>
            @endforeach
        </div>
        <p style="margin-top:28px;font-size:12px;color:#aaa;">💳 Pembayaran aman · ↩ Garansi uang kembali 7 hari · 🔒 Data terlindungi</p>
    </div>
</section>

{{-- ===== CTA ===== --}}
<section style="padding:96px 20px;background:linear-gradient(135deg,#1A1A2E 0%,#2D2D4E 50%,#1A1A2E 100%);position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;opacity:.04;background-image:radial-gradient(circle,#C9A96E 1px,transparent 1px);background-size:40px 40px;"></div>
    <div style="max-width:680px;margin:0 auto;text-align:center;position:relative;z-index:1;">
        <div style="font-size:48px;margin-bottom:20px;">💌</div>
        <h2 class="serif" style="font-size:clamp(28px,5vw,48px);color:white;margin-bottom:18px;font-weight:600;line-height:1.2;">
            Hari Istimewa Anda <span style="color:#C9A96E;font-style:italic;">Layak</span> yang Terbaik
        </h2>
        <p style="font-size:16px;color:rgba(255,255,255,.55);margin-bottom:36px;line-height:1.8;">Bergabung dengan lebih dari 10.000 pasangan yang telah mempercayakan undangan digital mereka kepada UndanganKu.</p>
        <a href="{{ route('register') }}" class="btn-gold" style="font-size:15px;padding:15px 36px;">
            Buat Undangan Sekarang — Gratis!
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
        <p style="font-size:12px;color:rgba(255,255,255,.25);margin-top:18px;">Tidak perlu kartu kredit · Setup dalam 5 menit · Gratis selamanya untuk paket Basic</p>
    </div>
</section>

{{-- ===== FOOTER ===== --}}
<footer style="background:#0F0F1A;padding:60px 20px 28px;">
    <div style="max-width:1200px;margin:0 auto;">
        <div class="footer-grid" style="margin-bottom:44px;">
            <div>
                <div style="display:flex;align-items:center;gap:9px;margin-bottom:18px;">
                    <div style="width:34px;height:34px;background:linear-gradient(135deg,#C9A96E,#A0824A);border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:16px;">💌</div>
                    <span class="serif" style="font-size:20px;font-weight:600;color:white;">UndanganKu</span>
                </div>
                <p style="font-size:13px;line-height:1.8;color:rgba(255,255,255,.35);max-width:240px;">Platform undangan digital pernikahan terbaik dan terpercaya di Indonesia sejak 2024.</p>
            </div>
            @foreach([['Produk',['Template','Fitur','Harga','Roadmap']],['Perusahaan',['Tentang Kami','Blog','Karir','Press']],['Bantuan',['Pusat Bantuan','WhatsApp','Tutorial','FAQ']]] as [$col,$links])
            <div>
                <h4 style="font-size:13px;font-weight:700;color:white;margin-bottom:16px;letter-spacing:.5px;">{{ $col }}</h4>
                <ul style="list-style:none;">
                    @foreach($links as $link)
                    <li style="margin-bottom:9px;"><a href="#" style="font-size:13px;color:rgba(255,255,255,.35);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='#C9A96E'" onmouseout="this.style.color='rgba(255,255,255,.35)'">{{ $link }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
        <div style="border-top:1px solid rgba(255,255,255,.07);padding-top:24px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:12px;">
            <p style="font-size:12px;color:rgba(255,255,255,.2);">© {{ date('Y') }} UndanganKu. Hak Cipta Dilindungi.</p>
            <div style="display:flex;gap:20px;flex-wrap:wrap;">
                @foreach(['Kebijakan Privasi','Syarat & Ketentuan','Cookie'] as $link)
                <a href="#" style="font-size:12px;color:rgba(255,255,255,.2);text-decoration:none;">{{ $link }}</a>
                @endforeach
            </div>
        </div>
    </div>
</footer>

<style>
/* === RESPONSIVE === */
.hidden-mobile { display:flex; }
.show-mobile   { display:none; }

.hero-grid      { display:grid; grid-template-columns:1fr 1fr; gap:72px; align-items:center; }
.stats-grid     { display:grid; grid-template-columns:repeat(4,1fr); }
.steps-grid     { display:grid; grid-template-columns:repeat(3,1fr); gap:40px; }
.steps-line     { position:absolute;top:50px;left:calc(16.67% + 24px);right:calc(16.67% + 24px);height:2px;background:linear-gradient(90deg,#C9A96E,#E8D5B0,#C9A96E);z-index:0; }
.features-grid  { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.featured-grid  { display:grid; grid-template-columns:1fr 1fr; gap:56px; align-items:center; }
.templates-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.testimonials-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.pricing-grid   { display:grid; grid-template-columns:repeat(3,1fr); gap:20px; }
.footer-grid    { display:grid; grid-template-columns:2fr 1fr 1fr 1fr; gap:44px; }

@@media(max-width:1024px){
    .features-grid   { grid-template-columns:repeat(2,1fr); }
    .testimonials-grid{ grid-template-columns:repeat(2,1fr); }
}

@@media(max-width:768px){
    .hidden-mobile  { display:none !important; }
    .show-mobile    { display:flex !important; }
    .hero-grid      { grid-template-columns:1fr; gap:40px; }
    .stats-grid     { grid-template-columns:repeat(2,1fr); }
    .stats-grid > div{ border-right:none !important; border-bottom:1px solid rgba(255,255,255,.1); padding:16px; }
    .stats-grid > div:nth-child(odd){ border-right:1px solid rgba(255,255,255,.1) !important; }
    .steps-grid     { grid-template-columns:1fr; gap:32px; }
    .steps-line     { display:none; }
    .features-grid  { grid-template-columns:1fr 1fr; }
    .featured-grid  { grid-template-columns:1fr; gap:32px; }
    .templates-grid { grid-template-columns:1fr 1fr; }
    .testimonials-grid{ grid-template-columns:1fr; }
    .pricing-grid   { grid-template-columns:1fr; }
    .pricing-grid > div{ transform:none !important; }
    .footer-grid    { grid-template-columns:1fr 1fr; gap:32px; }
}

@@media(max-width:480px){
    .features-grid  { grid-template-columns:1fr; }
    .templates-grid { grid-template-columns:1fr; }
    .footer-grid    { grid-template-columns:1fr; }
}
</style>

<script>
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        const href = a.getAttribute('href');
        if(href === '#') return;
        e.preventDefault();
        const el = document.querySelector(href);
        if(el) el.scrollIntoView({ behavior:'smooth', block:'start' });
    });
});
</script>

</body>
</html>
