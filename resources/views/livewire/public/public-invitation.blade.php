<div>
@php
    $inv      = $invitation;
    $data     = $inv->getInvitationData();
    $groom    = $data['groom_name']        ?? 'Mempelai Pria';
    $bride    = $data['bride_name']        ?? 'Mempelai Wanita';
    $groomFull= $data['groom_full_name']   ?? $groom;
    $brideFull= $data['bride_full_name']   ?? $bride;
    $eventDate= $data['event_date']        ?? null;
    $eventTime= $data['event_time']        ?? null;
    $akadDate = $data['akad_date']         ?? null;
    $akadTime = $data['akad_time']         ?? null;
    $loc      = $data['location']          ?? '';
    $locAddr  = $data['location_address']  ?? '';
    $mapsUrl  = $data['maps_url']          ?? '';
    $story    = $data['story']             ?? '';
    $sections = $inv->getSections();
    $theme    = $inv->getThemeSettings();
    $primary  = $theme['primary_color']    ?? '#C9A96E';
    $galleries= $inv->galleries;
    $coverBg  = $galleries->first()?->getUrl();
    $groomInitial = strtoupper(substr($groom, 0, 1));
    $brideInitial = strtoupper(substr($bride, 0, 1));
    $isFloral = ($themeDir === 'floral-romantic');
@endphp

{{-- ══════════════════════════════════════════════════════════════ --}}
{{-- STYLES                                                         --}}
{{-- ══════════════════════════════════════════════════════════════ --}}
<style>
@@import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400;1,600&family=Poppins:wght@300;400;500;600;700&family=Cinzel+Decorative:wght@400;700&display=swap');

:root {
    --gold:       {{ $primary }};
    --gold-lt:    {{ $primary }}BB;
    --gold-20:    {{ $primary }}33;
    --gold-10:    {{ $primary }}1A;
    --navy:       #0A0E1A;
    --navy2:      #141828;
    --navy3:      #1E2438;
    --cream:      #FAF7F2;
    --cream2:     #F5F0E8;
    --dark-txt:   #1a1008;
    --gray-txt:   #7a6e62;
}

*  { box-sizing: border-box; margin: 0; padding: 0; }
html { background: #111; }

body {
    font-family: 'Poppins', sans-serif;
    background: var(--cream);
    color: var(--dark-txt);
    overflow-x: hidden;
}
body.inv-locked { overflow-y: hidden; }

/* ── Animations ── */
@@keyframes fadeUp    { from { opacity:0; transform:translateY(30px); } to { opacity:1; transform:translateY(0); } }
@@keyframes fadeIn    { from { opacity:0; } to { opacity:1; } }
@@keyframes scaleIn   { from { opacity:0; transform:scale(.9); } to { opacity:1; transform:scale(1); } }
@@keyframes ripple    { 0%{ box-shadow:0 0 0 0 var(--gold-20); } 100%{ box-shadow:0 0 0 20px transparent; } }
@@keyframes floatBtn  { 0%,100%{ transform:translateY(0); } 50%{ transform:translateY(-6px); } }
@@keyframes slideUp   { from{ transform:translateY(0); } to{ transform:translateY(-100vh); } }
@@keyframes seqFadeUp { from{ opacity:0; transform:translateY(24px); } to{ opacity:1; transform:translateY(0); } }
@@keyframes spin      { to{ transform:rotate(360deg); } }
@@keyframes heartbeat { 0%,100%{ transform:scale(1); } 14%{ transform:scale(1.15); } 28%{ transform:scale(1); } 42%{ transform:scale(1.1); } }
@@keyframes kenBurns  { 0%{ transform:scale(1); } 100%{ transform:scale(1.08); } }
@@keyframes slideGallery { 0%,20%{ opacity:1; } 25%,95%{ opacity:0; } 100%{ opacity:1; } }

.reveal {
    opacity: 0;
    transform: translateY(28px);
    transition: opacity .7s cubic-bezier(.16,1,.3,1), transform .7s cubic-bezier(.16,1,.3,1);
}
.reveal.visible { opacity: 1; transform: translateY(0); }
.reveal.from-left { transform: translateX(-28px); }
.reveal.from-right { transform: translateX(28px); }
.reveal.from-left.visible, .reveal.from-right.visible { transform: translateX(0); }
.delay-1 { transition-delay: .1s; }
.delay-2 { transition-delay: .2s; }
.delay-3 { transition-delay: .3s; }
.delay-4 { transition-delay: .45s; }
.delay-5 { transition-delay: .6s; }

/* ══════════════════════════════════
   COVER
══════════════════════════════════ */
#inv-cover {
    position: fixed;
    top: 0; left: 0;
    width: 100%; height: 100vh;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    align-items: center;
    padding: 5vh 24px 8vh;
    text-align: center;
    transition: transform 1.1s cubic-bezier(0.65, 0, 0.35, 1);
    overflow: hidden;
}
#inv-cover.slide-up {
    transform: translateY(-100vh);
    pointer-events: none;
}
#inv-cover .cover-bg {
    position: absolute; inset: 0;
    @if($coverBg)
    background: url('{{ $coverBg }}') center/cover no-repeat;
    animation: kenBurns 20s ease-in-out infinite alternate;
    @else
    background: radial-gradient(ellipse at 30% 20%, #2d1a06 0%, #1a0e05 45%, #0d0a08 100%);
    @endif
}
#inv-cover .cover-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(
        to bottom,
        rgba(5,5,10,.55) 0%,
        rgba(5,5,10,.15) 35%,
        rgba(5,5,10,.2)  55%,
        rgba(5,5,10,.8)  85%,
        rgba(5,5,10,.95) 100%
    );
    z-index: 1;
}
.cover-top, .cover-bottom { position: relative; z-index: 2; width: 100%; }
.cover-top { padding-top: 4vh; }

.cover-wedding-of {
    font-family: 'Cormorant Garamond', serif;
    font-size: 11px;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--gold);
    opacity: 0;
    animation: seqFadeUp .8s ease forwards .1s;
    margin-bottom: 10px;
}
.cover-names {
    opacity: 0;
    animation: seqFadeUp .8s ease forwards .3s;
}
.cover-name-script {
    font-family: 'Great Vibes', cursive;
    font-size: clamp(2.6rem, 11vw, 4.2rem);
    font-weight: 400;
    color: #ffffff;
    line-height: 1.05;
    text-shadow: 0 2px 24px rgba(0,0,0,.5);
    display: block;
}
.cover-ampersand {
    font-family: 'Cormorant Garamond', serif;
    font-size: 15px;
    letter-spacing: 8px;
    color: var(--gold);
    display: block;
    margin: 6px 0;
    opacity: .85;
}
.cover-date-chip {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,.08);
    border: 1px solid rgba(255,255,255,.15);
    border-radius: 50px;
    padding: 8px 18px;
    font-size: 11px;
    color: rgba(255,255,255,.7);
    letter-spacing: .5px;
    backdrop-filter: blur(8px);
    margin-top: 20px;
    opacity: 0;
    animation: seqFadeUp .9s ease forwards 1.4s;
}
.cover-date-chip b { color: var(--gold); }

/* cover bottom: kepada yth + button */
.cover-kepada {
    opacity: 0;
    animation: seqFadeUp .9s ease forwards 1.9s;
    margin-bottom: 18px;
}
.cover-kepada p.yth {
    font-size: 10px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: rgba(255,255,255,.5);
    margin-bottom: 4px;
    font-family: 'Poppins', sans-serif;
}
.cover-kepada p.nama {
    font-family: 'Great Vibes', cursive;
    font-size: clamp(1.5rem, 6vw, 2rem);
    color: #fff;
    line-height: 1.15;
}
.cover-kepada p.disclaimer {
    font-size: 9.5px;
    color: rgba(255,255,255,.35);
    margin-top: 4px;
    font-style: italic;
}
.cover-open-btn {
    opacity: 0;
    animation: seqFadeUp .9s ease forwards 2.4s, floatBtn 3s ease-in-out infinite 3.4s;
    background: var(--gold);
    color: #1a0a01;
    border: none;
    padding: 14px 42px;
    border-radius: 50px;
    font-size: 12px;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    letter-spacing: 2.5px;
    text-transform: uppercase;
    cursor: pointer;
    box-shadow: 0 8px 32px rgba(0,0,0,.35);
}
.cover-scroll-hint {
    font-size: 10px;
    color: rgba(255,255,255,.3);
    letter-spacing: 1.5px;
    margin-top: 10px;
    opacity: 0;
    animation: fadeIn .8s ease forwards 3.2s;
}
/* corner ornaments */
.cover-corner {
    position: absolute;
    width: 100px; height: 100px;
    opacity: .45; z-index: 2;
    pointer-events: none;
}
.cover-corner.tl { top: 0; left: 0; }
.cover-corner.tr { top: 0; right: 0; transform: scaleX(-1); }
.cover-corner.bl { bottom: 0; left: 0; transform: scaleY(-1); }
.cover-corner.br { bottom: 0; right: 0; transform: scale(-1,-1); }

