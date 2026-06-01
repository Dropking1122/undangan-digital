<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UndanganKu - Buat Undangan Digital Pernikahan Online</title>
    <meta name="description" content="Platform undangan digital pernikahan terbaik di Indonesia. Buat undangan elegan, bagikan via WhatsApp, kelola RSVP secara real-time.">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;1,400;1,500&family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --gold: #C9A96E;
            --gold-light: #E8D5B0;
            --gold-dark: #A0824A;
            --cream: #FDF8F0;
            --dark: #1A1A2E;
            --text: #4A4A5A;
        }
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body { font-family: 'Inter', sans-serif; color: var(--text); background: #fff; }
        .font-serif { font-family: 'Cormorant Garamond', serif; }
        .btn-primary {
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-dark) 100%);
            color: white; padding: 14px 32px; border-radius: 50px;
            font-weight: 600; font-size: 15px; text-decoration: none;
            display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.3s ease; box-shadow: 0 4px 20px rgba(201,169,110,0.35);
        }
        .btn-primary:hover { transform: translateY(-2px); box-shadow: 0 8px 30px rgba(201,169,110,0.45); }
        .btn-outline {
            border: 2px solid var(--gold); color: var(--gold-dark);
            padding: 12px 30px; border-radius: 50px; font-weight: 600; font-size: 15px;
            text-decoration: none; display: inline-flex; align-items: center; gap: 8px;
            transition: all 0.3s ease; background: transparent;
        }
        .btn-outline:hover { background: var(--cream); transform: translateY(-2px); }
        .section-tag {
            display: inline-block; background: var(--cream); color: var(--gold-dark);
            font-size: 12px; font-weight: 600; letter-spacing: 2px; text-transform: uppercase;
            padding: 6px 16px; border-radius: 50px; border: 1px solid var(--gold-light);
            margin-bottom: 16px;
        }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-6px); box-shadow: 0 20px 60px rgba(0,0,0,0.1); }
    </style>
</head>
<body>

{{-- ===== NAVBAR ===== --}}
<nav style="position:fixed;top:0;left:0;right:0;z-index:100;background:rgba(255,255,255,0.97);backdrop-filter:blur(12px);border-bottom:1px solid rgba(201,169,110,0.15);">
    <div style="max-width:1200px;margin:0 auto;padding:0 24px;height:68px;display:flex;align-items:center;justify-content:space-between;">
        <a href="/" style="display:flex;align-items:center;gap:10px;text-decoration:none;">
            <div style="width:36px;height:36px;background:linear-gradient(135deg,#C9A96E,#A0824A);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;">💌</div>
            <span style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;color:#1A1A2E;letter-spacing:0.5px;">UndanganKu</span>
        </a>
        <div style="display:flex;align-items:center;gap:32px;">
            <a href="#fitur" style="color:#4A4A5A;text-decoration:none;font-size:14px;font-weight:500;transition:color 0.2s;" onmouseover="this.style.color='#C9A96E'" onmouseout="this.style.color='#4A4A5A'">Fitur</a>
            <a href="#template" style="color:#4A4A5A;text-decoration:none;font-size:14px;font-weight:500;transition:color 0.2s;" onmouseover="this.style.color='#C9A96E'" onmouseout="this.style.color='#4A4A5A'">Template</a>
            <a href="#harga" style="color:#4A4A5A;text-decoration:none;font-size:14px;font-weight:500;transition:color 0.2s;" onmouseover="this.style.color='#C9A96E'" onmouseout="this.style.color='#4A4A5A'">Harga</a>
            <a href="#cara-kerja" style="color:#4A4A5A;text-decoration:none;font-size:14px;font-weight:500;transition:color 0.2s;" onmouseover="this.style.color='#C9A96E'" onmouseout="this.style.color='#4A4A5A'">Cara Kerja</a>
        </div>
        <div style="display:flex;align-items:center;gap:12px;">
            @auth
            <a href="{{ route('dashboard') }}" class="btn-primary">Dashboard</a>
            @else
            <a href="{{ route('login') }}" style="color:#4A4A5A;text-decoration:none;font-size:14px;font-weight:500;padding:10px 20px;">Masuk</a>
            <a href="{{ route('register') }}" class="btn-primary">Mulai Gratis</a>
            @endauth
        </div>
    </div>
