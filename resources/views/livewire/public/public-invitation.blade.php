<div>
@php
    $inv      = $invitation;
    $data     = $inv->getInvitationData();
    $groom    = $data['groom_name']       ?? 'Mempelai Pria';
    $bride    = $data['bride_name']       ?? 'Mempelai Wanita';
    $eventDate= $data['event_date']       ?? null;
    $eventTime= $data['event_time']       ?? null;
    $akadDate = $data['akad_date']        ?? null;
    $akadTime = $data['akad_time']        ?? null;
    $loc      = $data['location']         ?? '';
    $locAddr  = $data['location_address'] ?? '';
    $mapsUrl  = $data['maps_url']         ?? '';
    $story    = $data['story']            ?? '';
    $sections = $inv->getSections();
    $theme    = $inv->getThemeSettings();
    $primary  = $theme['primary_color']    ?? '#C9A96E';
    $bg       = $theme['background_color'] ?? '#fffdf7';
    $fontH    = $theme['font_heading']     ?? 'Playfair Display';
    $fontB    = $theme['font_body']        ?? 'Poppins';
@endphp

<style>
:root {
    --p: {{ $primary }};
    --p10: {{ $primary }}1A;
    --p25: {{ $primary }}40;
    --p40: {{ $primary }}66;
    --bg: {{ $bg }};
    --fh: '{{ $fontH }}', serif;
    --fb: '{{ $fontB }}', sans-serif;
}
*  { box-sizing: border-box; -webkit-tap-highlight-color: transparent; }
body { margin: 0; background: var(--bg); font-family: var(--fb); -webkit-font-smoothing: antialiased; }

.pi-section { padding: 56px 20px; max-width: 600px; margin: 0 auto; }
.pi-section-full { padding: 56px 20px; max-width: 100%; }
.pi-label { font-size: 9px; letter-spacing: 4px; text-transform: uppercase; color: var(--p); margin-bottom: 16px; display: block; font-weight: 600; }
.pi-divider { width: 48px; height: 1px; background: var(--p); margin: 16px auto; }

/* Animations */
@@keyframes fadeUp   { from{ opacity:0; transform:translateY(20px); } to{ opacity:1; transform:translateY(0); } }
@@keyframes fadeIn   { from{ opacity:0; } to{ opacity:1; } }
@@keyframes scaleIn  { from{ opacity:0; transform:scale(.92); } to{ opacity:1; transform:scale(1); } }
@@keyframes pulse    { 0%,100%{ box-shadow:0 0 0 0 var(--p25); } 70%{ box-shadow:0 0 0 10px transparent; } }

.anim-fade-up  { animation: fadeUp  .7s ease both; }
.anim-fade-in  { animation: fadeIn  .6s ease both; }
.anim-scale-in { animation: scaleIn .5s ease both; }
.delay-1 { animation-delay: .15s; }
.delay-2 { animation-delay: .3s; }
.delay-3 { animation-delay: .45s; }

/* Open button pulse */
.open-btn { animation: pulse 2s infinite; }

/* Music button */
#music-btn {
    position: fixed; bottom: 24px; right: 20px; z-index: 999;
    background: var(--p); color: white; border: none;
    border-radius: 50%; width: 52px; height: 52px;
    font-size: 20px; cursor: pointer;
    box-shadow: 0 4px 16px var(--p40);
    transition: transform .2s, box-shadow .2s;
    display: flex; align-items: center; justify-content: center;
}
#music-btn:hover { transform: scale(1.1); }
#music-btn.playing { animation: pulse 2s infinite; }

/* Form inputs */
.pi-input {
    width: 100%; border: 1.5px solid #ddd; border-radius: 12px;
    padding: 12px 16px; font-size: 14px; font-family: var(--fb);
    box-sizing: border-box; outline: none; transition: border-color .2s;
    background: white;
}
.pi-input:focus { border-color: var(--p); }
.pi-btn {
    width: 100%; background: var(--p); color: white; border: none;
    padding: 15px; border-radius: 12px; font-size: 14px;
    font-family: var(--fb); font-weight: 600; cursor: pointer;
    transition: opacity .2s, transform .2s;
}
.pi-btn:hover { opacity: .88; transform: translateY(-1px); }
.pi-btn:active { transform: translateY(0); }