/* ══════════════════════════════════
   MAIN CONTENT WRAPPER
══════════════════════════════════ */
#inv-main {
    position: relative;
    z-index: 1;
    opacity: 0;
    transition: opacity .6s ease .3s;
}
#inv-main.visible { opacity: 1; }

/* ══════════════════════════════════
   SECTION BASE
══════════════════════════════════ */
.sec {
    padding: 64px 24px;
    position: relative;
    overflow: hidden;
}
.sec-cream  { background: var(--cream); }
.sec-cream2 { background: var(--cream2); }
.sec-navy   { background: var(--navy); }
.sec-navy2  { background: var(--navy2); }
.sec-white  { background: #fff; }

.eyebrow {
    font-size: 9px;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--gold);
    font-weight: 600;
    display: block;
    text-align: center;
    margin-bottom: 8px;
}
.sec-title {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(26px, 7vw, 34px);
    font-weight: 600;
    text-align: center;
    line-height: 1.2;
    color: var(--dark-txt);
    font-style: italic;
}
.sec-title.white { color: #fff; }

.gold-divider {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin: 14px auto;
}
.gold-divider::before, .gold-divider::after {
    content: '';
    flex: 1;
    max-width: 70px;
    height: 1px;
    background: linear-gradient(to right, transparent, var(--gold));
}
.gold-divider::before { background: linear-gradient(to left, transparent, var(--gold)); }
.gold-divider-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--gold);
    flex-shrink: 0;
}

/* ══════════════════════════════════
   OPENING BISMILLAH
══════════════════════════════════ */
.bismillah-wrap {
    text-align: center;
    padding: 72px 32px;
    background: var(--navy);
    position: relative;
    overflow: hidden;
}
.bismillah-bg-ornament {
    position: absolute;
    opacity: .04;
    width: 300px; height: 300px;
    border-radius: 50%;
    border: 1px solid var(--gold);
}
.bismillah-arabic {
    font-size: clamp(1.6rem, 7vw, 2.2rem);
    color: var(--gold);
    font-family: serif;
    line-height: 1.8;
    margin-bottom: 20px;
}
.bismillah-title {
    font-family: 'Great Vibes', cursive;
    font-size: clamp(2.6rem, 10vw, 3.8rem);
    color: #fff;
    line-height: 1.1;
    margin-bottom: 6px;
}
.bismillah-subtitle {
    font-size: 10px;
    letter-spacing: 5px;
    text-transform: uppercase;
    color: var(--gold);
    opacity: .7;
}
.bismillah-getting-married {
    font-family: 'Cinzel Decorative', serif;
    font-size: clamp(13px, 3.5vw, 17px);
    color: #fff;
    letter-spacing: 3px;
    margin-top: 20px;
    opacity: .9;
}
.bismillah-pengantar {
    font-size: 13px;
    color: rgba(255,255,255,.5);
    line-height: 1.9;
    margin-top: 18px;
    max-width: 320px;
    margin-left: auto;
    margin-right: auto;
    font-style: italic;
}

/* ══════════════════════════════════
   QURAN VERSE
══════════════════════════════════ */
.ayat-wrap {
    background: var(--navy2);
    padding: 60px 28px;
    text-align: center;
    position: relative;
    overflow: hidden;
}
.ayat-card {
    background: rgba(255,255,255,.04);
    border: 1px solid rgba(201,169,110,.2);
    border-radius: 20px;
    padding: 36px 24px;
    position: relative;
    z-index: 1;
}
.ayat-ornament-top {
    font-size: 28px;
    color: var(--gold);
    opacity: .5;
    display: block;
    margin-bottom: 18px;
    font-family: serif;
}
.ayat-text {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(15px, 4.5vw, 18px);
    color: rgba(255,255,255,.85);
    line-height: 1.9;
    font-style: italic;
    margin-bottom: 16px;
}
.ayat-source {
    font-size: 10px;
    letter-spacing: 3px;
    text-transform: uppercase;
    color: var(--gold);
    opacity: .8;
}

/* ══════════════════════════════════
   PROFILE MEMPELAI
══════════════════════════════════ */
.profil-header {
    text-align: center;
    margin-bottom: 40px;
}
.profil-item {
    text-align: center;
    padding: 28px 20px 24px;
    background: #fff;
    border-radius: 24px;
    box-shadow: 0 8px 40px rgba(0,0,0,.07);
    border: 1px solid var(--gold-20);
    margin-bottom: 16px;
    position: relative;
    overflow: hidden;
}
.profil-item::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 3px;
    background: linear-gradient(to right, transparent, var(--gold), transparent);
}
.profil-foto-ring {
    width: 110px; height: 110px;
    border-radius: 50%;
    border: 3px solid var(--gold);
    padding: 3px;
    margin: 0 auto 16px;
    position: relative;
    display: inline-flex;
}
.profil-foto-ring::after {
    content: '';
    position: absolute;
    inset: -8px;
    border-radius: 50%;
    border: 1px solid var(--gold-20);
}
.profil-foto-inner {
    width: 100%; height: 100%;
    border-radius: 50%;
    overflow: hidden;
    background: var(--gold-10);
    display: flex; align-items: center; justify-content: center;
}
.profil-foto-inner img { width:100%; height:100%; object-fit:cover; }
.profil-foto-initial {
    font-family: 'Great Vibes', cursive;
    font-size: 44px;
    color: var(--gold);
    line-height: 1;
}
.profil-nama-panggil {
    font-family: 'Great Vibes', cursive;
    font-size: clamp(1.8rem, 7vw, 2.4rem);
    color: var(--dark-txt);
    line-height: 1.1;
    margin-bottom: 4px;
}
.profil-nama-lengkap {
    font-size: 12px;
    color: var(--gray-txt);
    font-weight: 500;
    margin-bottom: 8px;
    letter-spacing: .3px;
}
.profil-anak {
    font-size: 11.5px;
    color: #a09080;
    line-height: 1.9;
    font-style: italic;
    padding: 10px 16px;
    background: var(--gold-10);
    border-radius: 12px;
    margin-top: 10px;
    border: 1px solid var(--gold-20);
}
.profil-ig {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-top: 12px;
    font-size: 11px;
    color: var(--gold);
    font-weight: 600;
    text-decoration: none;
    border: 1px solid var(--gold-20);
    padding: 6px 16px;
    border-radius: 20px;
    background: var(--gold-10);
}

/* ══════════════════════════════════
   EVENT SECTION
══════════════════════════════════ */
.event-prayer {
    font-size: 13px;
    color: rgba(255,255,255,.55);
    text-align: center;
    line-height: 1.9;
    font-style: italic;
    margin-bottom: 32px;
    max-width: 300px;
    margin-left: auto;
    margin-right: auto;
}
.event-card {
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(201,169,110,.25);
    border-radius: 20px;
    padding: 28px 20px;
    text-align: center;
    margin-bottom: 14px;
    position: relative;
    overflow: hidden;
}
.event-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 2px;
    background: linear-gradient(to right, transparent, var(--gold), transparent);
}
.event-card-type {
    font-size: 9px;
    letter-spacing: 4px;
    text-transform: uppercase;
    color: var(--gold);
    font-weight: 700;
    margin-bottom: 14px;
}
.event-card-date {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(18px, 5vw, 22px);
    font-weight: 600;
    color: #fff;
    margin-bottom: 4px;
    font-style: italic;
}
.event-card-time {
    font-size: 13px;
    color: rgba(255,255,255,.55);
    margin-bottom: 10px;
}
.event-sep {
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(201,169,110,.3), transparent);
    margin: 10px 0;
}
.event-loc-name {
    font-size: 14px;
    font-weight: 600;
    color: rgba(255,255,255,.85);
    margin-bottom: 4px;
}
.event-loc-addr {
    font-size: 12px;
    color: rgba(255,255,255,.4);
    line-height: 1.7;
}
.maps-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 16px;
    background: var(--gold);
    color: #1a0a01;
    text-decoration: none;
    padding: 11px 26px;
    border-radius: 50px;
    font-size: 11.5px;
    font-weight: 700;
    letter-spacing: .5px;
    transition: all .2s;
}
.maps-btn:hover { opacity: .88; transform: translateY(-2px); }

