<div>
@php
    $inv      = $invitation;
    $data     = $inv->getInvitationData();
    $groom    = $data['groom_name']       ?? 'Mempelai Pria';
    $bride    = $data['bride_name']       ?? 'Mempelai Wanita';
    $groomFull= $data['groom_full_name']  ?? $groom;
    $brideFull= $data['bride_full_name']  ?? $bride;
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
    $fontH    = $theme['font_heading']     ?? 'Cormorant Garamond';
    $fontB    = $theme['font_body']        ?? 'Lato';
@endphp

<style>
:root {
    --p: {{ $primary }};
    --p10: {{ $primary }}1A;
    --p20: {{ $primary }}33;
    --p40: {{ $primary }}66;
    --bg: {{ $bg }};
    --fh: '{{ $fontH }}', 'Cormorant Garamond', serif;
    --fb: '{{ $fontB }}', 'Lato', sans-serif;
    --dark: #1a0f05;
    --gray: #6b6058;
    --light: #f5f0e8;
}
* { box-sizing: border-box; margin: 0; padding: 0; }
body { background: var(--bg); font-family: var(--fb); }

/* ── Animations ── */
@@keyframes fadeUp   { from { opacity:0; transform:translateY(28px); } to { opacity:1; transform:translateY(0); } }
@@keyframes fadeIn   { from { opacity:0; } to { opacity:1; } }
@@keyframes scaleIn  { from { opacity:0; transform:scale(.9); } to { opacity:1; transform:scale(1); } }
@@keyframes float    { 0%,100%{ transform:translateY(0); } 50%{ transform:translateY(-6px); } }
@@keyframes spin     { from{ transform:rotate(0deg); } to{ transform:rotate(360deg); } }
@@keyframes ripple   { 0%{ box-shadow:0 0 0 0 var(--p40); } 100%{ box-shadow:0 0 0 18px transparent; } }
@@keyframes shimmer  { 0%{ background-position:-200% 0; } 100%{ background-position:200% 0; } }

.anim-fade-up   { animation: fadeUp  .8s cubic-bezier(.16,1,.3,1) both; }
.anim-fade-in   { animation: fadeIn  .7s ease both; }
.anim-scale-in  { animation: scaleIn .5s ease both; }
.delay-1 { animation-delay:.12s; }
.delay-2 { animation-delay:.24s; }
.delay-3 { animation-delay:.36s; }
.delay-4 { animation-delay:.48s; }
.delay-5 { animation-delay:.60s; }

/* ── Cover ── */
.cover-wrap {
    min-height: 100vh;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    position: relative;
    overflow: hidden;
    background: var(--dark);
    padding: 0 0 60px;
}
.cover-bg {
    position: absolute; inset: 0;
    background: radial-gradient(ellipse at 30% 20%, #3d1f0a 0%, #1a0f05 50%, #0d0a05 100%);
}
.cover-ornament {
    position: absolute;
    opacity: .18;
    pointer-events: none;
}
.cover-frame {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 48px 28px 0;
    width: 100%;
}
.cover-bismillah {
    font-family: var(--fh);
    font-size: 13px;
    color: var(--p);
    letter-spacing: 3px;
    text-transform: uppercase;
    margin-bottom: 28px;
    opacity: .8;
    font-style: italic;
}
.cover-label {
    font-size: 9px;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--p);
    opacity: .7;
    display: block;
    margin-bottom: 16px;
}
.cover-name {
    font-family: 'Great Vibes', cursive;
    font-size: clamp(44px, 14vw, 62px);
    color: white;
    line-height: 1.05;
    font-weight: 400;
    text-shadow: 0 2px 20px rgba(0,0,0,.4);
}
.cover-ampersand {
    font-family: var(--fh);
    font-size: 18px;
    color: var(--p);
    letter-spacing: 6px;
    display: block;
    margin: 8px 0;
    opacity: .8;
}
.cover-date-chip {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,.06);
    border: 1px solid rgba(255,255,255,.12);
    border-radius: 50px;
    padding: 9px 20px;
    font-size: 12px;
    color: rgba(255,255,255,.7);
    letter-spacing: .5px;
    margin-top: 28px;
    backdrop-filter: blur(6px);
}
.cover-date-chip span { color: var(--p); font-weight: 600; }

/* Guest chip */
.guest-chip {
    background: rgba(255,255,255,.07);
    border: 1px solid var(--p);
    border-radius: 16px;
    padding: 10px 20px;
    text-align: center;
    margin: 0 24px 32px;
    position: relative;
    z-index: 2;
}
.guest-chip p { margin: 0; }

/* Open button */
.open-btn-wrap {
    position: absolute;
    bottom: 0;
    left: 0; right: 0;
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-bottom: 44px;
    z-index: 2;
}
.open-btn {
    animation: ripple 2s ease-out infinite;
    background: var(--p);
    color: #1a0f05;
    border: none;
    padding: 15px 40px;
    border-radius: 50px;
    font-size: 13px;
    font-family: var(--fb);
    font-weight: 700;
    letter-spacing: 2px;
    text-transform: uppercase;
    cursor: pointer;
    transition: all .3s;
    box-shadow: 0 8px 28px rgba(0,0,0,.3);
}
.open-btn:hover { transform: translateY(-2px); box-shadow: 0 12px 32px rgba(0,0,0,.35); }
.open-btn-hint {
    margin-top: 12px;
    font-size: 11px;
    color: rgba(255,255,255,.3);
    letter-spacing: 1px;
}

