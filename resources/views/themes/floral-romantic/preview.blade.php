@php
    $groom = $groomName ?: ($data['groom_name'] ?? 'Nama Pria');
    $bride = $brideName ?: ($data['bride_name'] ?? 'Nama Wanita');
    $eDate = $eventDate ?: ($data['event_date'] ?? '');
    $eTime = $eventTime ?: ($data['event_time'] ?? '');
    $loc   = $location  ?: ($data['location']   ?? 'Nama Venue');
    $story = $data['story'] ?? '';
    $pc    = $primaryColor    ?? '#C8956C';
    $bg    = $backgroundColor ?? '#FDF8F2';
    $fh    = $fontHeading     ?? 'Cormorant Garamond';
    $fb    = $fontBody        ?? 'Poppins';
@endphp
<style>
@@import url('https://fonts.googleapis.com/css2?family=Great+Vibes&family=Cormorant+Garamond:ital,wght@0,400;0,600;1,400&family=Poppins:wght@300;400;500&display=swap');

.fr-wrap * { box-sizing:border-box; margin:0; padding:0; }
.fr-wrap { font-family:'{{ $fb }}',sans-serif; background:{{ $bg }}; overflow:hidden; }

/* ── Corner ornament animations ── */
@@keyframes fr-sway {
  0%,100% { transform:rotate(0deg); transform-origin:0 0; }
  33%     { transform:rotate(2deg);  transform-origin:0 0; }
  66%     { transform:rotate(-1.5deg); transform-origin:0 0; }
}
@@keyframes fr-sway-r {
  0%,100% { transform:scaleX(-1) rotate(0deg); transform-origin:100% 0; }
  33%     { transform:scaleX(-1) rotate(2deg);  transform-origin:100% 0; }
  66%     { transform:scaleX(-1) rotate(-1.5deg); transform-origin:100% 0; }
}
@@keyframes fr-breathe {
  0%,100% { opacity:.75; transform:scale(1); }
  50%     { opacity:1;   transform:scale(1.03); }
}
@@keyframes fr-float {
  0%   { transform:translateY(0) rotate(0deg);   opacity:0; }
  8%   { opacity:.7; }
  85%  { opacity:.3; }
  100% { transform:translateY(-480px) rotate(540deg) translateX(60px); opacity:0; }
}
@@keyframes fr-fadeup {
  from { opacity:0; transform:translateY(16px); }
  to   { opacity:1; transform:translateY(0); }
}
@@keyframes fr-pulse {
  0%,100% { transform:scale(1); }
  50%     { transform:scale(1.06); }
}
@@keyframes fr-shimmer {
  0%,100% { opacity:.4; }
  50%     { opacity:1; }
}

/* ── Cover section ── */
.fr-cover {
    position:relative; min-height:480px;
    display:flex; flex-direction:column;
    align-items:center; justify-content:center;
    text-align:center; padding:56px 24px 48px;
    overflow:hidden;
    background: linear-gradient(160deg,
        {{ $bg }} 0%,
        #f9eee4 40%,
        {{ $bg }} 100%
    );
}
.fr-cover-pattern {
    position:absolute; inset:0;
    background-image:
        radial-gradient(circle, {{ $pc }}18 1px, transparent 1px),
        radial-gradient(circle, {{ $pc }}0C 1px, transparent 1px);
    background-size: 30px 30px, 15px 15px;
    background-position: 0 0, 15px 15px;
    pointer-events:none;
}
/* Corner ornaments */
.fr-corner { position:absolute; pointer-events:none; z-index:3; }
.fr-corner.tl { top:0; left:0; transform-origin:0 0; animation:fr-sway 6s ease-in-out infinite; }
.fr-corner.tr { top:0; right:0; transform:scaleX(-1); transform-origin:100% 0; animation:fr-sway-r 7s ease-in-out infinite .5s; }
.fr-corner.bl { bottom:0; left:0; transform:scaleY(-1); transform-origin:0 100%; animation:fr-sway 8s ease-in-out infinite 1s; }
.fr-corner.br { bottom:0; right:0; transform:scale(-1,-1); transform-origin:100% 100%; animation:fr-sway-r 6.5s ease-in-out infinite 1.5s; }