/* Gallery lightbox */
.gallery-item { cursor: pointer; transition: transform .2s; }
.gallery-item:hover { transform: scale(1.03); }
#lightbox {
    position: fixed; inset: 0; background: rgba(0,0,0,.92); z-index: 9999;
    display: flex; align-items: center; justify-content: center; padding: 20px;
    cursor: pointer;
}
#lightbox img { max-width: 100%; max-height: 90vh; border-radius: 12px; object-fit: contain; }

/* Copy button feedback */
.copy-btn { transition: all .2s; }
.copy-btn.copied { background: #DCFCE7 !important; color: #15803D !important; border-color: #BBF7D0 !important; }
</style>

{{-- Music Player --}}
@if($inv->music && $inv->music->is_active && $inv->music->path)
<audio id="bg-music" {{ $inv->music->loop ? 'loop' : '' }} preload="none">
    <source src="{{ $inv->music->getUrl() }}" type="audio/mpeg">
</audio>
<button id="music-btn" onclick="toggleMusic()" aria-label="Toggle musik" title="Toggle musik">
    <span id="music-icon">🎵</span>
</button>
<script>
var _music  = null;
var _playing = false;
document.addEventListener('DOMContentLoaded', function() {
    _music = document.getElementById('bg-music');
    @if($inv->music->auto_play)
    setTimeout(function() {
        if (_music) {
            _music.play().then(function() {
                _playing = true;
                document.getElementById('music-icon').textContent = '⏸';
                document.getElementById('music-btn').classList.add('playing');
            }).catch(function() {});
        }
    }, 1500);
    @endif
});
function toggleMusic() {
    if (!_music) return;
    if (_playing) {
        _music.pause(); _playing = false;
        document.getElementById('music-icon').textContent = '🎵';
        document.getElementById('music-btn').classList.remove('playing');
    } else {
        _music.play(); _playing = true;
        document.getElementById('music-icon').textContent = '⏸';
        document.getElementById('music-btn').classList.add('playing');
    }
}
</script>
@endif

{{-- Lightbox --}}
<div id="lightbox" style="display:none;" onclick="closeLightbox()">
    <img id="lightbox-img" src="" alt="Foto Galeri">
</div>
<script>
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e) { if(e.key==='Escape') closeLightbox(); });
</script>

{{-- ===== COVER ===== --}}
@if($sections['cover'] ?? true)
<section style="min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:60px 24px;background:linear-gradient(180deg,{{ $bg }} 0%,{{ $primary }}0D 100%);max-width:100%;position:relative;overflow:hidden;">
    {{-- Decorative rings --}}
    <div style="position:absolute;top:10%;left:50%;transform:translateX(-50%);width:280px;height:280px;border-radius:50%;border:1px solid {{ $primary }}18;pointer-events:none;"></div>
    <div style="position:absolute;top:10%;left:50%;transform:translateX(-50%);width:380px;height:380px;border-radius:50%;border:1px solid {{ $primary }}0D;pointer-events:none;"></div>

    @if($guestName)
    <div class="anim-fade-up" style="background:white;border:1px solid {{ $primary }}33;border-radius:16px;padding:12px 24px;margin-bottom:32px;font-size:12px;color:#777;box-shadow:0 2px 12px {{ $primary }}14;">
        <p style="margin:0;letter-spacing:1px;">Kepada Yth.</p>
        <p style="font-weight:700;color:#333;margin:4px 0 0;font-size:15px;">{{ $guestName }}</p>
    </div>
    @endif

    <div class="anim-fade-up delay-1">
        <span class="pi-label">✦ The Wedding Of ✦</span>
        <h1 style="font-family:var(--fh);font-size:clamp(40px,10vw,56px);color:#2d1f0f;margin:0;line-height:1.1;">{{ $groom }}</h1>
        <div style="color:var(--p);font-size:24px;margin:12px 0;">&</div>
        <h1 style="font-family:var(--fh);font-size:clamp(40px,10vw,56px);color:#2d1f0f;margin:0;line-height:1.1;">{{ $bride }}</h1>
    </div>

    @if($eventDate)
    <div class="anim-fade-up delay-2" style="margin-top:28px;border:1px solid {{ $primary }}44;border-radius:20px;padding:16px 32px;display:inline-block;background:white;">
        <p style="font-size:15px;color:#7a5c3a;margin:0;font-weight:500;">
            {{ \Carbon\Carbon::parse($eventDate)->translatedFormat('l, d F Y') }}
        </p>
        @if($loc)<p style="font-size:12px;color:#aaa;margin:5px 0 0;">📍 {{ $loc }}</p>@endif
    </div>
    @endif

    @if(!$isOpened)
    <div class="anim-fade-up delay-3" style="margin-top:40px;">
        <button wire:click="openInvitation" class="open-btn"
            style="background:var(--p);color:white;border:none;padding:16px 44px;border-radius:50px;font-size:14px;font-family:var(--fb);font-weight:600;letter-spacing:1px;cursor:pointer;box-shadow:0 6px 24px {{ $primary }}44;transition:all .3s;">
            Buka Undangan 💌
        </button>
        <p style="font-size:11px;color:#bbb;margin-top:12px;">Sentuh untuk membuka undangan</p>
    </div>
    @endif