/* ══════════════════════════════════
   COUNTDOWN
══════════════════════════════════ */
.countdown-section {
    position: relative;
    min-height: 420px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 64px 24px;
    text-align: center;
    overflow: hidden;
}
.cd-bg-slides {
    position: absolute; inset: 0;
    z-index: 0;
}
.cd-bg-slide {
    position: absolute; inset: 0;
    background-size: cover;
    background-position: center;
    opacity: 0;
    transition: opacity 1.5s ease;
}
.cd-bg-slide.active { opacity: 1; }
.cd-bg-overlay {
    position: absolute; inset: 0;
    background: linear-gradient(to bottom, rgba(5,5,15,.85), rgba(5,5,15,.75));
    z-index: 1;
}
.cd-content { position: relative; z-index: 2; width: 100%; }
.countdown-boxes {
    display: flex;
    justify-content: center;
    gap: 10px;
    margin-top: 24px;
}
.cd-box {
    text-align: center;
    background: rgba(255,255,255,.06);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(201,169,110,.25);
    border-radius: 16px;
    padding: 16px 8px 12px;
    flex: 1;
    max-width: 74px;
}
.cd-num {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(28px, 9vw, 38px);
    font-weight: 700;
    color: var(--gold);
    line-height: 1;
    letter-spacing: -1px;
}
.cd-lbl {
    font-size: 8.5px;
    text-transform: uppercase;
    color: rgba(255,255,255,.45);
    margin-top: 6px;
    letter-spacing: 1.5px;
    font-weight: 500;
}
.cd-date-text {
    font-family: 'Great Vibes', cursive;
    font-size: clamp(1.4rem, 5.5vw, 1.9rem);
    color: rgba(255,255,255,.7);
    margin-top: 20px;
}
.cd-add-cal {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin-top: 16px;
    background: transparent;
    border: 1px solid rgba(201,169,110,.4);
    color: var(--gold);
    padding: 10px 22px;
    border-radius: 50px;
    font-size: 11px;
    font-weight: 600;
    letter-spacing: 1px;
    text-decoration: none;
    transition: all .2s;
}
.cd-add-cal:hover { background: var(--gold-20); }

/* ══════════════════════════════════
   STORY
══════════════════════════════════ */
.story-text {
    font-family: 'Cormorant Garamond', serif;
    font-size: clamp(15px, 4.5vw, 18px);
    color: rgba(255,255,255,.75);
    line-height: 2.1;
    font-style: italic;
    text-align: center;
    white-space: pre-line;
    max-width: 340px;
    margin: 24px auto 0;
}

/* ══════════════════════════════════
   GALLERY
══════════════════════════════════ */
.gallery-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 4px;
    margin-top: 24px;
    border-radius: 18px;
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
    transition: transform .45s ease;
}
.gallery-item:hover img { transform: scale(1.07); }
.gallery-item::after {
    content: '';
    position: absolute; inset: 0;
    background: transparent;
    transition: background .3s;
}
.gallery-item:hover::after { background: rgba(0,0,0,.12); }

/* ══════════════════════════════════
   GIFT
══════════════════════════════════ */
.gift-toggle-btn {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    width: 100%;
    background: var(--gold);
    color: #1a0a01;
    border: none;
    padding: 15px 24px;
    border-radius: 50px;
    font-size: 12px;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    cursor: pointer;
    margin-bottom: 20px;
    transition: all .2s;
}
.gift-toggle-btn:hover { opacity: .88; }
.gift-cards { display: none; }
.gift-cards.open { display: block; }
.gift-card {
    background: rgba(255,255,255,.05);
    border: 1px solid rgba(201,169,110,.2);
    border-radius: 18px;
    padding: 18px 20px;
    margin-bottom: 12px;
    display: flex;
    align-items: center;
    gap: 16px;
}
.gift-bank-icon {
    width: 46px; height: 46px;
    background: var(--gold-20);
    border-radius: 14px;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
    border: 1px solid rgba(201,169,110,.3);
}
.gift-info { flex: 1; min-width: 0; }
.gift-bank { font-size: 9.5px; color: var(--gold); font-weight: 700; letter-spacing: 1px; text-transform: uppercase; }
.gift-num  { font-size: 15px; font-weight: 700; font-family: monospace; color: rgba(255,255,255,.85); margin: 3px 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
.gift-name { font-size: 11px; color: rgba(255,255,255,.4); }
.copy-btn  {
    background: rgba(201,169,110,.15);
    border: 1px solid rgba(201,169,110,.3);
    color: var(--gold);
    padding: 8px 14px;
    border-radius: 10px;
    font-size: 11px;
    font-weight: 700;
    cursor: pointer;
    flex-shrink: 0;
    transition: all .2s;
    font-family: 'Poppins', sans-serif;
}
.copy-btn:hover { background: var(--gold); color: #1a0a01; border-color: var(--gold); }
.copy-btn.copied { background: rgba(74,222,128,.15); color: #4ADE80; border-color: #4ADE80; }

/* ══════════════════════════════════
   RSVP & GUESTBOOK
══════════════════════════════════ */
.pi-input {
    width: 100%;
    border: 1.5px solid rgba(201,169,110,.2);
    border-radius: 12px;
    padding: 13px 16px;
    font-size: 14px;
    font-family: 'Poppins', sans-serif;
    outline: none;
    transition: border-color .2s, box-shadow .2s;
    background: rgba(255,255,255,.06);
    color: rgba(255,255,255,.85);
}
.pi-input::placeholder { color: rgba(255,255,255,.25); }
.pi-input:focus { border-color: var(--gold); box-shadow: 0 0 0 3px var(--gold-10); }
.pi-btn {
    width: 100%;
    background: var(--gold);
    color: #1a0a01;
    border: none;
    padding: 14px;
    border-radius: 12px;
    font-size: 12px;
    font-family: 'Poppins', sans-serif;
    font-weight: 700;
    cursor: pointer;
    letter-spacing: 1.5px;
    text-transform: uppercase;
    transition: all .2s;
}
.pi-btn:hover { opacity: .88; transform: translateY(-1px); }
.pi-btn:disabled { opacity: .5; transform: none; }

.attendance-opt { cursor: pointer; }
.attendance-opt input { display: none; }
.attendance-box {
    border: 1.5px solid rgba(201,169,110,.2);
    border-radius: 12px;
    padding: 10px 6px;
    text-align: center;
    transition: all .2s;
    background: rgba(255,255,255,.04);
}
.attendance-box.selected { border-color: var(--gold); background: var(--gold-20); }
.attendance-icon { font-size: 18px; }
.attendance-lbl { font-size: 10px; font-weight: 600; color: rgba(255,255,255,.45); margin-top: 4px; }
.attendance-box.selected .attendance-lbl { color: var(--gold); }

/* wishes */
.wish-wrap { margin-top: 36px; }
.wish-entry {
    background: rgba(255,255,255,.05);
    border-radius: 16px;
    padding: 16px 18px;
    margin-bottom: 10px;
    border-left: 3px solid var(--gold);
}
.wish-name { font-size: 13px; font-weight: 700; color: rgba(255,255,255,.85); }
.wish-time { font-size: 10px; color: rgba(255,255,255,.3); margin-top: 1px; }
.wish-msg  { font-size: 13px; color: rgba(255,255,255,.55); margin-top: 8px; line-height: 1.7; font-style: italic; }

/* ══════════════════════════════════
   CLOSING / FOOTER
══════════════════════════════════ */
.closing-section {
    position: relative;
    min-height: 360px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    padding: 64px 24px;
    text-align: center;
    overflow: hidden;
}
.closing-bg {
    position: absolute; inset: 0;
    @if($coverBg)
    background: url('{{ $coverBg }}') center/cover no-repeat;
    @else
    background: radial-gradient(ellipse at 50% 50%, #2d1a06 0%, #0d0a08 100%);
    @endif
}
.closing-overlay {
    position: absolute; inset: 0;
    background: rgba(5,5,15,.82);
}
.closing-content { position: relative; z-index: 2; }
.closing-names {
    font-family: 'Great Vibes', cursive;
    font-size: clamp(2.4rem, 10vw, 3.6rem);
    color: #fff;
    line-height: 1.15;
}
.closing-closing {
    font-size: 12px;
    color: rgba(255,255,255,.4);
    letter-spacing: 2px;
    text-transform: uppercase;
    margin-top: 10px;
}
.closing-date {
    font-family: 'Cormorant Garamond', serif;
    font-size: 16px;
    color: var(--gold);
    margin-top: 8px;
    font-style: italic;
}

.inv-brand {
    background: var(--navy);
    text-align: center;
    padding: 24px;
    border-top: 1px solid rgba(255,255,255,.05);
}
.inv-brand a {
    font-size: 11px;
    color: rgba(255,255,255,.2);
    text-decoration: none;
    letter-spacing: .5px;
}
.inv-brand strong { color: var(--gold); }

/* ── Desktop: constrain cover & music btn to 430px phone frame ── */
@@media (min-width: 500px) {
    #inv-cover {
        left: 50%;
        transform: translateX(-50%);
        width: 430px;
    }
    #inv-cover.slide-up {
        transform: translate(-50%, -100vh) !important;
    }
    #music-btn {
        right: calc(50% - 215px + 20px);
    }
}

/* ══════════════════════════════════
   MUSIC BTN
══════════════════════════════════ */
#music-btn {
    position: fixed; bottom: 24px; right: 20px; z-index: 9000;
    background: var(--gold); color: #1a0a01; border: none;
    border-radius: 50%; width: 50px; height: 50px;
    cursor: pointer;
    box-shadow: 0 4px 20px rgba(0,0,0,.35);
    transition: transform .2s;
    display: flex; align-items: center; justify-content: center;
}
#music-btn:hover { transform: scale(1.1); }
#music-btn.playing { animation: ripple 2.2s infinite; }
#music-btn svg { width: 20px; height: 20px; }