</nav>

{{-- ===== HERO ===== --}}
<section style="padding:140px 24px 100px;background:linear-gradient(135deg,#FEFAF4 0%,#FDF8F0 40%,#FEF9F5 100%);position:relative;overflow:hidden;">
    {{-- Decorative orbs --}}
    <div style="position:absolute;top:-100px;right:-100px;width:500px;height:500px;background:radial-gradient(circle,rgba(201,169,110,0.08),transparent 70%);border-radius:50%;pointer-events:none;"></div>
    <div style="position:absolute;bottom:-50px;left:-80px;width:400px;height:400px;background:radial-gradient(circle,rgba(201,169,110,0.06),transparent 70%);border-radius:50%;pointer-events:none;"></div>

    <div style="max-width:1200px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:80px;align-items:center;">
        <div>
            <div class="section-tag">✨ Platform Undangan Digital #1 Indonesia</div>
            <h1 class="font-serif" style="font-size:58px;line-height:1.15;color:#1A1A2E;margin-bottom:24px;font-weight:600;">
                Undangan Pernikahan Digital yang <span style="color:#C9A96E;font-style:italic;">Memukau</span>
            </h1>
            <p style="font-size:17px;line-height:1.75;color:#6B6B7B;margin-bottom:40px;max-width:480px;">
                Buat undangan digital elegan dalam hitungan menit. Bagikan via WhatsApp, kelola RSVP secara real-time, dan abadikan momen istimewa Anda.
            </p>
            <div style="display:flex;gap:16px;flex-wrap:wrap;margin-bottom:48px;">
                <a href="{{ route('register') }}" class="btn-primary">
                    Buat Undangan Gratis
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                </a>
                <a href="/demo-wedding" target="_blank" class="btn-outline">
                    <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Lihat Demo
                </a>
            </div>
            {{-- Trust badges --}}
            <div style="display:flex;align-items:center;gap:24px;">
                @foreach([['10K+','Pasangan bahagia'],['50K+','Undangan terkirim'],['4.9★','Rating pengguna']] as [$num,$label])
                <div>
                    <div style="font-family:'Cormorant Garamond',serif;font-size:26px;font-weight:600;color:#1A1A2E;">{{ $num }}</div>
                    <div style="font-size:12px;color:#9B9BAB;">{{ $label }}</div>
                </div>
                @if(!$loop->last)<div style="width:1px;height:36px;background:#E8D5B0;"></div>@endif
                @endforeach
            </div>
        </div>

        {{-- Hero preview card --}}
        <div style="position:relative;">
            <div style="background:white;border-radius:24px;box-shadow:0 30px 80px rgba(0,0,0,0.12);overflow:hidden;border:1px solid rgba(201,169,110,0.15);">
                {{-- Preview header --}}
                <div style="background:linear-gradient(135deg,#FDF8F0,#FBF1E1);padding:40px 32px;text-align:center;border-bottom:1px solid rgba(201,169,110,0.15);">
                    <p style="font-size:10px;letter-spacing:4px;color:#C9A96E;text-transform:uppercase;margin-bottom:12px;">THE WEDDING OF</p>
                    <h2 class="font-serif" style="font-size:36px;color:#1A1A2E;margin-bottom:4px;">Budi & Sari</h2>
                    <div style="width:48px;height:1px;background:#C9A96E;margin:12px auto;"></div>
                    <p style="font-size:13px;color:#6B6B7B;">20 September 2026</p>
                    <p style="font-size:12px;color:#9B9BAB;margin-top:4px;">📍 Gedung Serbaguna Harmoni</p>
                </div>
                {{-- Preview stats --}}
                <div style="padding:20px 32px;display:grid;grid-template-columns:1fr 1fr 1fr;gap:0;border-bottom:1px solid #F5F5F5;">
                    @foreach([['247','Dilihat'],['38','RSVP Hadir'],['12','Ucapan']] as [$n,$l])
                    <div style="text-align:center;padding:8px;">
                        <div style="font-weight:700;font-size:22px;color:#1A1A2E;">{{ $n }}</div>
                        <div style="font-size:11px;color:#9B9BAB;">{{ $l }}</div>
                    </div>
                    @endforeach
                </div>
                {{-- Share row --}}
                <div style="padding:16px 32px;display:flex;align-items:center;justify-content:space-between;">
                    <span style="font-size:12px;color:#6B6B7B;">undanganku.id/budi-sari</span>
                    <div style="background:#25D366;color:white;padding:6px 14px;border-radius:50px;font-size:12px;font-weight:600;">Bagikan WA</div>
                </div>
            </div>
            {{-- Floating badges --}}
            <div style="position:absolute;top:-16px;right:-16px;background:white;border-radius:16px;padding:12px 16px;box-shadow:0 8px 30px rgba(0,0,0,0.1);display:flex;align-items:center;gap:8px;border:1px solid #F0F0F0;">
                <span style="font-size:20px;">🎵</span>
                <div><div style="font-size:11px;font-weight:600;color:#1A1A2E;">Musik aktif</div><div style="font-size:10px;color:#9B9BAB;">Perfect In White</div></div>
            </div>
            <div style="position:absolute;bottom:-16px;left:-16px;background:white;border-radius:16px;padding:12px 16px;box-shadow:0 8px 30px rgba(0,0,0,0.1);display:flex;align-items:center;gap:8px;border:1px solid #F0F0F0;">
                <span style="font-size:20px;">✅</span>
                <div><div style="font-size:11px;font-weight:600;color:#1A1A2E;">RSVP baru masuk</div><div style="font-size:10px;color:#9B9BAB;">Rini Setiawan — Hadir</div></div>
            </div>
        </div>
    </div>