</section>
@endif

{{-- ===== CONTENT (shown after opening) ===== --}}
@if($isOpened)

{{-- Couple --}}
@if($sections['couple'] ?? true)
<section class="pi-section anim-fade-up" style="text-align:center;padding-top:72px;">
    <span class="pi-label">Mempelai</span>
    <div class="pi-divider"></div>
    <div style="display:grid;grid-template-columns:1fr 56px 1fr;gap:12px;align-items:center;max-width:420px;margin:32px auto 0;">
        <div style="text-align:center;">
            <div style="width:80px;height:80px;border-radius:50%;background:var(--p10);border:2px solid var(--p25);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:28px;">🤵</div>
            <h3 style="font-family:var(--fh);font-size:22px;color:#2d1f0f;margin:0;line-height:1.2;">{{ $groom }}</h3>
            @if($data['groom_father'] ?? '')<p style="font-size:11px;color:#aaa;margin:6px 0 0;">Putra: {{ $data['groom_father'] }}</p>@endif
            @if($data['groom_mother'] ?? '')<p style="font-size:11px;color:#aaa;margin:2px 0 0;">& {{ $data['groom_mother'] }}</p>@endif
        </div>
        <div style="font-size:32px;text-align:center;color:var(--p);">💍</div>
        <div style="text-align:center;">
            <div style="width:80px;height:80px;border-radius:50%;background:var(--p10);border:2px solid var(--p25);display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:28px;">👰</div>
            <h3 style="font-family:var(--fh);font-size:22px;color:#2d1f0f;margin:0;line-height:1.2;">{{ $bride }}</h3>
            @if($data['bride_father'] ?? '')<p style="font-size:11px;color:#aaa;margin:6px 0 0;">Putri: {{ $data['bride_father'] }}</p>@endif
            @if($data['bride_mother'] ?? '')<p style="font-size:11px;color:#aaa;margin:2px 0 0;">& {{ $data['bride_mother'] }}</p>@endif
        </div>
    </div>
</section>
@endif

{{-- Countdown --}}
@if(($sections['countdown'] ?? true) && $eventDate)
<section style="text-align:center;padding:48px 20px;background:var(--p10);max-width:100%;">
    <div style="max-width:520px;margin:0 auto;">
        <span class="pi-label">⏳ Menuju Hari Bahagia</span>
        <div style="display:flex;justify-content:center;gap:12px;margin-top:16px;" id="countdown-wrap">
            @foreach(['days'=>'Hari','hours'=>'Jam','mins'=>'Menit','secs'=>'Detik'] as $id => $lbl)
            <div style="text-align:center;background:white;padding:16px 12px;border-radius:16px;min-width:64px;box-shadow:0 2px 12px var(--p25);">
                <div style="font-size:32px;font-weight:700;color:var(--p);line-height:1;" id="cd-{{ $id }}">--</div>
                <div style="font-size:9px;text-transform:uppercase;color:#aaa;margin-top:4px;letter-spacing:1px;">{{ $lbl }}</div>
            </div>
            @endforeach
        </div>
        <script>
        (function(){
            var target = new Date('{{ $eventDate }}T{{ $eventTime ?? "08:00" }}:00');
            function update(){
                var now = new Date(), diff = target - now;
                if(diff <= 0){
                    ['days','hours','mins','secs'].forEach(function(id){ var el=document.getElementById('cd-'+id); if(el) el.textContent='0'; });
                    return;
                }
                var d=Math.floor(diff/86400000), h=Math.floor((diff%86400000)/3600000);
                var m=Math.floor((diff%3600000)/60000), s=Math.floor((diff%60000)/1000);
                function f(id,v){ var el=document.getElementById('cd-'+id); if(el) el.textContent=String(v).padStart(2,'0'); }
                f('days',d); f('hours',h); f('mins',m); f('secs',s);
            }
            update(); setInterval(update,1000);
        })();
        </script>
    </div>
