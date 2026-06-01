@php
    $groom = $groomName ?: ($data['groom_name'] ?? 'Nama Pria');
    $bride = $brideName ?: ($data['bride_name'] ?? 'Nama Wanita');
    $eDate = $eventDate ?: ($data['event_date'] ?? '');
    $eTime = $eventTime ?: ($data['event_time'] ?? '');
    $loc = $location ?: ($data['location'] ?? 'Nama Venue');
    $locAddr = $data['location_address'] ?? '';
    $story = $data['story'] ?? '';
@endphp
<div style="font-family: '{{ $fontBody ?? 'Poppins' }}', sans-serif; background: {{ $backgroundColor ?? '#fffdf7' }}; min-height: 100vh;">
    {{-- Cover --}}
    <section style="background: linear-gradient(135deg, {{ $primaryColor ?? '#D4AF37' }}22, {{ $primaryColor ?? '#D4AF37' }}44); min-height: 100vh; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; padding:40px 20px; position:relative;">
        <div style="position:absolute; top:20px; left:0; right:0; text-align:center;">
            <div style="border-top:1px solid {{ $primaryColor ?? '#D4AF37' }}44; width:80%; margin:0 auto;"></div>
        </div>
        <p style="font-size:11px; letter-spacing:3px; text-transform:uppercase; color:{{ $primaryColor ?? '#D4AF37' }}; margin-bottom:16px;">THE WEDDING OF</p>
        <h1 style="font-family:'{{ $fontHeading ?? 'Playfair Display' }}', serif; font-size:42px; color:#3d2b1f; line-height:1.2; margin-bottom:8px;">{{ $groom }}</h1>
        <p style="font-size:20px; color:{{ $primaryColor ?? '#D4AF37' }}; margin:4px 0;">&</p>
        <h1 style="font-family:'{{ $fontHeading ?? 'Playfair Display' }}', serif; font-size:42px; color:#3d2b1f; line-height:1.2; margin-bottom:24px;">{{ $bride }}</h1>
        @if($eDate)
        <div style="border:1px solid {{ $primaryColor ?? '#D4AF37' }}44; border-radius:12px; padding:16px 28px; display:inline-block;">
            <p style="font-size:13px; color:#8b6f47;">{{ \Carbon\Carbon::parse($eDate)->translatedFormat('d F Y') }}</p>
            @if($eTime)<p style="font-size:12px; color:#aaa; margin-top:2px;">{{ $eTime }}</p>@endif
        </div>
        @endif
        @if($loc)
        <p style="margin-top:16px; font-size:12px; color:#8b6f47;">📍 {{ $loc }}</p>
        @endif
    </section>

    {{-- Couple --}}
    @if(($sections['couple'] ?? true))
    <section style="padding:40px 24px; background:#fff; text-align:center;">
        <p style="font-size:10px; letter-spacing:3px; text-transform:uppercase; color:{{ $primaryColor ?? '#D4AF37' }}; margin-bottom:16px;">MEMPELAI</p>
        <div style="display:grid; grid-template-columns:1fr auto 1fr; gap:16px; align-items:center; max-width:320px; margin:0 auto;">
            <div>
                <h3 style="font-family:'{{ $fontHeading ?? 'Playfair Display' }}', serif; font-size:18px; color:#3d2b1f;">{{ $groom }}</h3>
                @if($data['groom_father'] ?? '')
                <p style="font-size:11px; color:#aaa; margin-top:4px;">Putra: {{ $data['groom_father'] ?? '' }}</p>
                @endif
            </div>
            <div style="font-size:24px; color:{{ $primaryColor ?? '#D4AF37' }};">💍</div>
            <div>
                <h3 style="font-family:'{{ $fontHeading ?? 'Playfair Display' }}', serif; font-size:18px; color:#3d2b1f;">{{ $bride }}</h3>
                @if($data['bride_father'] ?? '')
                <p style="font-size:11px; color:#aaa; margin-top:4px;">Putri: {{ $data['bride_father'] ?? '' }}</p>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- Countdown --}}
    @if(($sections['countdown'] ?? true) && $eDate)
    <section style="padding:32px 24px; background:{{ $primaryColor ?? '#D4AF37' }}11; text-align:center;">
        <p style="font-size:10px; letter-spacing:3px; text-transform:uppercase; color:{{ $primaryColor ?? '#D4AF37' }}; margin-bottom:16px;">MENUJU HARI BAHAGIA</p>
        <div style="display:flex; justify-content:center; gap:16px;">
            @php
                $diff = now()->diffInDays(\Carbon\Carbon::parse($eDate), false);
                $days = max(0, $diff);
            @endphp
            <div style="text-align:center;">
                <div style="font-size:32px; font-weight:bold; color:#3d2b1f;">{{ $days }}</div>
                <div style="font-size:10px; text-transform:uppercase; color:#888;">Hari Lagi</div>
            </div>
        </div>
    </section>
    @endif

    {{-- Story --}}
    @if(($sections['story'] ?? true) && $story)
    <section style="padding:40px 24px; background:#fff; text-align:center;">
        <p style="font-size:10px; letter-spacing:3px; text-transform:uppercase; color:{{ $primaryColor ?? '#D4AF37' }}; margin-bottom:12px;">KISAH KAMI</p>
        <p style="font-size:13px; color:#666; line-height:1.8; max-width:320px; margin:0 auto;">{{ $story }}</p>
    </section>
    @endif

    {{-- Galleries preview --}}
    @if(($sections['gallery'] ?? true) && $invitation->galleries->isNotEmpty())
    <section style="padding:40px 24px; background:#fafafa; text-align:center;">
        <p style="font-size:10px; letter-spacing:3px; text-transform:uppercase; color:{{ $primaryColor ?? '#D4AF37' }}; margin-bottom:16px;">GALERI</p>
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:4px;">
            @foreach($invitation->galleries->take(6) as $gallery)
            <img src="{{ $gallery->getUrl() }}" style="width:100%; aspect-ratio:1; object-fit:cover; border-radius:4px;">
            @endforeach
        </div>
    </section>
    @endif
</div>