</section>

{{-- ===== STATS BAR ===== --}}
<div style="background:linear-gradient(135deg,#1A1A2E,#2D2D4E);padding:32px 24px;">
    <div style="max-width:1200px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr);gap:0;">
        @foreach([
            ['10.000+', 'Pasangan Bahagia', '💑'],
            ['50.000+', 'Undangan Dibuat', '💌'],
            ['200+', 'Template Tersedia', '🎨'],
            ['4.9/5', 'Rating Kepuasan', '⭐'],
        ] as [$num, $label, $icon])
        <div style="text-align:center;padding:8px 16px;{{ !$loop->last ? 'border-right:1px solid rgba(255,255,255,0.1);' : '' }}">
            <div style="font-size:22px;margin-bottom:8px;">{{ $icon }}</div>
            <div class="font-serif" style="font-size:32px;font-weight:600;color:white;line-height:1;">{{ $num }}</div>
            <div style="font-size:13px;color:rgba(255,255,255,0.5);margin-top:4px;">{{ $label }}</div>
        </div>
        @endforeach
    </div>
</div>

{{-- ===== CARA KERJA ===== --}}
<section id="cara-kerja" style="padding:100px 24px;background:#fff;">
    <div style="max-width:1200px;margin:0 auto;text-align:center;">
        <div class="section-tag">Cara Kerja</div>
        <h2 class="font-serif" style="font-size:44px;color:#1A1A2E;margin-bottom:16px;font-weight:600;">Mudah dalam 3 Langkah</h2>
        <p style="color:#6B6B7B;font-size:16px;margin-bottom:64px;max-width:500px;margin-left:auto;margin-right:auto;">Dari pilih template hingga undangan siap dibagikan, semua selesai dalam hitungan menit.</p>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:48px;position:relative;">
            {{-- Connector line --}}
            <div style="position:absolute;top:56px;left:calc(16.67% + 32px);right:calc(16.67% + 32px);height:2px;background:linear-gradient(90deg,#C9A96E,#E8D5B0,#C9A96E);z-index:0;"></div>
            @foreach([
                ['01', '🎨', 'Pilih Template', 'Telusuri koleksi template elegan. Pilih yang paling cocok dengan tema pernikahanmu.'],
                ['02', '✏️', 'Isi & Kustomisasi', 'Masukkan detail acara, upload foto, pilih musik, dan sesuaikan warna sesuai selera.'],
                ['03', '🚀', 'Bagikan & Pantau', 'Publish undangan, bagikan link personal via WhatsApp, dan pantau RSVP secara real-time.'],
            ] as [$step, $icon, $title, $desc])
            <div style="position:relative;z-index:1;">
                <div style="width:112px;height:112px;background:{{ $loop->iteration === 2 ? 'linear-gradient(135deg,#C9A96E,#A0824A)' : 'white' }};border:{{ $loop->iteration === 2 ? 'none' : '2px solid #E8D5B0' }};border-radius:50%;display:flex;flex-direction:column;align-items:center;justify-content:center;margin:0 auto 28px;box-shadow:{{ $loop->iteration === 2 ? '0 12px 40px rgba(201,169,110,0.4)' : '0 4px 20px rgba(0,0,0,0.06)' }};">
                    <span style="font-size:32px;">{{ $icon }}</span>
                    <span style="font-size:10px;font-weight:700;color:{{ $loop->iteration === 2 ? 'rgba(255,255,255,0.7)' : '#C9A96E' }};letter-spacing:1px;">{{ $step }}</span>
                </div>
                <h3 style="font-size:20px;font-weight:700;color:#1A1A2E;margin-bottom:12px;">{{ $title }}</h3>
                <p style="font-size:14px;line-height:1.7;color:#6B6B7B;">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== FITUR ===== --}}