</section>
@endif

{{-- Event Details --}}
<section class="pi-section" style="text-align:center;">
    <span class="pi-label">📅 Detail Acara</span>
    <div class="pi-divider"></div>
    <div style="display:grid;grid-template-columns:{{ $akadDate && $eventDate ? '1fr 1fr' : '1fr' }};gap:16px;margin-top:24px;max-width:400px;margin-left:auto;margin-right:auto;">
        @if($akadDate)
        <div style="border:1.5px solid var(--p25);border-radius:18px;padding:24px 16px;background:white;">
            <p style="font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--p);margin:0 0 8px;font-weight:600;">Akad Nikah</p>
            <p style="font-size:15px;font-weight:700;color:#2d1f0f;margin:0;">{{ \Carbon\Carbon::parse($akadDate)->translatedFormat('d F Y') }}</p>
            @if($akadTime)<p style="font-size:12px;color:#aaa;margin:4px 0 0;">{{ $akadTime }} WIB</p>@endif
        </div>
        @endif
        @if($eventDate)
        <div style="border:1.5px solid var(--p);border-radius:18px;padding:24px 16px;background:var(--p10);">
            <p style="font-size:10px;letter-spacing:2px;text-transform:uppercase;color:var(--p);margin:0 0 8px;font-weight:600;">Resepsi</p>
            <p style="font-size:15px;font-weight:700;color:#2d1f0f;margin:0;">{{ \Carbon\Carbon::parse($eventDate)->translatedFormat('d F Y') }}</p>
            @if($eventTime)<p style="font-size:12px;color:#aaa;margin:4px 0 0;">{{ $eventTime }} WIB</p>@endif
        </div>
        @endif
    </div>
    @if($loc)
    <div style="margin-top:20px;background:var(--p10);border-radius:18px;padding:20px 24px;text-align:left;">
        <div style="display:flex;gap:10px;align-items:flex-start;">
            <div style="font-size:20px;flex-shrink:0;">📍</div>
            <div>
                <p style="font-weight:700;color:#2d1f0f;margin:0;font-size:15px;">{{ $loc }}</p>
                @if($locAddr)<p style="font-size:12px;color:#888;margin:4px 0 0;line-height:1.5;">{{ $locAddr }}</p>@endif
            </div>
        </div>
        @if($mapsUrl)
        <a href="{{ $mapsUrl }}" target="_blank" rel="noopener"
           style="display:inline-flex;align-items:center;gap:6px;margin-top:14px;background:var(--p);color:white;text-decoration:none;padding:10px 20px;border-radius:50px;font-size:12px;font-weight:600;">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            Buka Google Maps
        </a>
        @endif
    </div>
    @endif
</section>

{{-- Story --}}
@if(($sections['story'] ?? true) && $story)
<section style="padding:56px 20px;background:var(--p10);max-width:100%;">
    <div style="max-width:520px;margin:0 auto;text-align:center;">
        <span class="pi-label">💕 Kisah Cinta Kami</span>
        <div class="pi-divider"></div>
        <p style="font-size:14px;color:#555;line-height:2;margin-top:16px;white-space:pre-line;">{{ $story }}</p>
    </div>
</section>
@endif

{{-- Gallery --}}
@if(($sections['gallery'] ?? true) && $inv->galleries->isNotEmpty())
<section style="padding:56px 20px;text-align:center;max-width:100%;">
    <div style="max-width:600px;margin:0 auto;">
        <span class="pi-label">📸 Galeri Foto</span>
        <div class="pi-divider"></div>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:6px;margin-top:24px;">
            @foreach($inv->galleries as $gallery)
            <div class="gallery-item" onclick="openLightbox('{{ $gallery->getUrl() }}')" style="border-radius:10px;overflow:hidden;aspect-ratio:1;">
                <img src="{{ $gallery->getUrl() }}" alt="Foto Galeri" style="width:100%;height:100%;object-fit:cover;display:block;" loading="lazy">
            </div>
            @endforeach
        </div>
        <p style="font-size:11px;color:#ccc;margin-top:12px;">Sentuh foto untuk memperbesar</p>
    </div>
