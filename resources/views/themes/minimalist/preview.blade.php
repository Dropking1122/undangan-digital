@php
    $groom = $groomName ?: ($data['groom_name'] ?? 'Nama Pria');
    $bride = $brideName ?: ($data['bride_name'] ?? 'Nama Wanita');
    $eDate = $eventDate ?: ($data['event_date'] ?? '');
    $eTime = $eventTime ?: ($data['event_time'] ?? '');
    $loc = $location ?: ($data['location'] ?? 'Nama Venue');
    $story = $data['story'] ?? '';
@endphp
<div style="font-family: '{{ $fontBody ?? 'Poppins' }}', sans-serif; background: {{ $backgroundColor ?? '#ffffff' }}; min-height: 100vh;">
    <section style="min-height:100vh; display:flex; flex-direction:column; align-items:center; justify-content:center; text-align:center; padding:40px 24px; border-left:3px solid {{ $primaryColor ?? '#000' }}; border-right:3px solid {{ $primaryColor ?? '#000' }}; margin:0 8px;">
        <p style="font-size:10px; letter-spacing:4px; text-transform:uppercase; color:{{ $primaryColor ?? '#000' }}; margin-bottom:24px;">— We're Getting Married —</p>
        <h1 style="font-family:'{{ $fontHeading ?? 'Playfair Display' }}', serif; font-size:48px; color:#111; margin-bottom:4px; font-weight:400;">{{ $groom }}</h1>
        <p style="font-size:16px; color:#999; margin:8px 0;">&amp;</p>
        <h1 style="font-family:'{{ $fontHeading ?? 'Playfair Display' }}', serif; font-size:48px; color:#111; margin-bottom:32px; font-weight:400;">{{ $bride }}</h1>
        @if($eDate)
        <div style="width:60px; height:1px; background:{{ $primaryColor ?? '#000' }}; margin:0 auto 24px;"></div>
        <p style="font-size:14px; color:#444; letter-spacing:1px;">{{ \Carbon\Carbon::parse($eDate)->translatedFormat('d F Y') }}</p>
        @if($eTime)<p style="font-size:12px; color:#888; margin-top:4px;">{{ $eTime }}</p>@endif
        @endif
        @if($loc)<p style="margin-top:16px; font-size:12px; color:#888;">{{ $loc }}</p>@endif
    </section>
    @if(($sections['couple'] ?? true))
    <section style="padding:48px 24px; text-align:center;">
        <p style="font-size:10px; letter-spacing:3px; text-transform:uppercase; color:#aaa; margin-bottom:24px;">MEMPELAI</p>
        <div style="display:flex; justify-content:center; align-items:center; gap:32px;">
            <div><h3 style="font-size:18px; font-weight:500; color:#111;">{{ $groom }}</h3></div>
            <div style="width:1px; height:40px; background:#ddd;"></div>
            <div><h3 style="font-size:18px; font-weight:500; color:#111;">{{ $bride }}</h3></div>
        </div>
    </section>
    @endif
    @if(($sections['story'] ?? true) && $story)
    <section style="padding:40px 32px; background:#f9f9f9; text-align:center;">
        <p style="font-size:10px; letter-spacing:3px; text-transform:uppercase; color:#aaa; margin-bottom:16px;">OUR STORY</p>
        <p style="font-size:13px; color:#555; line-height:2; max-width:280px; margin:0 auto;">{{ $story }}</p>
    </section>
    @endif
    @if(($sections['gallery'] ?? true) && $invitation->galleries->isNotEmpty())
    <section style="padding:40px 16px; text-align:center;">
        <p style="font-size:10px; letter-spacing:3px; text-transform:uppercase; color:#aaa; margin-bottom:16px;">GALLERY</p>
        <div style="display:grid; grid-template-columns:repeat(2,1fr); gap:8px;">
            @foreach($invitation->galleries->take(4) as $gallery)
            <img src="{{ $gallery->getUrl() }}" style="width:100%; aspect-ratio:1; object-fit:cover;">
            @endforeach
        </div>
    </section>
    @endif
</div>