<section id="fitur" style="padding:100px 24px;background:var(--cream);">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:64px;">
            <div class="section-tag">Fitur Lengkap</div>
            <h2 class="font-serif" style="font-size:44px;color:#1A1A2E;margin-bottom:16px;font-weight:600;">Semua yang Anda Butuhkan</h2>
            <p style="color:#6B6B7B;font-size:16px;">Fitur profesional untuk undangan digital yang sempurna</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
            @foreach([
                ['🎨', 'Template Premium', 'Koleksi template elegan dirancang desainer profesional, selalu diperbarui setiap bulan.', '#FDF8F0'],
                ['⚡', 'Live Preview', 'Lihat perubahan secara real-time saat Anda mengedit. Apa yang Anda lihat adalah hasilnya.', '#F0F8FF'],
                ['🎵', 'Musik Latar', 'Upload lagu favorit sebagai backsound. Mendukung MP3, OGG, WAV hingga 20MB.', '#FFF8F0'],
                ['📸', 'Galeri Foto', 'Upload puluhan foto untuk galeri yang menawan. Mendukung reorder via drag & drop.', '#F0FFF4'],
                ['✉️', 'RSVP Online', 'Tamu konfirmasi kehadiran secara digital. Pantau statistik kehadiran real-time.', '#FFF0F5'],
                ['💰', 'Hadiah Digital', 'Tambahkan rekening bank dan e-wallet (DANA, OVO, GoPay) untuk amplop digital.', '#F5F0FF'],
                ['📖', 'Buku Tamu', 'Tamu kirim ucapan selamat langsung di halaman undangan. Moderasi pesan mudah.', '#FFFFF0'],
                ['🔗', 'Link Personal', 'Setiap tamu mendapat link dengan namanya sendiri (?to=Nama). Berkesan & eksklusif.', '#F0FFFF'],
                ['📊', 'Analitik', 'Pantau jumlah kunjungan, RSVP, dan aktivitas tamu dalam dashboard real-time.', '#FFF5F0'],
            ] as [$icon, $title, $desc, $bg])
            <div class="card-hover" style="background:white;border-radius:20px;padding:28px;border:1px solid #F0EDE8;">
                <div style="width:52px;height:52px;background:{{ $bg }};border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:24px;margin-bottom:16px;">{{ $icon }}</div>
                <h3 style="font-size:17px;font-weight:700;color:#1A1A2E;margin-bottom:8px;">{{ $title }}</h3>
                <p style="font-size:13px;line-height:1.7;color:#6B6B7B;">{{ $desc }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== TEMPLATE SHOWCASE ===== --}}