/* Floating petals */
.fr-petals { position:absolute; inset:0; pointer-events:none; overflow:hidden; z-index:2; }
.fr-petal {
    position:absolute; bottom:-20px;
    width:10px; height:14px; border-radius:50% 0 50% 0;
    animation:fr-float linear infinite;
    opacity:0;
}

/* Cover content */
.fr-badge {
    font-family:'Poppins',sans-serif; font-size:9px; font-weight:600;
    letter-spacing:3px; text-transform:uppercase;
    color:{{ $pc }}; margin-bottom:14px; opacity:.8;
    animation:fr-fadeup .7s ease forwards;
}
.fr-names { animation:fr-fadeup .8s ease forwards .2s; opacity:0; }
.fr-name {
    font-family:'Great Vibes',cursive;
    font-size:clamp(2rem,10vw,3rem);
    color:#3d2a1e; line-height:1.05;
    text-shadow:0 2px 12px rgba(200,149,108,.25);
    display:block;
}
.fr-amp {
    font-family:'Cormorant Garamond',serif;
    font-size:11px; letter-spacing:6px; color:{{ $pc }};
    display:block; margin:6px 0; opacity:.7;
}
.fr-divider {
    display:flex; align-items:center; justify-content:center;
    gap:8px; margin:20px 0 16px;
    animation:fr-fadeup .7s ease forwards .5s; opacity:0;
}
.fr-divider-line { flex:1; height:1px; background:{{ $pc }}44; max-width:60px; }
.fr-divider-flower { color:{{ $pc }}; font-size:14px; animation:fr-pulse 3s ease-in-out infinite; }
.fr-date-box {
    display:inline-block;
    border:1px solid {{ $pc }}44;
    border-radius:20px;
    padding:8px 20px;
    font-size:11px; color:#7a5c42;
    background:rgba(255,255,255,.6);
    backdrop-filter:blur(4px);
    animation:fr-fadeup .7s ease forwards .7s; opacity:0;
}
.fr-loc {
    margin-top:10px; font-size:11px; color:#9a7a62;
    animation:fr-fadeup .7s ease forwards .9s; opacity:0;
}