/* LIGHTBOX */
#lightbox {
    position: fixed; inset: 0;
    background: rgba(0,0,0,.97); z-index: 99999;
    display: none; align-items: center; justify-content: center;
    padding: 20px; cursor: pointer;
}
#lightbox img { max-width: 100%; max-height: 90vh; border-radius: 12px; object-fit: contain; }

@if($isFloral)
/* ══════════════════════════════════
   FLORAL ROMANTIC THEME OVERRIDES
══════════════════════════════════ */
@@import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400;1,600&family=Poppins:wght@300;400;500;600&display=swap');

:root {
    --gold:    {{ $primary }};
    --gold-lt: {{ $primary }}BB;
    --gold-20: {{ $primary }}33;
    --gold-10: {{ $primary }}1A;
}

body { background: #FDF8F2 !important; }

/* Floral corner animations */
@@keyframes floral-sway {
    0%,100% { transform: rotate(0deg); }
    25%     { transform: rotate(2deg); }
    75%     { transform: rotate(-1.5deg); }
}
@@keyframes floral-sway-tr {
    0%,100% { transform: scaleX(-1) rotate(0deg); }
    25%     { transform: scaleX(-1) rotate(2deg); }
    75%     { transform: scaleX(-1) rotate(-1.5deg); }
}
@@keyframes floral-sway-bl {
    0%,100% { transform: scaleY(-1) rotate(0deg); }
    25%     { transform: scaleY(-1) rotate(1.5deg); }
    75%     { transform: scaleY(-1) rotate(-2deg); }
}
@@keyframes floral-sway-br {
    0%,100% { transform: scale(-1,-1) rotate(0deg); }
    25%     { transform: scale(-1,-1) rotate(2deg); }
    75%     { transform: scale(-1,-1) rotate(-1.5deg); }
}
@@keyframes petal-fall {
    0%   { transform: translateY(0) rotate(0deg) translateX(0); opacity: 0; }
    5%   { opacity: .75; }
    85%  { opacity: .3; }
    100% { transform: translateY(100vh) rotate(480deg) translateX(60px); opacity: 0; }
}
@@keyframes floral-breathe {
    0%,100% { opacity: .75; transform: scale(1); }
    50%     { opacity: 1;   transform: scale(1.02); }
}

/* Floral corner ornament overrides */
.cover-corner { width: 150px !important; height: 150px !important; opacity: 1 !important; display: block !important; }
.cover-corner.tl { animation: floral-sway    7s ease-in-out infinite; transform-origin: 0 0; }
.cover-corner.tr { animation: floral-sway-tr 8s ease-in-out infinite .6s; transform-origin: 100% 0; }
.cover-corner.bl { animation: floral-sway-bl 9s ease-in-out infinite 1.2s; transform-origin: 0 100%; }
.cover-corner.br { animation: floral-sway-br 7.5s ease-in-out infinite 1.8s; transform-origin: 100% 100%; }

/* Cover names: Cormorant Garamond italic (readable, not cursive script) */
.cover-name-script {
    font-family: 'Cormorant Garamond', serif !important;
    font-style: italic !important;
    font-size: clamp(2.2rem, 9vw, 3.6rem) !important;
    font-weight: 600 !important;
    letter-spacing: 0.02em !important;
}

/* Floating petals container */
#floral-petals { position: fixed; top: 0; left: 0; width: 100%; height: 100vh; pointer-events: none; z-index: 9998; overflow: hidden; }
.floral-petal {
    position: absolute;
    top: -20px;
    border-radius: 50% 0 50% 0;
    animation: petal-fall linear infinite;
    opacity: 0;
}

/* Cover background for floral */
#inv-cover .cover-bg {
    @if($coverBg)
    background: url('{{ $coverBg }}') center/cover no-repeat;
    @else
    background: radial-gradient(ellipse at 30% 20%, #3d1a1a 0%, #2a0f10 45%, #1a0c0d 100%) !important;
    @endif
}
#inv-cover .cover-overlay {
    background: linear-gradient(
        to bottom,
        rgba(30,5,8,.55) 0%,
        rgba(20,5,8,.15) 35%,
        rgba(20,5,8,.2)  55%,
        rgba(20,5,8,.8)  85%,
        rgba(15,5,8,.95) 100%
    ) !important;
}