<section id="template" style="padding:100px 24px;background:#fff;">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:64px;">
            <div class="section-tag">Template</div>
            <h2 class="font-serif" style="font-size:44px;color:#1A1A2E;margin-bottom:16px;font-weight:600;">Pilih Template Favoritmu</h2>
            <p style="color:#6B6B7B;font-size:16px;">Setiap template dirancang dengan detail untuk hari paling berkesan dalam hidupmu</p>
        </div>

        {{-- Featured template --}}
        <div style="background:linear-gradient(135deg,#FDF8F0,#FBF1E1);border-radius:28px;padding:48px;display:grid;grid-template-columns:1fr 1fr;gap:64px;align-items:center;margin-bottom:32px;border:1px solid rgba(201,169,110,0.2);">
            <div>
                <div style="display:inline-block;background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;font-size:11px;font-weight:700;letter-spacing:2px;text-transform:uppercase;padding:4px 12px;border-radius:50px;margin-bottom:20px;">Terpopuler</div>
                <h3 class="font-serif" style="font-size:38px;color:#1A1A2E;margin-bottom:16px;">Elegant Gold</h3>
                <p style="font-size:15px;line-height:1.75;color:#6B6B7B;margin-bottom:28px;">Template mewah dengan nuansa emas yang timeless. Cocok untuk pernikahan formal dan semi-formal. Dilengkapi animasi halus dan font serif premium.</p>
                <div style="display:flex;flex-wrap:wrap;gap:8px;margin-bottom:32px;">
                    @foreach(['Animasi halus','Countdown timer','Galeri foto','Buku tamu','RSVP online'] as $feat)
                    <span style="background:white;border:1px solid #E8D5B0;color:#A0824A;font-size:12px;padding:4px 12px;border-radius:50px;">✓ {{ $feat }}</span>
                    @endforeach
                </div>
                <div style="display:flex;gap:16px;">
                    <a href="/demo-wedding" target="_blank" class="btn-primary">Lihat Demo Live</a>
                    <a href="{{ route('register') }}" class="btn-outline">Pakai Template Ini</a>
                </div>
            </div>
            <div style="background:white;border-radius:20px;overflow:hidden;box-shadow:0 20px 60px rgba(0,0,0,0.12);">
                <div style="background:linear-gradient(135deg,#FDF8F0,#FBF1E1);padding:40px 32px;text-align:center;">
                    <p style="font-size:9px;letter-spacing:4px;color:#C9A96E;text-transform:uppercase;margin-bottom:10px;">THE WEDDING OF</p>
                    <p class="font-serif" style="font-size:30px;color:#3d2b1f;">Budi Santoso</p>
                    <p style="font-size:18px;color:#C9A96E;margin:4px 0;">&</p>
                    <p class="font-serif" style="font-size:30px;color:#3d2b1f;">Sari Dewi</p>
                    <div style="width:40px;height:1px;background:#C9A96E;margin:16px auto;"></div>
                    <p style="font-size:12px;color:#888;">Sabtu, 20 September 2026</p>
                    <p style="font-size:11px;color:#aaa;margin-top:4px;">📍 Gedung Serbaguna Harmoni</p>
                </div>
                <div style="padding:16px;display:flex;justify-content:center;">
                    <div style="background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;padding:12px 32px;border-radius:50px;font-size:14px;font-weight:600;">Buka Undangan 💌</div>
                </div>
            </div>
        </div>

        {{-- Other templates grid --}}
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
            @foreach([
                ['Minimalist White','Bersih, elegan, dan modern. Tampilan minimalis yang tidak lekang oleh waktu.','#F8F8F8','border:1px solid #E8E8E8','#333','Gratis'],
                ['Rustic Garden','Hangat dengan sentuhan bunga dan alam. Cocok untuk pernikahan outdoor.','linear-gradient(135deg,#F5EFE6,#EDE3D5)','border:1px solid #D4C5B0','#5D4037','Premium'],
                ['Modern Navy','Elegan bernuansa biru navy yang maskulin dan mewah.','linear-gradient(135deg,#1A2F4E,#243B55)','border:none','#FFFFFF','Premium'],
            ] as [$name, $desc, $bg, $border, $textColor, $badge])
            <div class="card-hover" style="border-radius:20px;overflow:hidden;background:{{ $bg }};{{ $border }};">
                <div style="padding:40px 24px;text-align:center;min-height:200px;display:flex;flex-direction:column;align-items:center;justify-content:center;">
                    <p class="font-serif" style="font-size:26px;color:{{ $textColor }};margin-bottom:4px;">The Wedding Of</p>
                    <p class="font-serif" style="font-size:18px;color:{{ $textColor }};opacity:0.7;">Nama & Nama</p>
                </div>
                <div style="background:white;padding:20px 24px;border-top:1px solid rgba(0,0,0,0.06);">
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;">
                        <h3 style="font-size:16px;font-weight:700;color:#1A1A2E;">{{ $name }}</h3>
                        <span style="background:{{ $badge === 'Gratis' ? '#E8F5E9' : '#FFF3E0' }};color:{{ $badge === 'Gratis' ? '#2E7D32' : '#E65100' }};font-size:11px;font-weight:600;padding:3px 10px;border-radius:50px;">{{ $badge }}</span>
                    </div>
                    <p style="font-size:13px;color:#6B6B7B;">{{ $desc }}</p>
                    <a href="{{ route('register') }}" style="display:block;text-align:center;margin-top:16px;padding:10px;background:{{ $badge === 'Gratis' ? 'linear-gradient(135deg,#C9A96E,#A0824A)' : '#F5F5F5' }};color:{{ $badge === 'Gratis' ? 'white' : '#333' }};border-radius:12px;font-size:13px;font-weight:600;text-decoration:none;transition:all 0.2s;">
                        {{ $badge === 'Gratis' ? 'Pakai Template' : 'Lihat Template' }} →
                    </a>
                </div>
            </div>
            @endforeach
        </div>

        <div style="text-align:center;margin-top:40px;">
            <a href="{{ route('register') }}" class="btn-outline">Lihat Semua Template (200+) →</a>
        </div>
    </div>