/* ── Sections ── */
.fr-sec {
    padding:36px 24px; position:relative; overflow:hidden;
}
.fr-sec-cream { background:{{ $bg }}; }
.fr-sec-blush { background:linear-gradient(180deg, #fdf0e8 0%, #fdf8f2 100%); }
.fr-sec-dark  { background:#2d1a10; }

.fr-eyebrow {
    font-size:9px; letter-spacing:4px; text-transform:uppercase;
    color:{{ $pc }}; font-weight:600; text-align:center;
    display:block; margin-bottom:8px;
}
.fr-sec-title {
    font-family:'Cormorant Garamond',serif;
    font-size:24px; color:#3d2a1e; font-weight:400;
    text-align:center; margin-bottom:20px;
    font-style:italic;
}
.fr-gold-line {
    width:48px; height:1.5px; background:linear-gradient(90deg,transparent,{{ $pc }},transparent);
    margin:12px auto 20px; border-radius:2px;
}

/* Couple section ornamental side border */
.fr-couple-wrap {
    display:grid; grid-template-columns:1fr 40px 1fr; gap:8px;
    align-items:center; max-width:300px; margin:0 auto;
}
.fr-couple-sep {
    display:flex; flex-direction:column; align-items:center; gap:6px;
}
.fr-couple-sep span { font-size:18px; color:{{ $pc }}; animation:fr-pulse 4s ease-in-out infinite; }
.fr-couple-name {
    font-family:'Cormorant Garamond',serif; font-size:18px; color:#3d2a1e;
    font-style:italic; text-align:center;
}
.fr-couple-note { font-size:10px; color:#a08070; text-align:center; margin-top:4px; line-height:1.5; }

/* Countdown */
.fr-countdown {
    display:flex; justify-content:center; gap:12px; flex-wrap:wrap;
    margin-top:16px;
}
.fr-count-box {
    text-align:center; min-width:52px;
    background:rgba(255,255,255,.7); border:1px solid {{ $pc }}33;
    border-radius:14px; padding:10px 14px;
    box-shadow:0 2px 12px {{ $pc }}18;
}
.fr-count-num {
    font-family:'Cormorant Garamond',serif; font-size:28px;
    color:#3d2a1e; font-weight:600; line-height:1;
}
.fr-count-lbl { font-size:8.5px; text-transform:uppercase; letter-spacing:1.5px; color:#a08070; margin-top:3px; }

/* Story */
.fr-story-card {
    background:rgba(255,255,255,.6); border:1px solid {{ $pc }}22;
    border-radius:20px; padding:24px 20px;
    text-align:center; position:relative;
    box-shadow:0 4px 24px {{ $pc }}14;
}
.fr-story-card::before {
    content:'"'; font-family:'Great Vibes',cursive; font-size:60px;
    color:{{ $pc }}22; position:absolute; top:-8px; left:12px; line-height:1;
}
.fr-story-text { font-size:12px; color:#6a5040; line-height:1.9; font-style:italic; }

/* Gallery */
.fr-gallery-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:6px; }
.fr-gallery-item { aspect-ratio:1; border-radius:12px; overflow:hidden; background:{{ $pc }}22; }
.fr-gallery-item img { width:100%; height:100%; object-fit:cover; }

/* Bottom floral border between sections */
.fr-floral-divider {
    text-align:center; padding:6px 0;
    color:{{ $pc }}; font-size:16px; letter-spacing:6px;
    opacity:.45;
}
</style>

<div class="fr-wrap">

{{-- ══════════ COVER ══════════ --}}
<div class="fr-cover">
    <div class="fr-cover-pattern"></div>

    {{-- Top-left corner --}}
    <svg class="fr-corner tl" width="110" height="110" viewBox="0 0 110 110" fill="none">
        <path d="M2 2 Q18 22 42 48 Q56 65 60 88" stroke="{{ $pc }}" stroke-width="1.4" opacity=".55"/>
        <path d="M2 2 Q22 18 48 42 Q65 56 88 60" stroke="{{ $pc }}" stroke-width="1.4" opacity=".55"/>
        <path d="M28 8 Q22 20 16 36" stroke="{{ $pc }}" stroke-width="1" opacity=".4"/>
        <path d="M8 28 Q20 22 36 16" stroke="{{ $pc }}" stroke-width="1" opacity=".4"/>
        <path d="M16 36 Q10 28 20 22 Q24 34 16 36Z" fill="#8FBF91" opacity=".65"/>
        <path d="M36 16 Q28 10 22 20 Q34 24 36 16Z" fill="#8FBF91" opacity=".65"/>
        <path d="M44 26 Q38 18 48 14 Q52 26 44 26Z" fill="#8FBF91" opacity=".6"/>
        <path d="M26 44 Q18 38 14 48 Q26 52 26 44Z" fill="#8FBF91" opacity=".6"/>
        <path d="M56 46 Q50 38 58 32 Q62 44 56 46Z" fill="#8FBF91" opacity=".55"/>
        <path d="M46 56 Q38 50 32 58 Q44 62 46 56Z" fill="#8FBF91" opacity=".55"/>
        {{-- Rose petals --}}
        <ellipse cx="8" cy="8" rx="9" ry="5.5" fill="#F4A7B9" opacity=".85" transform="rotate(0,8,8)"/>
        <ellipse cx="8" cy="8" rx="9" ry="5.5" fill="#F4A7B9" opacity=".85" transform="rotate(36,8,8)"/>
        <ellipse cx="8" cy="8" rx="9" ry="5.5" fill="#F4A7B9" opacity=".85" transform="rotate(72,8,8)"/>
        <ellipse cx="8" cy="8" rx="9" ry="5.5" fill="#F4A7B9" opacity=".85" transform="rotate(108,8,8)"/>
        <ellipse cx="8" cy="8" rx="9" ry="5.5" fill="#F4A7B9" opacity=".85" transform="rotate(144,8,8)"/>
        <circle cx="8" cy="8" r="4.5" fill="#F7C04A" opacity=".9"/>
        <circle cx="8" cy="8" r="2" fill="#E8902A" opacity=".8"/>
        {{-- Small bud 1 --}}
        <ellipse cx="62" cy="44" rx="5.5" ry="3.5" fill="#F4A7B9" opacity=".75" transform="rotate(0,62,44)"/>
        <ellipse cx="62" cy="44" rx="5.5" ry="3.5" fill="#F4A7B9" opacity=".75" transform="rotate(60,62,44)"/>
        <ellipse cx="62" cy="44" rx="5.5" ry="3.5" fill="#F4A7B9" opacity=".75" transform="rotate(120,62,44)"/>
        <circle cx="62" cy="44" r="2.5" fill="#F7C04A" opacity=".85"/>
        {{-- Small bud 2 --}}
        <ellipse cx="44" cy="62" rx="5.5" ry="3.5" fill="#F9C4D0" opacity=".7" transform="rotate(30,44,62)"/>
        <ellipse cx="44" cy="62" rx="5.5" ry="3.5" fill="#F9C4D0" opacity=".7" transform="rotate(90,44,62)"/>
        <ellipse cx="44" cy="62" rx="5.5" ry="3.5" fill="#F9C4D0" opacity=".7" transform="rotate(150,44,62)"/>
        <circle cx="44" cy="62" r="2" fill="#F7C04A" opacity=".8"/>
        {{-- Tiny dots --}}
        <circle cx="70" cy="72" r="2.5" fill="{{ $pc }}" opacity=".3"/>
        <circle cx="72" cy="70" r="1.5" fill="{{ $pc }}" opacity=".2"/>
    </svg>

    {{-- Top-right corner --}}
    <svg class="fr-corner tr" width="110" height="110" viewBox="0 0 110 110" fill="none">
        <path d="M2 2 Q18 22 42 48 Q56 65 60 88" stroke="{{ $pc }}" stroke-width="1.4" opacity=".55"/>
        <path d="M2 2 Q22 18 48 42 Q65 56 88 60" stroke="{{ $pc }}" stroke-width="1.4" opacity=".55"/>
        <path d="M28 8 Q22 20 16 36" stroke="{{ $pc }}" stroke-width="1" opacity=".4"/>
        <path d="M8 28 Q20 22 36 16" stroke="{{ $pc }}" stroke-width="1" opacity=".4"/>
        <path d="M16 36 Q10 28 20 22 Q24 34 16 36Z" fill="#8FBF91" opacity=".65"/>
        <path d="M36 16 Q28 10 22 20 Q34 24 36 16Z" fill="#8FBF91" opacity=".65"/>
        <path d="M44 26 Q38 18 48 14 Q52 26 44 26Z" fill="#8FBF91" opacity=".6"/>
        <path d="M26 44 Q18 38 14 48 Q26 52 26 44Z" fill="#8FBF91" opacity=".6"/>
        <ellipse cx="8" cy="8" rx="9" ry="5.5" fill="#F4A7B9" opacity=".85" transform="rotate(0,8,8)"/>
        <ellipse cx="8" cy="8" rx="9" ry="5.5" fill="#F4A7B9" opacity=".85" transform="rotate(36,8,8)"/>
        <ellipse cx="8" cy="8" rx="9" ry="5.5" fill="#F4A7B9" opacity=".85" transform="rotate(72,8,8)"/>
        <ellipse cx="8" cy="8" rx="9" ry="5.5" fill="#F4A7B9" opacity=".85" transform="rotate(108,8,8)"/>
        <ellipse cx="8" cy="8" rx="9" ry="5.5" fill="#F4A7B9" opacity=".85" transform="rotate(144,8,8)"/>
        <circle cx="8" cy="8" r="4.5" fill="#F7C04A" opacity=".9"/>
        <circle cx="8" cy="8" r="2" fill="#E8902A" opacity=".8"/>
        <ellipse cx="62" cy="44" rx="5.5" ry="3.5" fill="#F4A7B9" opacity=".75" transform="rotate(0,62,44)"/>
        <ellipse cx="62" cy="44" rx="5.5" ry="3.5" fill="#F4A7B9" opacity=".75" transform="rotate(60,62,44)"/>
        <ellipse cx="62" cy="44" rx="5.5" ry="3.5" fill="#F4A7B9" opacity=".75" transform="rotate(120,62,44)"/>
        <circle cx="62" cy="44" r="2.5" fill="#F7C04A" opacity=".85"/>
    </svg>

    {{-- Bottom-left corner --}}
    <svg class="fr-corner bl" width="110" height="110" viewBox="0 0 110 110" fill="none">
        <path d="M2 2 Q18 22 42 48 Q56 65 60 88" stroke="{{ $pc }}" stroke-width="1.4" opacity=".5"/>
        <path d="M2 2 Q22 18 48 42 Q65 56 88 60" stroke="{{ $pc }}" stroke-width="1.4" opacity=".5"/>
        <path d="M28 8 Q22 20 16 36" stroke="{{ $pc }}" stroke-width="1" opacity=".35"/>
        <path d="M8 28 Q20 22 36 16" stroke="{{ $pc }}" stroke-width="1" opacity=".35"/>
        <path d="M16 36 Q10 28 20 22 Q24 34 16 36Z" fill="#8FBF91" opacity=".6"/>
        <path d="M36 16 Q28 10 22 20 Q34 24 36 16Z" fill="#8FBF91" opacity=".6"/>
        <ellipse cx="8" cy="8" rx="8" ry="5" fill="#F9C4D0" opacity=".8" transform="rotate(0,8,8)"/>
        <ellipse cx="8" cy="8" rx="8" ry="5" fill="#F9C4D0" opacity=".8" transform="rotate(60,8,8)"/>
        <ellipse cx="8" cy="8" rx="8" ry="5" fill="#F9C4D0" opacity=".8" transform="rotate(120,8,8)"/>
        <circle cx="8" cy="8" r="4" fill="#F7C04A" opacity=".85"/>
    </svg>

    {{-- Bottom-right corner --}}
    <svg class="fr-corner br" width="110" height="110" viewBox="0 0 110 110" fill="none">
        <path d="M2 2 Q18 22 42 48 Q56 65 60 88" stroke="{{ $pc }}" stroke-width="1.4" opacity=".5"/>
        <path d="M2 2 Q22 18 48 42 Q65 56 88 60" stroke="{{ $pc }}" stroke-width="1.4" opacity=".5"/>
        <path d="M28 8 Q22 20 16 36" stroke="{{ $pc }}" stroke-width="1" opacity=".35"/>
        <path d="M8 28 Q20 22 36 16" stroke="{{ $pc }}" stroke-width="1" opacity=".35"/>
        <path d="M16 36 Q10 28 20 22 Q24 34 16 36Z" fill="#8FBF91" opacity=".6"/>
        <path d="M36 16 Q28 10 22 20 Q34 24 36 16Z" fill="#8FBF91" opacity=".6"/>
        <ellipse cx="8" cy="8" rx="8" ry="5" fill="#F9C4D0" opacity=".8" transform="rotate(0,8,8)"/>
        <ellipse cx="8" cy="8" rx="8" ry="5" fill="#F9C4D0" opacity=".8" transform="rotate(60,8,8)"/>
        <ellipse cx="8" cy="8" rx="8" ry="5" fill="#F9C4D0" opacity=".8" transform="rotate(120,8,8)"/>
        <circle cx="8" cy="8" r="4" fill="#F7C04A" opacity=".85"/>
    </svg>

    {{-- Floating petals --}}
    <div class="fr-petals">
        @php
        $petalColors = ['#F4A7B9','#F9C4D0','#FDDDE6','#F7A8C0','#FCC8D8'];
        $petalPositions = [5,12,22,35,48,58,68,78,88,95];
        @endphp
        @foreach($petalPositions as $i => $pos)
        <div class="fr-petal" style="
            left:{{ $pos }}%;
            background:{{ $petalColors[$i % count($petalColors)] }};
            animation-duration:{{ 4 + ($i * 1.3) }}s;
            animation-delay:{{ $i * 0.7 }}s;
            width:{{ 7 + ($i % 3) * 3 }}px;
            height:{{ 10 + ($i % 4) * 3 }}px;
            opacity:.6;
        "></div>
        @endforeach
    </div>

    {{-- Cover content --}}
    <div style="position:relative;z-index:4;width:100%;">
        <p class="fr-badge">✦ &nbsp; The Wedding Of &nbsp; ✦</p>
        <div class="fr-names">
            <span class="fr-name">{{ $groom }}</span>
            <span class="fr-amp">— &amp; —</span>
            <span class="fr-name">{{ $bride }}</span>
        </div>
        <div class="fr-divider">
            <div class="fr-divider-line"></div>
            <span class="fr-divider-flower">❀</span>
            <div class="fr-divider-line"></div>
        </div>
        @if($eDate)
        <div class="fr-date-box">
            📅 &nbsp; {{ \Carbon\Carbon::parse($eDate)->translatedFormat('d F Y') }}
            @if($eTime) &nbsp;·&nbsp; {{ $eTime }} @endif
        </div>
        @endif
        @if($loc)
        <p class="fr-loc">📍 {{ $loc }}</p>
        @endif
    </div>
</div>

<div class="fr-floral-divider">❀ · ✿ · ❀ · ✿ · ❀</div>

{{-- ══════════ COUPLE ══════════ --}}
@if($sections['couple'] ?? true)
<div class="fr-sec fr-sec-blush">
    {{-- Side ornament (left) --}}
    <svg style="position:absolute;left:0;top:50%;transform:translateY(-50%);opacity:.25;" width="40" height="120" viewBox="0 0 40 120" fill="none">
        <path d="M38 0 Q20 30 22 60 Q24 90 38 120" stroke="{{ $pc }}" stroke-width="1.5"/>
        <path d="M22 30 Q10 26 6 16" stroke="{{ $pc }}" stroke-width="1"/>
        <path d="M6 16 Q2 8 10 5 Q12 15 6 16Z" fill="#8FBF91"/>
        <path d="M22 60 Q8 58 4 48" stroke="{{ $pc }}" stroke-width="1"/>
        <path d="M4 48 Q0 38 8 36 Q10 46 4 48Z" fill="#8FBF91"/>
        <ellipse cx="22" cy="90" rx="5" ry="3" fill="#F4A7B9" opacity=".8" transform="rotate(0,22,90)"/>
        <ellipse cx="22" cy="90" rx="5" ry="3" fill="#F4A7B9" opacity=".8" transform="rotate(60,22,90)"/>
        <ellipse cx="22" cy="90" rx="5" ry="3" fill="#F4A7B9" opacity=".8" transform="rotate(120,22,90)"/>
        <circle cx="22" cy="90" r="2.5" fill="#F7C04A" opacity=".85"/>
    </svg>
    {{-- Side ornament (right) --}}
    <svg style="position:absolute;right:0;top:50%;transform:translateY(-50%) scaleX(-1);opacity:.25;" width="40" height="120" viewBox="0 0 40 120" fill="none">
        <path d="M38 0 Q20 30 22 60 Q24 90 38 120" stroke="{{ $pc }}" stroke-width="1.5"/>
        <path d="M22 30 Q10 26 6 16" stroke="{{ $pc }}" stroke-width="1"/>
        <path d="M6 16 Q2 8 10 5 Q12 15 6 16Z" fill="#8FBF91"/>
        <path d="M22 60 Q8 58 4 48" stroke="{{ $pc }}" stroke-width="1"/>
        <path d="M4 48 Q0 38 8 36 Q10 46 4 48Z" fill="#8FBF91"/>
        <ellipse cx="22" cy="90" rx="5" ry="3" fill="#F4A7B9" opacity=".8" transform="rotate(0,22,90)"/>
        <ellipse cx="22" cy="90" rx="5" ry="3" fill="#F4A7B9" opacity=".8" transform="rotate(60,22,90)"/>
        <ellipse cx="22" cy="90" rx="5" ry="3" fill="#F4A7B9" opacity=".8" transform="rotate(120,22,90)"/>
        <circle cx="22" cy="90" r="2.5" fill="#F7C04A" opacity=".85"/>
    </svg>

    <span class="fr-eyebrow">Mempelai</span>
    <h2 class="fr-sec-title">Dengan penuh cinta</h2>
    <div class="fr-gold-line"></div>

    <div class="fr-couple-wrap">
        <div>
            <p class="fr-couple-name">{{ $groom }}</p>
            @if($data['groom_father'] ?? '')
            <p class="fr-couple-note">Putra dari<br>{{ $data['groom_father'] ?? '' }}</p>
            @endif
        </div>
        <div class="fr-couple-sep">
            <span>❀</span>
            <div style="width:1px;height:24px;background:{{ $pc }}44;margin:0 auto;"></div>
            <span>❀</span>
        </div>
        <div>
            <p class="fr-couple-name">{{ $bride }}</p>
            @if($data['bride_father'] ?? '')
            <p class="fr-couple-note">Putri dari<br>{{ $data['bride_father'] ?? '' }}</p>
            @endif
        </div>
    </div>
</div>
<div class="fr-floral-divider">✿ · ❀ · ✿</div>
@endif

{{-- ══════════ COUNTDOWN ══════════ --}}
@if(($sections['countdown'] ?? true) && $eDate)
@php
    $diff = max(0, now()->diffInDays(\Carbon\Carbon::parse($eDate), false));
    $months = max(0, (int) now()->diffInMonths(\Carbon\Carbon::parse($eDate), false));
    $weeks  = max(0, (int) now()->diffInWeeks(\Carbon\Carbon::parse($eDate), false));
@endphp
<div class="fr-sec fr-sec-cream">
    <span class="fr-eyebrow">Menuju Hari Bahagia</span>
    <h2 class="fr-sec-title">Hitung Mundur</h2>
    <div class="fr-gold-line"></div>
    <div class="fr-countdown">
        <div class="fr-count-box">
            <div class="fr-count-num">{{ $months }}</div>
            <div class="fr-count-lbl">Bulan</div>
        </div>
        <div class="fr-count-box">
            <div class="fr-count-num">{{ $weeks }}</div>
            <div class="fr-count-lbl">Minggu</div>
        </div>
        <div class="fr-count-box">
            <div class="fr-count-num">{{ $diff }}</div>
            <div class="fr-count-lbl">Hari</div>
        </div>
    </div>
    <p style="text-align:center;font-size:11px;color:#a08070;margin-top:16px;">
        {{ \Carbon\Carbon::parse($eDate)->translatedFormat('l, d F Y') }}
    </p>
</div>
<div class="fr-floral-divider">❀ · ✿ · ❀</div>
@endif

{{-- ══════════ STORY ══════════ --}}
@if(($sections['story'] ?? true) && $story)
<div class="fr-sec fr-sec-blush">
    <span class="fr-eyebrow">Kisah Kami</span>
    <h2 class="fr-sec-title">Love Story</h2>
    <div class="fr-gold-line"></div>
    <div class="fr-story-card">
        <p class="fr-story-text">{{ $story }}</p>
    </div>
</div>
<div class="fr-floral-divider">✿ · ❀ · ✿</div>
@endif

{{-- ══════════ GALLERY ══════════ --}}
@if(($sections['gallery'] ?? true) && $invitation->galleries->isNotEmpty())
<div class="fr-sec fr-sec-cream">
    <span class="fr-eyebrow">Galeri Foto</span>
    <h2 class="fr-sec-title">Momen Indah</h2>
    <div class="fr-gold-line"></div>
    <div class="fr-gallery-grid">
        @foreach($invitation->galleries->take(6) as $gallery)
        <div class="fr-gallery-item">
            <img src="{{ $gallery->getUrl() }}" alt="Foto">
        </div>
        @endforeach
    </div>
</div>
@endif

</div>