/* ── Section base ── */
.pi-section {
    padding: 64px 24px;
    background: var(--bg);
}
.pi-section-alt {
    padding: 64px 24px;
    background: var(--light);
}
.pi-section-dark {
    padding: 64px 24px;
    background: var(--dark);
}
.section-label {
    font-size: 9px;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--p);
    display: block;
    text-align: center;
    margin-bottom: 8px;
    font-weight: 600;
}
.section-title {
    font-family: var(--fh);
    font-size: 28px;
    font-weight: 600;
    color: var(--dark);
    text-align: center;
    line-height: 1.2;
    font-style: italic;
}
.ornament-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
    margin: 16px auto;
}
.ornament-divider::before,
.ornament-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: linear-gradient(to right, transparent, var(--p40));
    max-width: 80px;
}
.ornament-divider::before { background: linear-gradient(to left, transparent, var(--p40)); }
.ornament-center { color: var(--p); font-size: 14px; }

/* ── Couple ── */
.couple-grid {
    display: grid;
    grid-template-columns: 1fr 40px 1fr;
    gap: 8px;
    align-items: center;
    max-width: 360px;
    margin: 32px auto 0;
}
.couple-card {
    text-align: center;
    padding: 20px 12px;
    background: white;
    border-radius: 20px;
    border: 1px solid var(--p20);
    box-shadow: 0 4px 20px var(--p10);
}
.couple-photo {
    width: 72px; height: 72px;
    border-radius: 50%;
    background: var(--p10);
    border: 2px solid var(--p);
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 12px;
    overflow: hidden;
    font-size: 26px;
}
.couple-photo img { width: 100%; height: 100%; object-fit: cover; }
.couple-name {
    font-family: var(--fh);
    font-size: 18px;
    color: var(--dark);
    font-style: italic;
    font-weight: 600;
    line-height: 1.2;
}
.couple-parents {
    font-size: 10px;
    color: #b0a090;
    margin-top: 6px;
    line-height: 1.7;
}
.couple-sep {
    text-align: center;
    font-size: 22px;
    color: var(--p);
}

/* ── Countdown ── */
.countdown-wrap {
    display: flex;
    justify-content: center;
    gap: 8px;
    margin-top: 24px;
}
.cd-box {
    text-align: center;
    background: white;
    border-radius: 14px;
    padding: 14px 10px 12px;
    min-width: 62px;
    box-shadow: 0 4px 18px var(--p20);
    border: 1px solid var(--p20);
    flex: 1;
    max-width: 80px;
}
.cd-num {
    font-family: var(--fh);
    font-size: 28px;
    font-weight: 700;
    color: var(--p);
    line-height: 1;
    letter-spacing: -1px;
}
.cd-lbl {
    font-size: 8px;
    text-transform: uppercase;
    color: #b0a090;
    margin-top: 5px;
    letter-spacing: 1.5px;
    font-weight: 600;
}

/* ── Event detail ── */
.event-cards {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 12px;
    margin-top: 24px;
}
.event-card-single { grid-template-columns: 1fr; }
.event-card {
    background: white;
    border-radius: 18px;
    padding: 22px 16px;
    text-align: center;
    border: 1.5px solid var(--p20);
    box-shadow: 0 4px 16px var(--p10);
}
.event-card.main {
    background: var(--dark);
    border-color: var(--p);
}
.event-card-type {
    font-size: 9px;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--p);
    font-weight: 700;
    margin-bottom: 10px;
    display: block;
}
.event-card.main .event-card-date { color: white; }
.event-card-date {
    font-family: var(--fh);
    font-size: 17px;
    font-weight: 700;
    color: var(--dark);
    line-height: 1.3;
}
.event-card-time {
    font-size: 12px;
    color: rgba(255,255,255,.5);
    margin-top: 5px;
}
.event-card:not(.main) .event-card-time { color: #b0a090; }
.location-card {
    margin-top: 14px;
    background: var(--light);
    border-radius: 18px;
    padding: 18px 20px;
}
.maps-btn {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 14px;
    background: var(--p);
    color: white;
    text-decoration: none;
    padding: 10px 22px;
    border-radius: 50px;
    font-size: 12px;
    font-weight: 700;
    letter-spacing: .5px;
    transition: all .2s;
}
.maps-btn:hover { opacity: .88; transform: translateY(-1px); }

/* ── Story timeline ── */
.story-text {
    font-size: 14px;
    color: var(--gray);
    line-height: 2.1;
    text-align: center;
    white-space: pre-line;
    font-style: italic;
    max-width: 340px;
    margin: 0 auto;
}

/* ── Gallery ── */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 4px;
    margin-top: 20px;
    border-radius: 16px;
    overflow: hidden;
}
.gallery-grid .g-large {
    grid-column: span 2;
    grid-row: span 2;
}
.gallery-item {
    aspect-ratio: 1;
    overflow: hidden;
    cursor: pointer;
    position: relative;
}
.gallery-item img {
    width: 100%; height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .4s ease;
}
.gallery-item:hover img { transform: scale(1.05); }
.gallery-item::after {
    content: '';
    position: absolute; inset: 0;
    background: rgba(0,0,0,0);
    transition: background .3s;
}
.gallery-item:hover::after { background: rgba(0,0,0,.1); }