</section>

{{-- ===== TESTIMONIAL ===== --}}
<section style="padding:100px 24px;background:var(--cream);">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:64px;">
            <div class="section-tag">Testimoni</div>
            <h2 class="font-serif" style="font-size:44px;color:#1A1A2E;margin-bottom:16px;font-weight:600;">Kata Pasangan Bahagia</h2>
            <p style="color:#6B6B7B;font-size:16px;">Dipercaya ribuan pasangan di seluruh Indonesia</p>
        </div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;">
            @foreach([
                ['Anita & Dimas', 'Jakarta', 'UndanganKu bikin undangan pernikahan kami jadi lebih berkesan. Tamu-tamu sangat terkesan dengan tampilan digitalnya. RSVP online sangat membantu!', '5', 'Elegant Gold'],
                ['Rina & Bowo', 'Surabaya', 'Mudah sekali digunakan! Dalam 30 menit undangan sudah jadi dan langsung bisa dibagikan ke grup WhatsApp. Harganya juga terjangkau.', '5', 'Minimalist'],
                ['Dewi & Fajar', 'Bandung', 'Fitur personalnya keren banget — setiap tamu dapat link dengan namanya sendiri. Banyak yang tanya pakai aplikasi apa, langsung rekomen UndanganKu!', '5', 'Elegant Gold'],
            ] as [$name, $city, $review, $stars, $template])
            <div style="background:white;border-radius:20px;padding:28px;border:1px solid #F0EDE8;position:relative;">
                <div style="font-size:24px;color:#C9A96E;font-family:Georgia,serif;position:absolute;top:20px;right:24px;opacity:0.3;">"</div>
                <div style="display:flex;gap:2px;margin-bottom:16px;">
                    @for($i=0;$i<5;$i++)<span style="color:#C9A96E;font-size:16px;">★</span>@endfor
                </div>
                <p style="font-size:14px;line-height:1.75;color:#4A4A5A;margin-bottom:20px;font-style:italic;">"{{ $review }}"</p>
                <div style="display:flex;align-items:center;justify-content:space-between;padding-top:20px;border-top:1px solid #F5F5F5;">
                    <div style="display:flex;align-items:center;gap:12px;">
                        <div style="width:44px;height:44px;background:linear-gradient(135deg,#C9A96E,#A0824A);border-radius:50%;display:flex;align-items:center;justify-content:center;color:white;font-weight:700;font-size:16px;">{{ substr($name,0,1) }}</div>
                        <div>
                            <div style="font-size:14px;font-weight:700;color:#1A1A2E;">{{ $name }}</div>
                            <div style="font-size:12px;color:#9B9BAB;">{{ $city }}</div>
                        </div>
                    </div>
                    <span style="font-size:11px;background:#FDF8F0;color:#A0824A;padding:3px 10px;border-radius:50px;border:1px solid #E8D5B0;">{{ $template }}</span>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ===== PRICING ===== --}}