</section>
@endif

{{-- Digital Gift --}}
@if(($sections['gift'] ?? true) && $inv->digitalGifts->where('is_visible',true)->isNotEmpty())
<section style="padding:56px 20px;background:var(--p10);max-width:100%;">
    <div style="max-width:480px;margin:0 auto;text-align:center;">
        <span class="pi-label">🎁 Hadiah Digital</span>
        <div class="pi-divider"></div>
        <p style="font-size:13px;color:#999;margin:12px 0 24px;line-height:1.6;">Jika ingin memberikan hadiah, Anda dapat mentransfer ke rekening berikut</p>
        @foreach($inv->digitalGifts->where('is_visible',true) as $gift)
        <div style="background:white;border-radius:18px;padding:18px 20px;margin-bottom:12px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 2px 12px rgba(0,0,0,.06);text-align:left;">
            <div>
                <p style="font-size:11px;font-weight:700;color:var(--p);margin:0 0 4px;text-transform:uppercase;letter-spacing:.5px;">{{ $gift->icon }} {{ $gift->label }}@if($gift->bank_name) ({{ $gift->bank_name }})@endif</p>
                <p style="font-size:16px;font-weight:700;font-family:monospace;color:#2d1f0f;margin:0;">{{ $gift->account_number }}</p>
                <p style="font-size:12px;color:#aaa;margin:3px 0 0;">a/n {{ $gift->account_name }}</p>
            </div>
            <button class="copy-btn"
                onclick="(function(btn,num){
                    navigator.clipboard.writeText(num).then(function(){
                        btn.classList.add('copied');
                        btn.textContent='✓';
                        setTimeout(function(){ btn.classList.remove('copied'); btn.textContent='Salin'; },2000);
                    });
                })(this,'{{ $gift->account_number }}')"
                style="background:var(--p10);border:1.5px solid var(--p25);color:var(--p);padding:8px 16px;border-radius:10px;font-size:11px;font-weight:600;cursor:pointer;flex-shrink:0;margin-left:12px;">
                Salin
            </button>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- RSVP --}}
@if($sections['rsvp'] ?? true)
<section style="padding:56px 20px;max-width:100%;">
    <div style="max-width:460px;margin:0 auto;text-align:center;">
        <span class="pi-label">✉️ Konfirmasi Kehadiran</span>
        <div class="pi-divider"></div>
        @if($rsvpSent)
        <div class="anim-scale-in" style="background:#F0FDF4;border:1.5px solid #BBF7D0;border-radius:20px;padding:32px 24px;margin-top:24px;">
            <div style="font-size:48px;margin-bottom:12px;">🎉</div>
            <p style="font-size:17px;font-weight:700;color:#166534;margin:0;">Terima kasih!</p>
            <p style="font-size:13px;color:#4ADE80;margin:6px 0 0;">Konfirmasi kehadiran Anda telah kami terima.</p>
        </div>
        @else
        <form wire:submit="submitRsvp" style="text-align:left;margin-top:28px;">
            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:11px;font-weight:700;color:#444;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Nama Lengkap</label>
                <input type="text" wire:model="rsvpName" class="pi-input" placeholder="Masukkan nama Anda">
                @error('rsvpName')<span style="color:#EF4444;font-size:11px;display:block;margin-top:4px;">{{ $message }}</span>@enderror
            </div>
            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:11px;font-weight:700;color:#444;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Konfirmasi Kehadiran</label>
                <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px;">
                    @foreach(['attending'=>['✅','Hadir'],'not_attending'=>['❌','Tidak Hadir'],'maybe'=>['🤔','Mungkin']] as $val=>[$ic,$lbl])
                    <label style="cursor:pointer;">
                        <input type="radio" wire:model="rsvpAttendance" value="{{ $val }}" style="display:none;">
                        <div onclick="this.parentElement.querySelector('input').click()"
                             style="border:1.5px solid {{ $rsvpAttendance===$val ? 'var(--p)' : '#ddd' }};background:{{ $rsvpAttendance===$val ? 'var(--p10)' : 'white' }};border-radius:12px;padding:10px 6px;text-align:center;transition:all .2s;">
                            <div style="font-size:18px;">{{ $ic }}</div>
                            <div style="font-size:10px;font-weight:600;color:#444;margin-top:4px;">{{ $lbl }}</div>
                        </div>
                    </label>
                    @endforeach
                </div>
            </div>
            <div style="margin-bottom:14px;">
                <label style="display:block;font-size:11px;font-weight:700;color:#444;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Jumlah Tamu</label>
                <input type="number" wire:model="rsvpGuestCount" min="1" max="20" class="pi-input">
            </div>
            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:11px;font-weight:700;color:#444;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Pesan (Opsional)</label>
                <textarea wire:model="rsvpMessage" rows="3" class="pi-input" style="resize:none;" placeholder="Tulis pesan untuk mempelai..."></textarea>
            </div>
            <button type="submit" class="pi-btn" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submitRsvp">Kirim Konfirmasi ✓</span>
                <span wire:loading wire:target="submitRsvp">Mengirim...</span>
            </button>
        </form>
        @endif
    </div>