/* ── Gift ── */
.gift-card {
    background: white;
    border-radius: 16px;
    padding: 16px 18px;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 14px;
    box-shadow: 0 2px 14px rgba(0,0,0,.06);
    border: 1px solid var(--p20);
}
.gift-icon {
    width: 44px; height: 44px;
    background: var(--p10);
    border-radius: 12px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
    border: 1px solid var(--p20);
}
.gift-info { flex: 1; min-width: 0; }
.gift-bank { font-size: 10px; color: var(--p); font-weight: 700; letter-spacing: .5px; text-transform: uppercase; }
.gift-num { font-size: 15px; font-weight: 700; font-family: monospace; color: var(--dark); margin: 2px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.gift-name { font-size: 11px; color: #b0a090; }
.copy-btn {
    background: var(--p10);
    border: 1.5px solid var(--p40);
    color: var(--p);
    padding: 8px 14px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    flex-shrink: 0;
    transition: all .2s;
    font-family: var(--fb);
}
.copy-btn:hover { background: var(--p); color: white; border-color: var(--p); }
.copy-btn.copied { background: #DCFCE7; color: #15803D; border-color: #BBF7D0; }

/* ── Forms ── */
.pi-input {
    width: 100%;
    border: 1.5px solid #e0d8cf;
    border-radius: 12px;
    padding: 12px 16px;
    font-size: 14px;
    font-family: var(--fb);
    outline: none;
    transition: border-color .2s, box-shadow .2s;
    background: white;
    color: var(--dark);
}
.pi-input:focus { border-color: var(--p); box-shadow: 0 0 0 3px var(--p10); }
.pi-btn {
    width: 100%;
    background: var(--p);
    color: #1a0f05;
    border: none;
    padding: 15px;
    border-radius: 12px;
    font-size: 13px;
    font-family: var(--fb);
    font-weight: 700;
    cursor: pointer;
    letter-spacing: 1px;
    text-transform: uppercase;
    transition: all .2s;
}
.pi-btn:hover { opacity: .88; transform: translateY(-1px); }

/* ── Guestbook ── */
.gb-entry {
    background: white;
    border-radius: 14px;
    padding: 14px 16px;
    margin-bottom: 8px;
    border-left: 3px solid var(--p);
    box-shadow: 0 1px 8px rgba(0,0,0,.04);
}
.gb-name { font-size: 13px; font-weight: 700; color: var(--dark); }
.gb-time { font-size: 10px; color: #c0b8b0; margin-top: 1px; }
.gb-msg { font-size: 13px; color: var(--gray); margin-top: 8px; line-height: 1.7; }

/* ── Music ── */
#music-btn {
    position: fixed; bottom: 24px; right: 20px; z-index: 999;
    background: var(--p); color: #1a0f05; border: none;
    border-radius: 50%; width: 50px; height: 50px;
    font-size: 18px; cursor: pointer;
    box-shadow: 0 4px 18px var(--p40);
    transition: transform .2s, box-shadow .2s;
    display: flex; align-items: center; justify-content: center;
}
#music-btn:hover { transform: scale(1.1); }
#music-btn.playing { animation: ripple 2s infinite; }
#music-btn svg { width: 20px; height: 20px; transition: all .3s; }

/* ── Lightbox ── */
#lightbox {
    position: fixed; inset: 0;
    background: rgba(0,0,0,.95); z-index: 9999;
    display: flex; align-items: center; justify-content: center; padding: 20px;
    cursor: pointer;
}
#lightbox img { max-width: 100%; max-height: 90vh; border-radius: 12px; object-fit: contain; }

/* ── Footer ── */
.inv-footer {
    background: var(--dark);
    text-align: center;
    padding: 56px 24px 48px;
    position: relative;
    overflow: hidden;
}
.footer-ornament {
    position: absolute; top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(to right, transparent, var(--p), transparent);
}

/* ── RSVP attendance options ── */
.attendance-opt { cursor: pointer; }
.attendance-opt input { display: none; }
.attendance-box {
    border: 1.5px solid #e0d8cf;
    border-radius: 12px;
    padding: 10px 6px;
    text-align: center;
    transition: all .2s;
    background: white;
}
.attendance-box.selected {
    border-color: var(--p);
    background: var(--p10);
}
.attendance-icon { font-size: 18px; }
.attendance-lbl { font-size: 10px; font-weight: 600; color: #6b6058; margin-top: 4px; }
.attendance-box.selected .attendance-lbl { color: var(--p); }
</style>

{{-- ═══ MUSIC PLAYER ═══ --}}
@if($inv->music && $inv->music->is_active && $inv->music->path)
<audio id="bg-music" {{ $inv->music->loop ? 'loop' : '' }} preload="none">
    <source src="{{ $inv->music->getUrl() }}" type="audio/mpeg">
</audio>
<button id="music-btn" onclick="toggleMusic()" aria-label="Toggle musik">
    <svg id="music-icon-play" fill="currentColor" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
    <svg id="music-icon-pause" style="display:none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><rect x="6" y="4" width="4" height="16" rx="1"/><rect x="14" y="4" width="4" height="16" rx="1"/></svg>
</button>
<script>
var _music = null, _playing = false;
document.addEventListener('DOMContentLoaded', function() {
    _music = document.getElementById('bg-music');
    @if($inv->music->auto_play)
    setTimeout(function() {
        if (_music) {
            _music.play().then(function() {
                _playing = true;
                document.getElementById('music-icon-play').style.display = 'none';
                document.getElementById('music-icon-pause').style.display = '';
                document.getElementById('music-btn').classList.add('playing');
            }).catch(function(){});
        }
    }, 1200);
    @endif
});
function toggleMusic() {
    if (!_music) return;
    if (_playing) {
        _music.pause(); _playing = false;
        document.getElementById('music-icon-play').style.display = '';
        document.getElementById('music-icon-pause').style.display = 'none';
        document.getElementById('music-btn').classList.remove('playing');
    } else {
        _music.play(); _playing = true;
        document.getElementById('music-icon-play').style.display = 'none';
        document.getElementById('music-icon-pause').style.display = '';
        document.getElementById('music-btn').classList.add('playing');
    }
}
</script>
@endif

{{-- ═══ LIGHTBOX ═══ --}}
<div id="lightbox" style="display:none;" onclick="closeLightbox()">
    <img id="lightbox-img" src="" alt="Foto Galeri">
</div>
<script>
function openLightbox(src) { document.getElementById('lightbox-img').src=src; document.getElementById('lightbox').style.display='flex'; document.body.style.overflow='hidden'; }
function closeLightbox() { document.getElementById('lightbox').style.display='none'; document.body.style.overflow=''; }
document.addEventListener('keydown',function(e){ if(e.key==='Escape') closeLightbox(); });
</script>

{{-- ═══════════════════════════════════════ --}}
{{-- ═══ COVER ═══ --}}
{{-- ═══════════════════════════════════════ --}}
@if($sections['cover'] ?? true)
<section class="cover-wrap">
    <div class="cover-bg"></div>

    {{-- Ornament circles --}}
    <div class="cover-ornament" style="top:-60px;left:-60px;width:280px;height:280px;border-radius:50%;border:1px solid {{ $primary }};">
    </div>
    <div class="cover-ornament" style="bottom:-80px;right:-80px;width:320px;height:320px;border-radius:50%;border:1px solid {{ $primary }};">
    </div>
    <div class="cover-ornament" style="top:50%;left:50%;transform:translate(-50%,-50%);width:500px;height:500px;border-radius:50%;border:1px solid {{ $primary }}22;">
    </div>

    {{-- Corner ornaments --}}
    <svg class="cover-ornament" style="top:0;left:0;width:120px;height:120px;" viewBox="0 0 120 120" fill="none">
        <path d="M10 10 Q60 10 60 60 Q60 10 110 10" stroke="{{ $primary }}" stroke-width="1" opacity=".6"/>
        <path d="M10 10 L10 50" stroke="{{ $primary }}" stroke-width="1" opacity=".4"/>
        <path d="M10 10 L50 10" stroke="{{ $primary }}" stroke-width="1" opacity=".4"/>
        <circle cx="10" cy="10" r="3" fill="{{ $primary }}" opacity=".6"/>
        <circle cx="50" cy="10" r="1.5" fill="{{ $primary }}" opacity=".3"/>
        <circle cx="10" cy="50" r="1.5" fill="{{ $primary }}" opacity=".3"/>
    </svg>
    <svg class="cover-ornament" style="top:0;right:0;width:120px;height:120px;transform:scaleX(-1);" viewBox="0 0 120 120" fill="none">
        <path d="M10 10 Q60 10 60 60 Q60 10 110 10" stroke="{{ $primary }}" stroke-width="1" opacity=".6"/>
        <path d="M10 10 L10 50" stroke="{{ $primary }}" stroke-width="1" opacity=".4"/>
        <path d="M10 10 L50 10" stroke="{{ $primary }}" stroke-width="1" opacity=".4"/>
        <circle cx="10" cy="10" r="3" fill="{{ $primary }}" opacity=".6"/>
    </svg>
    <svg class="cover-ornament" style="bottom:0;left:0;width:120px;height:120px;transform:scaleY(-1);" viewBox="0 0 120 120" fill="none">
        <path d="M10 10 Q60 10 60 60 Q60 10 110 10" stroke="{{ $primary }}" stroke-width="1" opacity=".6"/>
        <path d="M10 10 L10 50" stroke="{{ $primary }}" stroke-width="1" opacity=".4"/>
        <path d="M10 10 L50 10" stroke="{{ $primary }}" stroke-width="1" opacity=".4"/>
        <circle cx="10" cy="10" r="3" fill="{{ $primary }}" opacity=".6"/>
    </svg>
    <svg class="cover-ornament" style="bottom:0;right:0;width:120px;height:120px;transform:scale(-1);" viewBox="0 0 120 120" fill="none">
        <path d="M10 10 Q60 10 60 60 Q60 10 110 10" stroke="{{ $primary }}" stroke-width="1" opacity=".6"/>
        <path d="M10 10 L10 50" stroke="{{ $primary }}" stroke-width="1" opacity=".4"/>
        <path d="M10 10 L50 10" stroke="{{ $primary }}" stroke-width="1" opacity=".4"/>
        <circle cx="10" cy="10" r="3" fill="{{ $primary }}" opacity=".6"/>
    </svg>

    {{-- Guest chip --}}
    @if($guestName)
    <div class="anim-fade-up guest-chip" style="position:relative;z-index:2;margin-top:60px;">
        <p style="font-size:10px;color:rgba(255,255,255,.4);letter-spacing:2px;text-transform:uppercase;">Kepada Yth.</p>
        <p style="font-size:15px;font-weight:700;color:white;margin-top:3px;">{{ $guestName }}</p>
    </div>
    @endif

    {{-- Main cover content --}}
    <div class="cover-frame {{ $guestName ? '' : 'anim-fade-up' }}" style="{{ $guestName ? 'padding-top:80px;' : '' }}">
        <p class="anim-fade-up cover-bismillah">✦ Undangan Pernikahan ✦</p>

        <div class="anim-fade-up delay-1">
            <span class="cover-label">The Wedding Of</span>
        </div>

        <div class="anim-fade-up delay-2">
            <div class="cover-name">{{ $groom }}</div>
            <span class="cover-ampersand">— & —</span>
            <div class="cover-name">{{ $bride }}</div>
        </div>

        @if($eventDate)
        <div class="anim-fade-up delay-3">
            <div class="cover-date-chip">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                <span>{{ \Carbon\Carbon::parse($eventDate)->translatedFormat('d F Y') }}</span>
            </div>
        </div>
        @endif

        {{-- Divider ornament --}}
        <div class="anim-fade-up delay-4" style="margin-top:32px;opacity:.3;display:flex;justify-content:center;">
            <svg width="180" height="20" viewBox="0 0 180 20" fill="none">
                <line x1="0" y1="10" x2="60" y2="10" stroke="{{ $primary }}" stroke-width=".8"/>
                <circle cx="70" cy="10" r="2" fill="{{ $primary }}"/>
                <circle cx="80" cy="10" r="1" fill="{{ $primary }}"/>
                <circle cx="90" cy="10" r="3" fill="{{ $primary }}"/>
                <circle cx="100" cy="10" r="1" fill="{{ $primary }}"/>
                <circle cx="110" cy="10" r="2" fill="{{ $primary }}"/>
                <line x1="120" y1="10" x2="180" y2="10" stroke="{{ $primary }}" stroke-width=".8"/>
            </svg>
        </div>

        <div style="height:100px;"></div>
    </div>

    @if(!$isOpened)
    <div class="open-btn-wrap anim-fade-up delay-5">
        <button wire:click="openInvitation" class="open-btn">
            💌 Buka Undangan
        </button>
        <p class="open-btn-hint">sentuh untuk membuka</p>
    </div>
    @else
    <div style="height:60px;"></div>
    @endif
</section>
@endif

{{-- ═══════════════════════════════════════ --}}
{{-- ═══ CONTENT (shown after opening) ═══ --}}
{{-- ═══════════════════════════════════════ --}}
@if($isOpened)

{{-- ── Couple ── --}}
@if($sections['couple'] ?? true)
<section class="pi-section anim-fade-up">
    <span class="section-label">✦ Mempelai ✦</span>
    <div class="ornament-divider"><span class="ornament-center">♡</span></div>
    <p class="section-title">Dua Hati Menjadi Satu</p>

    <div class="couple-grid">
        <div class="couple-card">
            <div class="couple-photo">
                @if($data['groom_photo'] ?? null)
                    <img src="{{ $data['groom_photo'] }}" alt="{{ $groom }}">
                @else
                    🤵
                @endif
            </div>
            <div class="couple-name">{{ $groom }}</div>
            @php $gFull = $data['groom_full_name'] ?? ''; @endphp
            @if($gFull && $gFull !== $groom)
            <p style="font-size:10px;color:#b0a090;margin-top:4px;">{{ $gFull }}</p>
            @endif
            @if($data['groom_father'] ?? '')
            <p class="couple-parents">Putra dari<br>{{ $data['groom_father'] }}@if($data['groom_mother'] ?? '') & {{ $data['groom_mother'] }}@endif</p>
            @endif
        </div>

        <div class="couple-sep">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="{{ $primary }}">
                <path d="M16 28s-12-8-12-16a8 8 0 0116 0 8 8 0 0116 0c0 8-12 16-12 16z" opacity=".3"/>
                <path d="M16 24s-9-6-9-12a5 5 0 0110 0 5 5 0 0110 0c0 6-9 12-9 12z"/>
            </svg>
        </div>

        <div class="couple-card">
            <div class="couple-photo">
                @if($data['bride_photo'] ?? null)
                    <img src="{{ $data['bride_photo'] }}" alt="{{ $bride }}">
                @else
                    👰
                @endif
            </div>
            <div class="couple-name">{{ $bride }}</div>
            @php $bFull = $data['bride_full_name'] ?? ''; @endphp
            @if($bFull && $bFull !== $bride)
            <p style="font-size:10px;color:#b0a090;margin-top:4px;">{{ $bFull }}</p>
            @endif
            @if($data['bride_father'] ?? '')
            <p class="couple-parents">Putri dari<br>{{ $data['bride_father'] }}@if($data['bride_mother'] ?? '') & {{ $data['bride_mother'] }}@endif</p>
            @endif
        </div>
    </div>
</section>
@endif

{{-- ── Countdown ── --}}
@if(($sections['countdown'] ?? true) && $eventDate)
<section class="pi-section-alt" style="text-align:center;">
    <span class="section-label">✦ Menuju Hari Bahagia ✦</span>
    <div class="ornament-divider"><span class="ornament-center">⌛</span></div>
    <p class="section-title">Hitung Mundur</p>

    <div class="countdown-wrap" id="countdown-wrap">
        <div class="cd-box">
            <div class="cd-num" id="cd-days">--</div>
            <div class="cd-lbl">Hari</div>
        </div>
        <div class="cd-box">
            <div class="cd-num" id="cd-hours">--</div>
            <div class="cd-lbl">Jam</div>
        </div>
        <div class="cd-box">
            <div class="cd-num" id="cd-mins">--</div>
            <div class="cd-lbl">Menit</div>
        </div>
        <div class="cd-box">
            <div class="cd-num" id="cd-secs">--</div>
            <div class="cd-lbl">Detik</div>
        </div>
    </div>
    <script>
    (function(){
        var target = new Date('{{ $eventDate }}T{{ $eventTime ?? "08:00" }}:00');
        function pad(v){ return String(v).padStart(2,'0'); }
        function update(){
            var now = new Date(), diff = target - now;
            var wrap = document.getElementById('countdown-wrap');
            if(diff <= 0){
                document.getElementById('cd-days').textContent='00';
                document.getElementById('cd-hours').textContent='00';
                document.getElementById('cd-mins').textContent='00';
                document.getElementById('cd-secs').textContent='00';
                return;
            }
            var d = Math.floor(diff/86400000);
            var h = Math.floor((diff%86400000)/3600000);
            var m = Math.floor((diff%3600000)/60000);
            var s = Math.floor((diff%60000)/1000);
            document.getElementById('cd-days').textContent  = d;
            document.getElementById('cd-hours').textContent = pad(h);
            document.getElementById('cd-mins').textContent  = pad(m);
            document.getElementById('cd-secs').textContent  = pad(s);
        }
        update(); setInterval(update, 1000);
    })();
    </script>
</section>
@endif

{{-- ── Event Details ── --}}
<section class="pi-section" style="text-align:center;">
    <span class="section-label">✦ Detail Acara ✦</span>
    <div class="ornament-divider"><span class="ornament-center">📅</span></div>
    <p class="section-title">Waktu & Tempat</p>

    <div class="event-cards {{ !$akadDate ? 'event-card-single' : '' }}">
        @if($akadDate)
        <div class="event-card">
            <span class="event-card-type">Akad Nikah</span>
            <div class="event-card-date">{{ \Carbon\Carbon::parse($akadDate)->translatedFormat('d F Y') }}</div>
            @if($akadTime)<div class="event-card-time" style="color:#b0a090;">{{ $akadTime }} WIB</div>@endif
        </div>
        @endif
        @if($eventDate)
        <div class="event-card main">
            <span class="event-card-type">Resepsi</span>
            <div class="event-card-date">{{ \Carbon\Carbon::parse($eventDate)->translatedFormat('d F Y') }}</div>
            @if($eventTime)<div class="event-card-time">{{ $eventTime }} WIB</div>@endif
        </div>
        @endif
    </div>

    @if($loc)
    <div class="location-card" style="text-align:left;">
        <div style="display:flex;gap:12px;align-items:flex-start;">
            <div style="width:38px;height:38px;background:var(--p10);border-radius:10px;display:flex;align-items:center;justify-content:center;flex-shrink:0;border:1px solid var(--p20);">
                <svg width="16" height="16" fill="none" stroke="var(--p)" stroke-width="2" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div>
                <p style="font-weight:700;color:var(--dark);font-size:14px;margin-bottom:4px;">{{ $loc }}</p>
                @if($locAddr)<p style="font-size:12px;color:#9a9088;line-height:1.6;">{{ $locAddr }}</p>@endif
            </div>
        </div>
        @if($mapsUrl)
        <div style="text-align:center;margin-top:16px;">
            <a href="{{ $mapsUrl }}" target="_blank" rel="noopener" class="maps-btn">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Buka Google Maps
            </a>
        </div>
        @endif
    </div>
    @endif
</section>

{{-- ── Love Story ── --}}
@if(($sections['story'] ?? true) && $story)
<section class="pi-section-alt" style="text-align:center;">
    <span class="section-label">✦ Kisah Cinta ✦</span>
    <div class="ornament-divider"><span class="ornament-center">💕</span></div>
    <p class="section-title">Perjalanan Kita</p>
    <p class="story-text" style="margin-top:20px;">{{ $story }}</p>
</section>
@endif

{{-- ── Gallery ── --}}
@if(($sections['gallery'] ?? true) && $inv->galleries->isNotEmpty())
<section class="pi-section" style="text-align:center;">
    <span class="section-label">✦ Momen Indah ✦</span>
    <div class="ornament-divider"><span class="ornament-center">📸</span></div>
    <p class="section-title">Galeri Foto</p>

    @php $photos = $inv->galleries; @endphp
    <div class="gallery-grid" style="margin-top:20px;">
        @foreach($photos as $i => $gallery)
        @php $isLarge = $i === 0 && $photos->count() >= 3; @endphp
        <div class="gallery-item {{ $isLarge ? 'g-large' : '' }}" onclick="openLightbox('{{ $gallery->getUrl() }}')">
            <img src="{{ $gallery->getUrl() }}" alt="Foto {{ $i+1 }}" loading="{{ $i < 3 ? 'eager' : 'lazy' }}">
        </div>
        @endforeach
    </div>
    <p style="font-size:11px;color:#c0b8b0;margin-top:10px;letter-spacing:.5px;">Sentuh foto untuk memperbesar</p>
</section>
@endif

{{-- ── Digital Gift ── --}}
@if(($sections['gift'] ?? true) && $inv->digitalGifts->where('is_visible',true)->isNotEmpty())
<section class="pi-section-alt">
    <span class="section-label" style="text-align:center;display:block;">✦ Hadiah Digital ✦</span>
    <div class="ornament-divider"><span class="ornament-center">🎁</span></div>
    <p class="section-title" style="text-align:center;">Kirim Hadiah</p>
    <p style="font-size:13px;color:#9a9088;text-align:center;margin:10px 0 24px;line-height:1.7;">Doa restu Anda adalah hadiah terbaik bagi kami. Jika ingin memberikan hadiah, dapat ditransfer ke rekening berikut.</p>

    @foreach($inv->digitalGifts->where('is_visible',true) as $gift)
    <div class="gift-card">
        <div class="gift-icon">{{ $gift->icon ?? '💳' }}</div>
        <div class="gift-info">
            <div class="gift-bank">{{ $gift->label }}@if($gift->bank_name) · {{ $gift->bank_name }}@endif</div>
            <div class="gift-num">{{ $gift->account_number }}</div>
            <div class="gift-name">a/n {{ $gift->account_name }}</div>
        </div>
        <button class="copy-btn"
            onclick="(function(btn,num){ navigator.clipboard.writeText(num).then(function(){ btn.classList.add('copied'); btn.textContent='✓ Disalin'; setTimeout(function(){ btn.classList.remove('copied'); btn.textContent='Salin'; },2200); }); })(this,'{{ $gift->account_number }}')">
            Salin
        </button>
    </div>
    @endforeach
</section>
@endif

{{-- ── RSVP ── --}}
@if($sections['rsvp'] ?? true)
<section class="pi-section">
    <span class="section-label" style="text-align:center;display:block;">✦ Konfirmasi Kehadiran ✦</span>
    <div class="ornament-divider"><span class="ornament-center">✉️</span></div>
    <p class="section-title" style="text-align:center;">Hadir atau Tidak?</p>

    @if($rsvpSent)
    <div class="anim-scale-in" style="background:#F0FDF4;border:1.5px solid #BBF7D0;border-radius:20px;padding:36px 24px;margin-top:28px;text-align:center;">
        <div style="font-size:48px;margin-bottom:14px;">🎉</div>
        <p style="font-size:18px;font-weight:700;color:#166534;font-family:var(--fh);font-style:italic;">Terima Kasih!</p>
        <p style="font-size:13px;color:#4ADE80;margin-top:8px;line-height:1.7;">Konfirmasi kehadiran Anda telah kami terima.<br>Kami sangat menantikan kehadiran Anda.</p>
    </div>
    @else
    <form wire:submit="submitRsvp" style="text-align:left;margin-top:28px;">
        <div style="margin-bottom:14px;">
            <label style="display:block;font-size:11px;font-weight:700;color:#6b6058;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Nama Lengkap</label>
            <input type="text" wire:model="rsvpName" class="pi-input" placeholder="Masukkan nama Anda">
            @error('rsvpName')<span style="color:#EF4444;font-size:11px;display:block;margin-top:4px;">{{ $message }}</span>@enderror
        </div>

        <div style="margin-bottom:14px;">
            <label style="display:block;font-size:11px;font-weight:700;color:#6b6058;margin-bottom:10px;text-transform:uppercase;letter-spacing:.5px;">Konfirmasi Kehadiran</label>
            <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px;">
                @foreach(['attending'=>['✅','Hadir'],'not_attending'=>['❌','Tidak Hadir'],'maybe'=>['🤔','Mungkin']] as $val=>[$ic,$lbl])
                <label class="attendance-opt">
                    <input type="radio" wire:model="rsvpAttendance" value="{{ $val }}">
                    <div class="attendance-box {{ $rsvpAttendance===$val ? 'selected' : '' }}">
                        <div class="attendance-icon">{{ $ic }}</div>
                        <div class="attendance-lbl">{{ $lbl }}</div>
                    </div>
                </label>
                @endforeach
            </div>
        </div>

        <div style="margin-bottom:14px;">
            <label style="display:block;font-size:11px;font-weight:700;color:#6b6058;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Jumlah Tamu</label>
            <input type="number" wire:model="rsvpGuestCount" min="1" max="20" class="pi-input">
        </div>

        <div style="margin-bottom:22px;">
            <label style="display:block;font-size:11px;font-weight:700;color:#6b6058;margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Pesan (Opsional)</label>
            <textarea wire:model="rsvpMessage" rows="3" class="pi-input" style="resize:none;" placeholder="Tulis pesan untuk mempelai..."></textarea>
        </div>

        <button type="submit" class="pi-btn" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="submitRsvp">Kirim Konfirmasi</span>
            <span wire:loading wire:target="submitRsvp">Mengirim...</span>
        </button>
    </form>
    @endif
</section>
@endif

{{-- ── Guestbook ── --}}
@if($sections['guestbook'] ?? true)
<section class="pi-section-alt">
    <span class="section-label" style="display:block;text-align:center;">✦ Buku Tamu ✦</span>
    <div class="ornament-divider"><span class="ornament-center">💌</span></div>
    <p class="section-title" style="text-align:center;">Ucapan & Doa</p>

    @if(!$guestbookSent)
    <form wire:submit="submitGuestbook" style="margin-top:24px;margin-bottom:28px;">
        <div style="margin-bottom:10px;">
            <input type="text" wire:model="guestbookName" class="pi-input" placeholder="Nama Anda">
            @error('guestbookName')<span style="color:#EF4444;font-size:11px;display:block;margin-top:4px;">{{ $message }}</span>@enderror
        </div>
        <div style="margin-bottom:12px;">
            <textarea wire:model="guestbookMessage" rows="3" class="pi-input" style="resize:none;" placeholder="Tulis ucapan dan doa untuk kedua mempelai..."></textarea>
            @error('guestbookMessage')<span style="color:#EF4444;font-size:11px;display:block;margin-top:4px;">{{ $message }}</span>@enderror
        </div>
        <button type="submit" class="pi-btn" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="submitGuestbook">Kirim Ucapan</span>
            <span wire:loading wire:target="submitGuestbook">Mengirim...</span>
        </button>
    </form>
    @else
    <div style="background:#F0FDF4;border:1px solid #BBF7D0;border-radius:14px;padding:16px;margin:24px 0;text-align:center;">
        <p style="font-size:13px;color:#166534;font-weight:700;">✅ Ucapan Anda telah terkirim!</p>
    </div>
    @endif

    @if($inv->guestbookEntries->isNotEmpty())
    <div style="margin-top:8px;">
        @foreach($inv->guestbookEntries->take(10) as $entry)
        <div class="gb-entry">
            <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                <div class="gb-name">{{ $entry->name }}</div>
                <div class="gb-time">{{ $entry->created_at->diffForHumans() }}</div>
            </div>
            <p class="gb-msg">{{ $entry->message }}</p>
        </div>
        @endforeach
    </div>
    @endif
</section>
@endif

{{-- ── Footer ── --}}
<footer class="inv-footer">
    <div class="footer-ornament"></div>

    <div style="opacity:.25;margin-bottom:20px;display:flex;justify-content:center;">
        <svg width="140" height="16" viewBox="0 0 140 16" fill="none">
            <line x1="0" y1="8" x2="40" y2="8" stroke="{{ $primary }}" stroke-width=".8"/>
            <circle cx="48" cy="8" r="2" fill="{{ $primary }}"/>
            <circle cx="58" cy="8" r="1" fill="{{ $primary }}"/>
            <circle cx="70" cy="8" r="3" fill="{{ $primary }}"/>
            <circle cx="82" cy="8" r="1" fill="{{ $primary }}"/>
            <circle cx="92" cy="8" r="2" fill="{{ $primary }}"/>
            <line x1="100" y1="8" x2="140" y2="8" stroke="{{ $primary }}" stroke-width=".8"/>
        </svg>
    </div>

    <p style="font-family:'Great Vibes',cursive;font-size:clamp(28px,9vw,38px);color:white;line-height:1.1;font-weight:400;">{{ $groom }} & {{ $bride }}</p>
    @if($eventDate)
    <p style="font-size:12px;color:rgba(255,255,255,.35);margin:10px 0 0;letter-spacing:1px;">{{ \Carbon\Carbon::parse($eventDate)->translatedFormat('d F Y') }}</p>
    @endif

    <div style="margin-top:32px;padding-top:24px;border-top:1px solid rgba(255,255,255,.07);text-align:center;">
        <a href="{{ route('register') }}" style="font-size:11px;color:rgba(255,255,255,.25);text-decoration:none;letter-spacing:.5px;">
            Dibuat dengan <strong style="color:var(--p);">UndanganKu</strong>
        </a>
    </div>
</footer>

@endif {{-- end isOpened --}}
</div>