<section id="harga" style="padding:100px 24px;background:#fff;">
    <div style="max-width:1000px;margin:0 auto;text-align:center;">
        <div class="section-tag">Harga</div>
        <h2 class="font-serif" style="font-size:44px;color:#1A1A2E;margin-bottom:16px;font-weight:600;">Harga Transparan, Tanpa Biaya Tersembunyi</h2>
        <p style="color:#6B6B7B;font-size:16px;margin-bottom:64px;">Mulai gratis selamanya. Upgrade kapan saja tanpa kontrak.</p>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:24px;align-items:start;">
            @foreach([
                ['Basic', 'Gratis', 'Selamanya', ['1 undangan aktif', 'Template gratis', 'RSVP & Buku Tamu', 'Link personal tamu', 'Galeri 5 foto'], false, '#F8F8F8', '#1A1A2E'],
                ['Premium', 'Rp 99.000', '/bulan', ['5 undangan aktif', 'Semua template premium', 'Upload musik latar', 'Galeri 50 foto', 'Analitik lengkap', 'Prioritas support'], true, 'linear-gradient(135deg,#1A1A2E,#2D2D4E)', 'white'],
                ['Business', 'Rp 249.000', '/bulan', ['Unlimited undangan', 'Custom domain', 'White label', 'Galeri unlimited', 'API access', 'Dedicated support'], false, '#F8F8F8', '#1A1A2E'],
            ] as [$name, $price, $per, $features, $popular, $bg, $textColor])
            <div style="background:{{ $bg }};border-radius:24px;padding:36px 28px;position:relative;{{ $popular ? 'transform:scale(1.05);box-shadow:0 20px 60px rgba(201,169,110,0.25);' : 'border:1px solid #F0EDE8;' }}">
                @if($popular)
                <div style="position:absolute;top:-14px;left:50%;transform:translateX(-50%);background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;font-size:11px;font-weight:700;letter-spacing:1.5px;text-transform:uppercase;padding:5px 16px;border-radius:50px;white-space:nowrap;">✨ Paling Populer</div>
                @endif
                <h3 style="font-size:22px;font-weight:700;color:{{ $textColor }};margin-bottom:8px;">{{ $name }}</h3>
                <div style="margin-bottom:8px;">
                    <span class="font-serif" style="font-size:42px;font-weight:600;color:{{ $textColor }};">{{ $price }}</span>
                    <span style="font-size:14px;color:{{ $popular ? 'rgba(255,255,255,0.5)' : '#9B9BAB' }};">{{ $per }}</span>
                </div>
                <div style="height:1px;background:{{ $popular ? 'rgba(255,255,255,0.15)' : '#F0EDE8' }};margin:24px 0;"></div>
                <ul style="list-style:none;text-align:left;margin-bottom:32px;space-y:8px;">
                    @foreach($features as $f)
                    <li style="display:flex;align-items:center;gap:10px;padding:6px 0;font-size:14px;color:{{ $textColor }};{{ !$loop->first ? 'border-top:1px solid '.($popular ? 'rgba(255,255,255,0.08)' : '#F5F5F5').';' : '' }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="{{ $popular ? '#C9A96E' : '#C9A96E' }}" stroke-width="2.5"><path d="M20 6L9 17l-5-5"/></svg>
                        {{ $f }}
                    </li>
                    @endforeach
                </ul>
                <a href="{{ route('register') }}" style="display:block;text-align:center;padding:14px;background:{{ $popular ? 'linear-gradient(135deg,#C9A96E,#A0824A)' : 'linear-gradient(135deg,#1A1A2E,#2D2D4E)' }};color:white;border-radius:50px;font-size:14px;font-weight:700;text-decoration:none;box-shadow:{{ $popular ? '0 8px 24px rgba(201,169,110,0.4)' : '0 4px 12px rgba(0,0,0,0.2)' }};">
                    {{ $name === 'Basic' ? 'Mulai Gratis' : 'Pilih ' . $name }}
                </a>
            </div>
            @endforeach
        </div>
        <p style="margin-top:32px;font-size:13px;color:#9B9BAB;">💳 Pembayaran aman · ↩ Garansi uang kembali 7 hari · 🔒 Data terlindungi</p>
    </div>
</section>