</section>
@endif

{{-- Guestbook --}}
@if($sections['guestbook'] ?? true)
<section style="padding:56px 20px;background:var(--p10);max-width:100%;">
    <div style="max-width:480px;margin:0 auto;">
        <div style="text-align:center;">
            <span class="pi-label">💌 Buku Tamu</span>
            <div class="pi-divider"></div>
        </div>
        @if(!$guestbookSent)
        <form wire:submit="submitGuestbook" style="margin-top:24px;margin-bottom:32px;">
            <div style="margin-bottom:10px;">
                <input type="text" wire:model="guestbookName" class="pi-input" placeholder="Nama Anda">
                @error('guestbookName')<span style="color:#EF4444;font-size:11px;display:block;margin-top:4px;">{{ $message }}</span>@enderror
            </div>
            <div style="margin-bottom:12px;">
                <textarea wire:model="guestbookMessage" rows="3" class="pi-input" style="resize:none;" placeholder="Tulis ucapan selamat untuk kedua mempelai..."></textarea>
                @error('guestbookMessage')<span style="color:#EF4444;font-size:11px;display:block;margin-top:4px;">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="pi-btn" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submitGuestbook">Kirim Ucapan 💌</span>
                <span wire:loading wire:target="submitGuestbook">Mengirim...</span>
            </button>
        </form>
        @else
        <div style="background:#F0FDF4;border:1px solid #BBF7D0;border-radius:14px;padding:16px;margin-bottom:24px;text-align:center;">
            <p style="font-size:13px;color:#166534;margin:0;font-weight:600;">✅ Ucapan Anda telah terkirim!</p>
        </div>
        @endif

        {{-- Entries --}}
        @if($inv->guestbookEntries->isNotEmpty())
        <div>
            @foreach($inv->guestbookEntries as $entry)
            <div style="background:white;border-radius:14px;padding:16px;margin-bottom:10px;box-shadow:0 1px 8px rgba(0,0,0,.05);">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:8px;">
                    <div style="width:34px;height:34px;border-radius:50%;background:var(--p10);border:1px solid var(--p25);display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0;">💌</div>
                    <div>
                        <p style="font-size:13px;font-weight:700;color:#2d1f0f;margin:0;">{{ $entry->name }}</p>
                        <p style="font-size:10px;color:#bbb;margin:0;">{{ $entry->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <p style="font-size:13px;color:#555;margin:0;line-height:1.7;padding-left:44px;">{{ $entry->message }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
</section>
@endif

{{-- Footer --}}
<footer style="text-align:center;padding:48px 24px 36px;background:#2d1f0f;">
    <span class="pi-label" style="color:var(--p);">✦ ✦ ✦</span>
    <p style="font-family:var(--fh);font-size:clamp(22px,6vw,28px);color:white;margin:0;">{{ $groom }} & {{ $bride }}</p>
    @if($eventDate)
    <p style="font-size:12px;color:rgba(255,255,255,.4);margin:10px 0 0;">{{ \Carbon\Carbon::parse($eventDate)->translatedFormat('d F Y') }}</p>
    @endif
    <div style="margin-top:24px;padding-top:20px;border-top:1px solid rgba(255,255,255,.08);">
        <a href="{{ route('register') }}" style="font-size:11px;color:rgba(255,255,255,.3);text-decoration:none;">
            💌 Dibuat dengan <strong style="color:var(--p);">UndanganKu</strong> · Buat undangamu sendiri
        </a>
    </div>
</footer>

@endif {{-- end isOpened --}}
</div>