/* ── FLORAL: Section colours ── */
/* Light cream sections (couple, gallery) */
.sec-cream  { background: #FDF8F2 !important; }
.sec-cream2 { background: #F9EEE4 !important; }

/* Dark sections → deep burgundy (matches cover), keeps white text readable */
.sec-navy  { background: #2c1215 !important; }
.sec-navy2 { background: #231018 !important; }
.bismillah-wrap { background: #2c1215 !important; }
.ayat-wrap      { background: #231018 !important; }

/* ── FLORAL: Fix all Great Vibes cursive → Cormorant Garamond italic ── */
/* Bismillah opening */
.bismillah-title {
    font-family: 'Cormorant Garamond', serif !important;
    font-style: italic !important;
    font-size: clamp(2.4rem, 9vw, 3.4rem) !important;
    font-weight: 600 !important;
    letter-spacing: 0.02em !important;
}
/* Couple profile names */
.profil-nama-panggil {
    font-family: 'Cormorant Garamond', serif !important;
    font-style: italic !important;
    font-size: clamp(1.9rem, 7vw, 2.6rem) !important;
    font-weight: 600 !important;
}
/* Profile photo placeholder initial */
.profil-foto-initial {
    font-family: 'Cormorant Garamond', serif !important;
    font-style: italic !important;
    font-weight: 600 !important;
}
/* Countdown date text */
.cd-date-text {
    font-family: 'Cormorant Garamond', serif !important;
    font-style: italic !important;
    font-size: clamp(1.3rem, 5vw, 1.8rem) !important;
    font-weight: 600 !important;
}
/* Closing names */
.closing-names {
    font-family: 'Cormorant Garamond', serif !important;
    font-style: italic !important;
    font-size: clamp(2.4rem, 10vw, 3.6rem) !important;
    font-weight: 600 !important;
}

/* ── FLORAL: Light section text fixes (cream bg → dark text needed) ── */
/* sec-cream sections use dark text by default — ensure consistency */
.sec-cream  .sec-title,
.sec-cream2 .sec-title  { color: #2c1215 !important; }
.sec-cream  .eyebrow,
.sec-cream2 .eyebrow    { color: var(--gold) !important; }

/* ── FLORAL: Divider ── */
.floral-section-divider {
    text-align: center;
    padding: 12px 0;
    font-size: 16px;
    letter-spacing: 8px;
    color: var(--gold);
    opacity: .5;
    background: #FDF8F2;
}
@endif
</style>

{{-- ══════════════════════════════════════════════════════════════ --}}
{{-- MUSIC                                                          --}}
{{-- ══════════════════════════════════════════════════════════════ --}}
@if($inv->music && $inv->music->is_active && $inv->music->path)
<audio id="bg-music" {{ $inv->music->loop ? 'loop' : '' }} preload="none">
    <source src="{{ $inv->music->getUrl() }}" type="audio/mpeg">
</audio>
<button id="music-btn" onclick="toggleMusic()" aria-label="Toggle musik" style="display:none;">
    <svg id="music-icon-play" fill="currentColor" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>
    <svg id="music-icon-pause" style="display:none" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><rect x="6" y="4" width="4" height="16" rx="1"/><rect x="14" y="4" width="4" height="16" rx="1"/></svg>
</button>
@endif

{{-- LIGHTBOX --}}
<div id="lightbox" onclick="closeLightbox()">
    <img id="lightbox-img" src="" alt="">
</div>

{{-- ══════════════════════════════════════════════════════════════ --}}
{{-- COVER                                                          --}}
{{-- ══════════════════════════════════════════════════════════════ --}}
<div id="inv-cover" wire:ignore>
    <div class="cover-bg"></div>
    <div class="cover-overlay"></div>

    {{-- Corner ornaments --}}
    @if($isFloral)
    {{-- Floral Romantic: botanical corner image files (transparent SVG) --}}
    <img src="/images/flowers/floral-corner.svg" class="cover-corner tl" alt="" draggable="false">
    <img src="/images/flowers/floral-corner.svg" class="cover-corner tr" alt="" draggable="false">
    <img src="/images/flowers/floral-corner.svg" class="cover-corner bl" alt="" draggable="false">
    <img src="/images/flowers/floral-corner.svg" class="cover-corner br" alt="" draggable="false">
    @else
    {{-- Default: geometric corner ornaments --}}
    <svg class="cover-corner tl" viewBox="0 0 100 100" fill="none">
        <path d="M8 8 L8 52" stroke="{{ $primary }}" stroke-width=".9" opacity=".5"/>
        <path d="M8 8 L52 8" stroke="{{ $primary }}" stroke-width=".9" opacity=".5"/>
        <path d="M8 8 Q55 8 55 55" stroke="{{ $primary }}" stroke-width=".7" opacity=".35"/>
        <circle cx="8" cy="8" r="3" fill="{{ $primary }}" opacity=".7"/>
        <circle cx="52" cy="8" r="1.5" fill="{{ $primary }}" opacity=".35"/>
        <circle cx="8" cy="52" r="1.5" fill="{{ $primary }}" opacity=".35"/>
    </svg>
    <svg class="cover-corner tr" viewBox="0 0 100 100" fill="none">
        <path d="M8 8 L8 52" stroke="{{ $primary }}" stroke-width=".9" opacity=".5"/>
        <path d="M8 8 L52 8" stroke="{{ $primary }}" stroke-width=".9" opacity=".5"/>
        <path d="M8 8 Q55 8 55 55" stroke="{{ $primary }}" stroke-width=".7" opacity=".35"/>
        <circle cx="8" cy="8" r="3" fill="{{ $primary }}" opacity=".7"/>
    </svg>
    <svg class="cover-corner bl" viewBox="0 0 100 100" fill="none">
        <path d="M8 8 L8 52" stroke="{{ $primary }}" stroke-width=".9" opacity=".5"/>
        <path d="M8 8 L52 8" stroke="{{ $primary }}" stroke-width=".9" opacity=".5"/>
        <path d="M8 8 Q55 8 55 55" stroke="{{ $primary }}" stroke-width=".7" opacity=".35"/>
        <circle cx="8" cy="8" r="3" fill="{{ $primary }}" opacity=".7"/>
    </svg>
    <svg class="cover-corner br" viewBox="0 0 100 100" fill="none">
        <path d="M8 8 L8 52" stroke="{{ $primary }}" stroke-width=".9" opacity=".5"/>
        <path d="M8 8 L52 8" stroke="{{ $primary }}" stroke-width=".9" opacity=".5"/>
        <path d="M8 8 Q55 8 55 55" stroke="{{ $primary }}" stroke-width=".7" opacity=".35"/>
        <circle cx="8" cy="8" r="3" fill="{{ $primary }}" opacity=".7"/>
    </svg>
    @endif

    {{-- TOP: couple names --}}
    <div class="cover-top">
        <p class="cover-wedding-of">✦ &nbsp; The Wedding Of &nbsp; ✦</p>
        <div class="cover-names">
            <span class="cover-name-script">{{ $groom }}</span>
            <span class="cover-ampersand">— &amp; —</span>
            <span class="cover-name-script">{{ $bride }}</span>
        </div>
        @if($eventDate)
        <div class="cover-date-chip">
            <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
            <b>{{ \Carbon\Carbon::parse($eventDate)->translatedFormat('d F Y') }}</b>
        </div>
        @endif
    </div>

    {{-- BOTTOM: kepada yth + button --}}
    <div class="cover-bottom">
        <div class="cover-kepada">
            @if($guestName)
            <p class="yth">Kepada Yth.</p>
            <p class="nama">{{ $guestName }}</p>
            <p class="disclaimer">*Mohon maaf jika ada kesalahan penulisan nama</p>
            @else
            <p class="yth" style="opacity:.4;">Kepada Yth.</p>
            <p class="nama" style="opacity:.4;">Bapak/Ibu/Saudara/i</p>
            @endif
        </div>
        <button class="cover-open-btn" onclick="openInvitation()">
            💌 &nbsp; Buka Undangan
        </button>
        <p class="cover-scroll-hint">sentuh untuk membuka</p>
    </div>
</div>

@if($isFloral)
{{-- ── Floating petals (fixed, above everything except cover) ── --}}
<div id="floral-petals">
    @php
    $petalColors = ['#F4A7B9','#F9C4D0','#FDDDE6','#F7A8C0','#FBC8D6','#F4C2CC','#FDE0E8'];
    $petalData = [
        ['left'=>'4%',  'dur'=>'6s',  'delay'=>'0s',   'w'=>8,  'h'=>12],
        ['left'=>'11%', 'dur'=>'8s',  'delay'=>'1.2s', 'w'=>11, 'h'=>15],
        ['left'=>'19%', 'dur'=>'7s',  'delay'=>'2.5s', 'w'=>7,  'h'=>10],
        ['left'=>'27%', 'dur'=>'9s',  'delay'=>'0.8s', 'w'=>10, 'h'=>14],
        ['left'=>'35%', 'dur'=>'6.5s','delay'=>'3s',   'w'=>9,  'h'=>13],
        ['left'=>'44%', 'dur'=>'7.5s','delay'=>'1.5s', 'w'=>12, 'h'=>16],
        ['left'=>'52%', 'dur'=>'8.5s','delay'=>'4s',   'w'=>7,  'h'=>11],
        ['left'=>'61%', 'dur'=>'7s',  'delay'=>'0.5s', 'w'=>10, 'h'=>14],
        ['left'=>'70%', 'dur'=>'6s',  'delay'=>'2s',   'w'=>8,  'h'=>12],
        ['left'=>'78%', 'dur'=>'9s',  'delay'=>'3.5s', 'w'=>11, 'h'=>15],
        ['left'=>'86%', 'dur'=>'7.5s','delay'=>'1s',   'w'=>9,  'h'=>13],
        ['left'=>'93%', 'dur'=>'8s',  'delay'=>'4.5s', 'w'=>7,  'h'=>10],
    ];
    @endphp
    @foreach($petalData as $i => $p)
    <div class="floral-petal" style="
        left:{{ $p['left'] }};
        background:{{ $petalColors[$i % count($petalColors)] }};
        width:{{ $p['w'] }}px;
        height:{{ $p['h'] }}px;
        animation-duration:{{ $p['dur'] }};
        animation-delay:{{ $p['delay'] }};
        border-radius: {{ ($i % 2 === 0) ? '50% 0 50% 0' : '0 50% 0 50%' }};
        opacity:.65;
    "></div>
    @endforeach
</div>
@endif

{{-- ══════════════════════════════════════════════════════════════ --}}
{{-- MAIN CONTENT                                                   --}}
{{-- ══════════════════════════════════════════════════════════════ --}}
<div id="inv-main">

{{-- ── BISMILLAH / OPENING ── --}}
<div class="bismillah-wrap">
    <div class="bismillah-bg-ornament" style="top:-80px;left:-80px;"></div>
    <div class="bismillah-bg-ornament" style="bottom:-80px;right:-80px;"></div>
    <div style="position:relative;z-index:1;">
        <p class="bismillah-arabic reveal">بِسْمِ اللَّهِ الرَّحْمَنِ الرَّحِيمِ</p>
        <div class="gold-divider reveal delay-1"><div class="gold-divider-dot"></div></div>
        <p class="bismillah-title reveal delay-2">{{ $groom }}</p>
        <p class="bismillah-subtitle reveal delay-2">&amp;</p>
        <p class="bismillah-title reveal delay-2">{{ $bride }}</p>
        <p class="bismillah-getting-married reveal delay-3">WE ARE GETTING MARRIED!</p>
        <p class="bismillah-pengantar reveal delay-4">
            Dengan segala kerendahan hati, kami mengundang Bapak/Ibu/Saudara/i untuk hadir dan memberikan doa restu atas pernikahan kami.
        </p>
    </div>
</div>

{{-- ── QURAN VERSE ── --}}
<div class="ayat-wrap">
    <div class="ayat-card reveal">
        <span class="ayat-ornament-top">❝</span>
        <p class="ayat-text">
            "Dan di antara tanda-tanda (kebesaran)-Nya ialah Dia menciptakan pasangan-pasangan untukmu dari jenismu sendiri, agar kamu merasa tenteram kepadanya, dan Dia menjadikan di antaramu rasa kasih dan sayang."
        </p>
        <p class="ayat-source">— QS. Ar-Rum : 21 —</p>
    </div>
</div>

{{-- ── PROFIL MEMPELAI ── --}}
@if($sections['couple'] ?? true)
<section class="sec sec-cream">
    <div class="profil-header">
        <span class="eyebrow reveal">✦ Mempelai ✦</span>
        <div class="gold-divider reveal delay-1"><div class="gold-divider-dot"></div></div>
        <h2 class="sec-title reveal delay-2">Dua Hati Menjadi Satu</h2>
        <p style="font-size:13px;color:var(--gray-txt);text-align:center;line-height:1.8;margin-top:10px;font-style:italic;" class="reveal delay-3">
            Dengan penuh rasa syukur kepada Allah SWT, kami mengumumkan pernikahan kami.
        </p>
    </div>

    {{-- Mempelai Pria --}}
    <div class="profil-item reveal">
        <div class="profil-foto-ring">
            <div class="profil-foto-inner">
                @if($data['groom_photo'] ?? null)
                    <img src="{{ $data['groom_photo'] }}" alt="{{ $groom }}">
                @else
                    <span class="profil-foto-initial">{{ $groomInitial }}</span>
                @endif
            </div>
        </div>
        <p class="profil-nama-panggil">{{ $groom }}</p>
        @if($groomFull && $groomFull !== $groom)
        <p class="profil-nama-lengkap">{{ $groomFull }}</p>
        @endif
        @if($data['groom_father'] ?? '')
        <p class="profil-anak">
            Putra dari Bapak {{ $data['groom_father'] }}
            @if($data['groom_mother'] ?? '') &amp; Ibu {{ $data['groom_mother'] }} @endif
        </p>
        @endif
        @if($data['groom_instagram'] ?? '')
        <a href="https://instagram.com/{{ ltrim($data['groom_instagram'],'@') }}" target="_blank" class="profil-ig">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            @{{ ltrim($data['groom_instagram'],'@') }}
        </a>
        @endif
    </div>

    <div style="text-align:center;margin:8px 0 20px;">
        <svg width="60" height="60" viewBox="0 0 60 60" fill="{{ $primary }}" opacity=".6" style="animation:heartbeat 2.5s ease infinite;">
            <path d="M30 50 C30 50 8 35 8 20 C8 13 13 8 20 8 C24 8 28 11 30 14 C32 11 36 8 40 8 C47 8 52 13 52 20 C52 35 30 50 30 50Z"/>
        </svg>
    </div>

    {{-- Mempelai Wanita --}}
    <div class="profil-item reveal">
        <div class="profil-foto-ring">
            <div class="profil-foto-inner">
                @if($data['bride_photo'] ?? null)
                    <img src="{{ $data['bride_photo'] }}" alt="{{ $bride }}">
                @else
                    <span class="profil-foto-initial">{{ $brideInitial }}</span>
                @endif
            </div>
        </div>
        <p class="profil-nama-panggil">{{ $bride }}</p>
        @if($brideFull && $brideFull !== $bride)
        <p class="profil-nama-lengkap">{{ $brideFull }}</p>
        @endif
        @if($data['bride_father'] ?? '')
        <p class="profil-anak">
            Putri dari Bapak {{ $data['bride_father'] }}
            @if($data['bride_mother'] ?? '') &amp; Ibu {{ $data['bride_mother'] }} @endif
        </p>
        @endif
        @if($data['bride_instagram'] ?? '')
        <a href="https://instagram.com/{{ ltrim($data['bride_instagram'],'@') }}" target="_blank" class="profil-ig">
            <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
            @{{ ltrim($data['bride_instagram'],'@') }}
        </a>
        @endif
    </div>
</section>
@endif

{{-- ── EVENT SECTION ── --}}
<section class="sec sec-navy" style="text-align:center;">
    <span class="eyebrow reveal" style="color:var(--gold);">✦ Detail Acara ✦</span>
    <div class="gold-divider reveal delay-1"><div class="gold-divider-dot"></div></div>
    <h2 class="sec-title white reveal delay-2">Waktu &amp; Tempat</h2>
    <p class="event-prayer reveal delay-3">
        Dengan memohon rahmat dan ridho Allah SWT,<br>kami akan melangsungkan acara pernikahan pada:
    </p>

    @if($akadDate)
    <div class="event-card reveal">
        <div class="event-card-type">⟡ Akad Nikah</div>
        <div class="event-card-date">{{ \Carbon\Carbon::parse($akadDate)->translatedFormat('l, d F Y') }}</div>
        @if($akadTime)<div class="event-card-time">🕐 {{ $akadTime }} WIB</div>@endif
        @if($data['akad_location'] ?? '')
        <div class="event-sep"></div>
        <div class="event-loc-name">{{ $data['akad_location'] }}</div>
        @if($data['akad_address'] ?? '')
        <div class="event-loc-addr">{{ $data['akad_address'] }}</div>
        @endif
        @endif
    </div>
    @endif

    @if($eventDate)
    <div class="event-card reveal delay-1">
        <div class="event-card-type">⟡ Resepsi Pernikahan</div>
        <div class="event-card-date">{{ \Carbon\Carbon::parse($eventDate)->translatedFormat('l, d F Y') }}</div>
        @if($eventTime)<div class="event-card-time">🕐 {{ $eventTime }} WIB</div>@endif
        @if($loc)
        <div class="event-sep"></div>
        <div class="event-loc-name">{{ $loc }}</div>
        @if($locAddr)<div class="event-loc-addr">{{ $locAddr }}</div>@endif
        @endif
        @if($mapsUrl)
        <div style="margin-top:18px;">
            <a href="{{ $mapsUrl }}" target="_blank" rel="noopener" class="maps-btn">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M17.657 16.657L13.414 20.9a2 2 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Buka Google Maps
            </a>
        </div>
        @endif
    </div>
    @endif
</section>

{{-- ── COUNTDOWN ── --}}
@if(($sections['countdown'] ?? true) && $eventDate)
<section class="countdown-section">
    {{-- Slideshow background from gallery --}}
    <div class="cd-bg-slides" id="cd-slides">
        @if($galleries->isNotEmpty())
            @foreach($galleries->take(4) as $i => $g)
            <div class="cd-bg-slide {{ $i===0?'active':'' }}"
                 style="background-image:url('{{ $g->getUrl() }}')"></div>
            @endforeach
        @else
        <div class="cd-bg-slide active"
             style="background:radial-gradient(ellipse at 50% 30%, #2d1a06, #0d0a08)"></div>
        @endif
    </div>
    <div class="cd-bg-overlay"></div>

    <div class="cd-content">
        <span class="eyebrow" style="color:var(--gold);">✦ Menuju Hari Bahagia ✦</span>
        <div class="gold-divider" style="margin:12px auto;"><div class="gold-divider-dot"></div></div>
        <h2 style="font-family:'Cormorant Garamond',serif;font-size:clamp(22px,6vw,28px);color:#fff;font-style:italic;font-weight:600;">Hitung Mundur</h2>

        <div class="countdown-boxes">
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

        @if($eventDate)
        <p class="cd-date-text">{{ \Carbon\Carbon::parse($eventDate)->translatedFormat('d F Y') }}</p>
        @endif
    </div>
</section>
<script>
(function(){
    var target = new Date('{{ $eventDate }}T{{ $eventTime ?? "08:00" }}:00');
    function pad(v){ return String(v).padStart(2,'0'); }
    function update(){
        var diff = target - new Date();
        if(diff <= 0){
            ['cd-days','cd-hours','cd-mins','cd-secs'].forEach(function(id){ document.getElementById(id).textContent='00'; });
            return;
        }
        var d=Math.floor(diff/86400000), h=Math.floor(diff%86400000/3600000),
            m=Math.floor(diff%3600000/60000), s=Math.floor(diff%60000/1000);
        document.getElementById('cd-days').textContent  = d;
        document.getElementById('cd-hours').textContent = pad(h);
        document.getElementById('cd-mins').textContent  = pad(m);
        document.getElementById('cd-secs').textContent  = pad(s);
    }
    update(); setInterval(update, 1000);

    // Slide background
    @if($galleries->count() > 1)
    var slides = document.querySelectorAll('#cd-slides .cd-bg-slide');
    if(slides.length > 1){
        var idx = 0;
        setInterval(function(){
            slides[idx].classList.remove('active');
            idx = (idx + 1) % slides.length;
            slides[idx].classList.add('active');
        }, 4000);
    }
    @endif
})();
</script>
@endif

{{-- ── LOVE STORY ── --}}
@if(($sections['story'] ?? true) && $story)
<section class="sec sec-navy2" style="text-align:center;">
    <span class="eyebrow reveal" style="color:var(--gold);">✦ Kisah Cinta ✦</span>
    <div class="gold-divider reveal delay-1"><div class="gold-divider-dot"></div></div>
    <h2 class="sec-title white reveal delay-2">Perjalanan Kita</h2>
    <p class="story-text reveal delay-3">{{ $story }}</p>
</section>
@endif

{{-- ── GALLERY ── --}}
@if(($sections['gallery'] ?? true) && $galleries->isNotEmpty())
<section class="sec sec-cream2" style="text-align:center;">
    <span class="eyebrow reveal">✦ Momen Bahagia ✦</span>
    <div class="gold-divider reveal delay-1"><div class="gold-divider-dot"></div></div>
    <h2 class="sec-title reveal delay-2">Galeri Foto</h2>
    <p style="font-size:12px;color:var(--gray-txt);margin-top:6px;font-style:italic;" class="reveal delay-3">Sentuh foto untuk memperbesar</p>

    <div class="gallery-grid reveal delay-4">
        @foreach($galleries as $i => $gallery)
        @php $isLarge = $i === 0 && $galleries->count() >= 3; @endphp
        <div class="gallery-item {{ $isLarge ? 'g-large' : '' }}"
             onclick="openLightbox('{{ $gallery->getUrl() }}')">
            <img src="{{ $gallery->getUrl() }}"
                 alt="Foto {{ $i+1 }}"
                 loading="{{ $i < 3 ? 'eager' : 'lazy' }}">
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ── DIGITAL GIFT ── --}}
@if(($sections['gift'] ?? true) && $inv->digitalGifts->where('is_visible',true)->isNotEmpty())
<section class="sec sec-navy" style="text-align:center;">
    <span class="eyebrow reveal" style="color:var(--gold);">✦ Hadiah Digital ✦</span>
    <div class="gold-divider reveal delay-1"><div class="gold-divider-dot"></div></div>
    <h2 class="sec-title white reveal delay-2">Kirim Hadiah</h2>
    <p style="font-size:13px;color:rgba(255,255,255,.45);text-align:center;margin:12px 0 28px;line-height:1.8;font-style:italic;" class="reveal delay-3">
        Doa restu Anda adalah hadiah terbaik bagi kami.<br>Jika ingin memberikan hadiah silakan transfer ke:
    </p>

    <button class="gift-toggle-btn reveal delay-4" onclick="toggleGift(this)">
        <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg>
        Lihat Nomor Rekening
    </button>

    <div class="gift-cards" id="gift-cards" style="width:100%;">
        @foreach($inv->digitalGifts->where('is_visible',true) as $gift)
        <div class="gift-card">
            <div class="gift-bank-icon">{{ $gift->icon ?? '💳' }}</div>
            <div class="gift-info">
                <div class="gift-bank">{{ $gift->label }}@if($gift->bank_name) · {{ $gift->bank_name }}@endif</div>
                <div class="gift-num">{{ $gift->account_number }}</div>
                <div class="gift-name">a/n {{ $gift->account_name }}</div>
            </div>
            <button class="copy-btn"
                onclick="(function(btn,num){ navigator.clipboard.writeText(num).then(function(){ btn.classList.add('copied'); btn.textContent='✓'; setTimeout(function(){ btn.classList.remove('copied'); btn.textContent='Salin'; },2200); }).catch(function(){ btn.textContent='Salin'; }); })(this,'{{ $gift->account_number }}')">
                Salin
            </button>
        </div>
        @endforeach
    </div>
</section>
@endif

{{-- ── RSVP ── --}}
@if($sections['rsvp'] ?? true)
<section class="sec sec-navy2">
    <span class="eyebrow reveal" style="color:var(--gold);">✦ Konfirmasi Kehadiran ✦</span>
    <div class="gold-divider reveal delay-1"><div class="gold-divider-dot"></div></div>
    <h2 class="sec-title white reveal delay-2">RSVP &amp; Wishes</h2>

    @if($rsvpSent)
    <div class="reveal delay-3"
         style="background:rgba(74,222,128,.1);border:1.5px solid rgba(74,222,128,.3);border-radius:20px;padding:36px 24px;margin-top:28px;text-align:center;">
        <div style="font-size:48px;margin-bottom:14px;">🎉</div>
        <p style="font-size:18px;font-weight:700;color:#4ADE80;font-family:'Cormorant Garamond',serif;font-style:italic;">Terima Kasih!</p>
        <p style="font-size:13px;color:rgba(255,255,255,.5);margin-top:8px;line-height:1.7;">Konfirmasi kehadiran Anda telah kami terima.<br>Kami sangat menantikan kehadiran Anda.</p>
    </div>
    @else
    <form wire:submit="submitRsvp" style="margin-top:28px;">
        <div style="margin-bottom:14px;">
            <label style="display:block;font-size:11px;font-weight:700;color:rgba(255,255,255,.4);margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Nama Lengkap</label>
            <input type="text" wire:model="rsvpName" class="pi-input" placeholder="Masukkan nama Anda">
            @error('rsvpName')<span style="color:#F87171;font-size:11px;display:block;margin-top:4px;">{{ $message }}</span>@enderror
        </div>

        <div style="margin-bottom:14px;">
            <label style="display:block;font-size:11px;font-weight:700;color:rgba(255,255,255,.4);margin-bottom:10px;text-transform:uppercase;letter-spacing:.5px;">Konfirmasi Kehadiran</label>
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
            <label style="display:block;font-size:11px;font-weight:700;color:rgba(255,255,255,.4);margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Jumlah Tamu</label>
            <input type="number" wire:model="rsvpGuestCount" min="1" max="20" class="pi-input">
        </div>

        <div style="margin-bottom:22px;">
            <label style="display:block;font-size:11px;font-weight:700;color:rgba(255,255,255,.4);margin-bottom:6px;text-transform:uppercase;letter-spacing:.5px;">Pesan &amp; Doa Restu (Opsional)</label>
            <textarea wire:model="rsvpMessage" rows="4" class="pi-input" style="resize:none;" placeholder="Tulis ucapan dan doa restu..."></textarea>
        </div>

        <button type="submit" class="pi-btn" wire:loading.attr="disabled">
            <span wire:loading.remove wire:target="submitRsvp">💌 &nbsp; Kirim Konfirmasi</span>
            <span wire:loading wire:target="submitRsvp">Mengirim...</span>
        </button>
    </form>
    @endif

    {{-- WISHES / GUESTBOOK --}}
    @if($sections['guestbook'] ?? true)
    <div class="wish-wrap">
        <div class="gold-divider" style="margin:32px auto 24px;"><div class="gold-divider-dot"></div></div>
        <span class="eyebrow" style="color:var(--gold);">✦ Ucapan &amp; Doa ✦</span>
        <h3 style="font-family:'Cormorant Garamond',serif;font-size:22px;color:#fff;font-style:italic;text-align:center;margin:8px 0 20px;">Buku Tamu</h3>

        @if(!$guestbookSent)
        <form wire:submit="submitGuestbook" style="margin-bottom:24px;">
            <div style="margin-bottom:10px;">
                <input type="text" wire:model="guestbookName" class="pi-input" placeholder="Nama Anda">
                @error('guestbookName')<span style="color:#F87171;font-size:11px;display:block;margin-top:4px;">{{ $message }}</span>@enderror
            </div>
            <div style="margin-bottom:12px;">
                <textarea wire:model="guestbookMessage" rows="3" class="pi-input" style="resize:none;" placeholder="Tulis ucapan dan doa untuk kedua mempelai..."></textarea>
                @error('guestbookMessage')<span style="color:#F87171;font-size:11px;display:block;margin-top:4px;">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="pi-btn" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="submitGuestbook">✉️ &nbsp; Kirim Ucapan</span>
                <span wire:loading wire:target="submitGuestbook">Mengirim...</span>
            </button>
        </form>
        @else
        <div style="background:rgba(74,222,128,.1);border:1px solid rgba(74,222,128,.3);border-radius:14px;padding:14px;margin:0 0 20px;text-align:center;">
            <p style="font-size:13px;color:#4ADE80;font-weight:700;">✅ Ucapan Anda telah terkirim!</p>
        </div>
        @endif

        @if($inv->guestbookEntries->isNotEmpty())
        <div>
            @foreach($inv->guestbookEntries->take(12) as $entry)
            <div class="wish-entry">
                <div style="display:flex;justify-content:space-between;align-items:flex-start;">
                    <div class="wish-name">{{ $entry->name }}</div>
                    <div class="wish-time">{{ $entry->created_at->diffForHumans() }}</div>
                </div>
                <p class="wish-msg">{{ $entry->message }}</p>
            </div>
            @endforeach
        </div>
        @endif
    </div>
    @endif
</section>
@endif

{{-- ── CLOSING ── --}}
<div class="closing-section">
    <div class="closing-bg"></div>
    <div class="closing-overlay"></div>
    <div class="closing-content">
        <div style="opacity:.35;margin-bottom:20px;display:flex;justify-content:center;">
            <svg width="160" height="16" viewBox="0 0 160 16" fill="none">
                <line x1="0" y1="8" x2="48" y2="8" stroke="{{ $primary }}" stroke-width=".8"/>
                <circle cx="56" cy="8" r="2" fill="{{ $primary }}"/>
                <circle cx="66" cy="8" r="1" fill="{{ $primary }}"/>
                <circle cx="80" cy="8" r="3" fill="{{ $primary }}"/>
                <circle cx="94" cy="8" r="1" fill="{{ $primary }}"/>
                <circle cx="104" cy="8" r="2" fill="{{ $primary }}"/>
                <line x1="112" y1="8" x2="160" y2="8" stroke="{{ $primary }}" stroke-width=".8"/>
            </svg>
        </div>
        <div class="closing-names">{{ $groom }}<br>&amp; {{ $bride }}</div>
        @if($eventDate)
        <p class="closing-date">{{ \Carbon\Carbon::parse($eventDate)->translatedFormat('d F Y') }}</p>
        @endif
        <p class="closing-closing" style="margin-top:24px;">~ Terima Kasih ~</p>
        <p style="font-size:12px;color:rgba(255,255,255,.35);margin-top:8px;line-height:1.8;font-style:italic;">
            Merupakan suatu kehormatan dan kebahagiaan bagi kami<br>apabila Bapak/Ibu/Saudara/i berkenan hadir.
        </p>
    </div>
</div>

<div class="inv-brand">
    <a href="{{ route('register') }}">
        Dibuat dengan <strong>UndanganKu</strong>
    </a>
</div>

</div>{{-- end #inv-main --}}

{{-- ══════════════════════════════════════════════════════════════ --}}
{{-- JAVASCRIPT                                                     --}}
{{-- ══════════════════════════════════════════════════════════════ --}}
<script>
// ── Open invitation ──────────────────────────────────────────────
function openInvitation() {
    var cover = document.getElementById('inv-cover');
    var main  = document.getElementById('inv-main');
    // Show music btn
    @if($inv->music && $inv->music->is_active && $inv->music->path)
    var musicBtn = document.getElementById('music-btn');
    if(musicBtn) musicBtn.style.display = 'flex';
    @endif
    // Slide cover up
    cover.classList.add('slide-up');
    document.body.classList.remove('inv-locked');
    // Show main content
    setTimeout(function() {
        main.classList.add('visible');
        cover.style.display = 'none';
    }, 1100);
    // Auto-play music
    @if($inv->music && $inv->music->is_active && $inv->music->path && ($inv->music->auto_play ?? false))
    setTimeout(function() {
        var audio = document.getElementById('bg-music');
        if(audio) {
            audio.play().then(function(){
                _playing = true;
                document.getElementById('music-icon-play').style.display = 'none';
                document.getElementById('music-icon-pause').style.display = '';
                if(document.getElementById('music-btn')) document.getElementById('music-btn').classList.add('playing');
            }).catch(function(){});
        }
    }, 1300);
    @endif
    // Simpan state di sessionStorage agar tetap terbuka setelah re-render Livewire
    try { sessionStorage.setItem('_inv_{{ $inv->uuid }}', '1'); } catch(e) {}
}

// Pulihkan state "terbuka" setelah Livewire re-render (RSVP, buku tamu, dll)
document.addEventListener('livewire:update', function() {
    try {
        if (sessionStorage.getItem('_inv_{{ $inv->uuid }}') === '1') {
            var m = document.getElementById('inv-main');
            if (m) m.classList.add('visible');
        }
    } catch(e) {}
});
// Cek saat halaman pertama load (jika session masih aktif)
(function() {
    try {
        if (sessionStorage.getItem('_inv_{{ $inv->uuid }}') === '1') {
            var cover = document.getElementById('inv-cover');
            var main  = document.getElementById('inv-main');
            if (cover) cover.style.display = 'none';
            if (main)  main.classList.add('visible');
            @if($inv->music && $inv->music->is_active && $inv->music->path)
            var mb = document.getElementById('music-btn');
            if (mb) mb.style.display = 'flex';
            @endif
        }
    } catch(e) {}
})();

// ── Scroll reveal ─────────────────────────────────────────────────
var _revealObs = new IntersectionObserver(function(entries){
    entries.forEach(function(e){
        if(e.isIntersecting){ e.target.classList.add('visible'); _revealObs.unobserve(e.target); }
    });
}, { threshold: 0.12 });

document.querySelectorAll('.reveal').forEach(function(el){
    _revealObs.observe(el);
});

// ── Music ─────────────────────────────────────────────────────────
var _music = document.getElementById('bg-music');
var _playing = false;
function toggleMusic() {
    if(!_music) return;
    if(_playing) {
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

// ── Lightbox ──────────────────────────────────────────────────────
function openLightbox(src) {
    document.getElementById('lightbox-img').src = src;
    document.getElementById('lightbox').style.display = 'flex';
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
    document.body.style.overflow = '';
}
document.addEventListener('keydown', function(e){ if(e.key==='Escape') closeLightbox(); });

// ── Gift toggle ───────────────────────────────────────────────────
function toggleGift(btn) {
    var cards = document.getElementById('gift-cards');
    var isOpen = cards.classList.contains('open');
    cards.classList.toggle('open');
    btn.innerHTML = isOpen
        ? '<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="6 9 12 15 18 9"/></svg> Lihat Nomor Rekening'
        : '<svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><polyline points="18 15 12 9 6 15"/></svg> Sembunyikan';
}

// Lock body while cover shown
document.body.classList.add('inv-locked');
</script>
</div>