{{-- ===== CTA ===== --}}
<section style="padding:100px 24px;background:linear-gradient(135deg,#1A1A2E 0%,#2D2D4E 50%,#1A1A2E 100%);position:relative;overflow:hidden;">
    <div style="position:absolute;inset:0;background:url('data:image/svg+xml,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"60\" height=\"60\"><circle cx=\"30\" cy=\"30\" r=\"1\" fill=\"rgba(201,169,110,0.15)\"/></svg>') repeat;opacity:0.5;"></div>
    <div style="max-width:700px;margin:0 auto;text-align:center;position:relative;z-index:1;">
        <div style="font-size:48px;margin-bottom:24px;">💌</div>
        <h2 class="font-serif" style="font-size:48px;color:white;margin-bottom:20px;font-weight:600;line-height:1.2;">
            Hari Istimewa Anda <span style="color:#C9A96E;font-style:italic;">Layak</span> yang Terbaik
        </h2>
        <p style="font-size:17px;color:rgba(255,255,255,0.6);margin-bottom:40px;line-height:1.7;">Bergabung dengan lebih dari 10.000 pasangan yang telah mempercayakan undangan digital mereka kepada UndanganKu.</p>
        <div style="display:flex;gap:16px;justify-content:center;flex-wrap:wrap;">
            <a href="{{ route('register') }}" class="btn-primary" style="font-size:16px;padding:16px 40px;">
                Buat Undangan Sekarang — Gratis!
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
            </a>
        </div>
        <p style="font-size:13px;color:rgba(255,255,255,0.3);margin-top:20px;">Tidak perlu kartu kredit · Setup dalam 5 menit · Gratis selamanya untuk paket Basic</p>
    </div>
</section>

{{-- ===== FOOTER ===== --}}
<footer style="background:#0F0F1A;padding:64px 24px 32px;">
    <div style="max-width:1200px;margin:0 auto;">
        <div style="display:grid;grid-template-columns:2fr 1fr 1fr 1fr;gap:48px;margin-bottom:48px;">
            <div>
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:20px;">
                    <div style="width:36px;height:36px;background:linear-gradient(135deg,#C9A96E,#A0824A);border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;">💌</div>
                    <span style="font-family:'Cormorant Garamond',serif;font-size:22px;font-weight:600;color:white;">UndanganKu</span>
                </div>
                <p style="font-size:14px;line-height:1.75;color:rgba(255,255,255,0.4);max-width:260px;">Platform undangan digital pernikahan terbaik dan terpercaya di Indonesia sejak 2024.</p>
            </div>
            @foreach([
                ['Produk', ['Template','Fitur','Harga','Roadmap']],
                ['Perusahaan', ['Tentang Kami','Blog','Karir','Press']],
                ['Bantuan', ['Pusat Bantuan','WhatsApp','Tutorial','FAQ']],
            ] as [$col, $links])
            <div>
                <h4 style="font-size:14px;font-weight:700;color:white;margin-bottom:20px;letter-spacing:0.5px;">{{ $col }}</h4>
                <ul style="list-style:none;space-y:8px;">
                    @foreach($links as $link)
                    <li style="margin-bottom:10px;"><a href="#" style="font-size:14px;color:rgba(255,255,255,0.4);text-decoration:none;transition:color 0.2s;" onmouseover="this.style.color='#C9A96E'" onmouseout="this.style.color='rgba(255,255,255,0.4)'">{{ $link }}</a></li>
                    @endforeach
                </ul>
            </div>
            @endforeach
        </div>
        <div style="border-top:1px solid rgba(255,255,255,0.08);padding-top:32px;display:flex;justify-content:space-between;align-items:center;flex-wrap:wrap;gap:16px;">
            <p style="font-size:13px;color:rgba(255,255,255,0.25);">© {{ date('Y') }} UndanganKu. Hak Cipta Dilindungi.</p>
            <div style="display:flex;gap:24px;">
                @foreach(['Kebijakan Privasi','Syarat & Ketentuan','Cookie'] as $link)
                <a href="#" style="font-size:13px;color:rgba(255,255,255,0.25);text-decoration:none;">{{ $link }}</a>
                @endforeach
            </div>
        </div>
    </div>
</footer>

{{-- Smooth scroll --}}
<script>
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        e.preventDefault();
        const el = document.querySelector(a.getAttribute('href'));
        if (el) el.scrollIntoView({ behavior: 'smooth' });
    });
});
</script>
</body>
</html>
