<div>
@php
    $inv = $invitation;
    $data = $inv->getInvitationData();
    $groom = $data['groom_name'] ?? 'Mempelai Pria';
    $bride = $data['bride_name'] ?? 'Mempelai Wanita';
    $eventDate = $data['event_date'] ?? null;
    $eventTime = $data['event_time'] ?? null;
    $akadDate = $data['akad_date'] ?? null;
    $akadTime = $data['akad_time'] ?? null;
    $loc = $data['location'] ?? '';
    $locAddr = $data['location_address'] ?? '';
    $mapsUrl = $data['maps_url'] ?? '';
    $story = $data['story'] ?? '';
    $sections = $inv->getSections();
    $theme = $inv->getThemeSettings();
    $primary = $theme['primary_color'] ?? '#D4AF37';
    $bg = $theme['background_color'] ?? '#fffdf7';
    $fontH = $theme['font_heading'] ?? 'Playfair Display';
    $fontB = $theme['font_body'] ?? 'Poppins';
@endphp

<style>
:root{--primary:{{ $primary }};--bg:{{ $bg }};--font-h:'{{ $fontH }}', serif;--font-b:'{{ $fontB }}', sans-serif;}
body{margin:0;background:var(--bg);font-family:var(--font-b);}
.primary{color:var(--primary);}
.bg-primary{background:var(--primary);}
.border-primary{border-color:var(--primary);}
section{padding:64px 24px;max-width:600px;margin:0 auto;}
.section-label{font-size:10px;letter-spacing:4px;text-transform:uppercase;color:var(--primary);margin-bottom:16px;display:block;}
</style>

{{-- Music Player --}}
@if($inv->music && $inv->music->is_active && $inv->music->path)
<audio id="bg-music" {{ $inv->music->loop ? 'loop' : '' }} style="display:none">
    <source src="{{ $inv->music->getUrl() }}" type="audio/mpeg">
</audio>
<button id="music-btn" onclick="toggleMusic()" style="position:fixed;bottom:24px;right:24px;z-index:999;background:var(--primary);color:white;border:none;border-radius:50%;width:48px;height:48px;font-size:20px;cursor:pointer;box-shadow:0 4px 12px rgba(0,0,0,0.2);">🎵</button>
<script>
var music = document.getElementById('bg-music');
var playing = false;
@if($inv->music->auto_play)
document.addEventListener('DOMContentLoaded', function(){
    setTimeout(function(){
        music.play().then(()=>{ playing=true; document.getElementById('music-btn').textContent='⏸️'; }).catch(()=>{});
    }, 1000);
});
@endif
function toggleMusic(){
    if(playing){ music.pause(); playing=false; document.getElementById('music-btn').textContent='🎵'; }
    else { music.play(); playing=true; document.getElementById('music-btn').textContent='⏸️'; }
}
</script>
@endif

{{-- Cover (always shown) --}}
@if($sections['cover'] ?? true)
<section id="cover" style="min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;text-align:center;padding:60px 24px;background:linear-gradient(180deg, {{ $bg }} 0%, {{ $primary }}18 100%);max-width:100%;">
    @if($guestName)
    <div style="background:white;border:1px solid {{ $primary }}44;border-radius:12px;padding:12px 24px;margin-bottom:32px;text-align:center;font-size:12px;color:#666;">
        <p>Kepada Yth.</p>
        <p style="font-weight:600;color:#333;margin-top:2px;">{{ $guestName }}</p>
    </div>
    @endif
    <p class="section-label" style="margin-bottom:24px;">THE WEDDING OF</p>
    <h1 style="font-family:var(--font-h);font-size:52px;color:#2d1f0f;margin:0;line-height:1.1;">{{ $groom }}</h1>
    <div style="font-size:28px;color:var(--primary);margin:12px 0;">&</div>
    <h1 style="font-family:var(--font-h);font-size:52px;color:#2d1f0f;margin:0;line-height:1.1;">{{ $bride }}</h1>
    @if($eventDate)
    <div style="margin-top:32px;border:1px solid {{ $primary }}55;border-radius:16px;padding:16px 32px;display:inline-block;">
        <p style="font-size:14px;color:#7a5c3a;margin:0;">{{ \Carbon\Carbon::parse($eventDate)->translatedFormat('d F Y') }}</p>
        @if($loc)<p style="font-size:12px;color:#999;margin:4px 0 0;">📍 {{ $loc }}</p>@endif
    </div>
    @endif
    @if(!$isOpened)
    <button wire:click="openInvitation" style="margin-top:40px;background:var(--primary);color:white;border:none;padding:16px 40px;border-radius:50px;font-size:14px;font-family:var(--font-b);letter-spacing:1px;cursor:pointer;box-shadow:0 4px 20px {{ $primary }}44;transition:all 0.3s;">
        Buka Undangan 💌
    </button>
    @endif
</section>
@endif

@if($isOpened)

{{-- Couple Section --}}
@if($sections['couple'] ?? true)
<section id="couple" style="text-align:center;padding:64px 24px;max-width:600px;margin:0 auto;">
    <span class="section-label">MEMPELAI</span>
    <div style="display:grid;grid-template-columns:1fr 48px 1fr;gap:16px;align-items:center;max-width:400px;margin:32px auto 0;">
        <div style="text-align:center;">
            <div style="width:80px;height:80px;border-radius:50%;background:{{ $primary }}22;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:32px;">👨</div>
            <h3 style="font-family:var(--font-h);font-size:22px;color:#2d1f0f;margin:0;">{{ $groom }}</h3>
            @if($data['groom_father'] ?? '')<p style="font-size:11px;color:#999;margin:6px 0 0;">Putra: {{ $data['groom_father'] }}</p>@endif
            @if($data['groom_mother'] ?? '')<p style="font-size:11px;color:#999;margin:2px 0 0;">& {{ $data['groom_mother'] }}</p>@endif
        </div>
        <div style="font-size:28px;color:var(--primary);text-align:center;">💍</div>
        <div style="text-align:center;">
            <div style="width:80px;height:80px;border-radius:50%;background:{{ $primary }}22;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;font-size:32px;">👩</div>
            <h3 style="font-family:var(--font-h);font-size:22px;color:#2d1f0f;margin:0;">{{ $bride }}</h3>
            @if($data['bride_father'] ?? '')<p style="font-size:11px;color:#999;margin:6px 0 0;">Putri: {{ $data['bride_father'] }}</p>@endif
            @if($data['bride_mother'] ?? '')<p style="font-size:11px;color:#999;margin:2px 0 0;">& {{ $data['bride_mother'] }}</p>@endif
        </div>
    </div>
</section>
@endif

{{-- Countdown --}}
@if(($sections['countdown'] ?? true) && $eventDate)
<section style="text-align:center;padding:48px 24px;background:{{ $primary }}11;max-width:100%;">
    <div style="max-width:600px;margin:0 auto;">
        <span class="section-label">MENUJU HARI BAHAGIA</span>
        <div style="display:flex;justify-content:center;gap:24px;margin-top:16px;" id="countdown-section">
            @php
                $targetDate = \Carbon\Carbon::parse($eventDate);
                $now = now();
                $daysLeft = max(0, (int)$now->diffInDays($targetDate, false));
            @endphp
            <div style="text-align:center;background:white;padding:16px 24px;border-radius:16px;min-width:72px;box-shadow:0 2px 8px {{ $primary }}22;">
                <div style="font-size:36px;font-weight:700;color:var(--primary);" id="cd-days">{{ $daysLeft }}</div>
                <div style="font-size:10px;text-transform:uppercase;color:#999;margin-top:4px;">Hari</div>
            </div>
            <div style="text-align:center;background:white;padding:16px 24px;border-radius:16px;min-width:72px;box-shadow:0 2px 8px {{ $primary }}22;">
                <div style="font-size:36px;font-weight:700;color:var(--primary);" id="cd-hours">--</div>
                <div style="font-size:10px;text-transform:uppercase;color:#999;margin-top:4px;">Jam</div>
            </div>
            <div style="text-align:center;background:white;padding:16px 24px;border-radius:16px;min-width:72px;box-shadow:0 2px 8px {{ $primary }}22;">
                <div style="font-size:36px;font-weight:700;color:var(--primary);" id="cd-mins">--</div>
                <div style="font-size:10px;text-transform:uppercase;color:#999;margin-top:4px;">Menit</div>
            </div>
        </div>
        <script>
        (function(){
            var target = new Date('{{ $eventDate }}T{{ $eventTime ?? "08:00" }}');
            function update(){
                var now = new Date(), diff = target - now;
                if(diff <= 0){ document.getElementById('cd-days').textContent='0'; return; }
                var d = Math.floor(diff/86400000), h = Math.floor((diff%86400000)/3600000), m = Math.floor((diff%3600000)/60000);
                document.getElementById('cd-days').textContent = d;
                document.getElementById('cd-hours').textContent = String(h).padStart(2,'0');
                document.getElementById('cd-mins').textContent = String(m).padStart(2,'0');
            }
            update(); setInterval(update, 60000);
        })();
        </script>
    </div>
</section>
@endif

{{-- Event Details --}}
<section style="text-align:center;padding:64px 24px;max-width:600px;margin:0 auto;">
    <span class="section-label">DETAIL ACARA</span>
    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-top:24px;max-width:400px;margin-left:auto;margin-right:auto;">
        @if($akadDate)
        <div style="border:1px solid {{ $primary }}33;border-radius:16px;padding:24px 16px;">
            <p style="font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--primary);margin:0 0 8px;">AKAD NIKAH</p>
            <p style="font-size:15px;font-weight:600;color:#2d1f0f;margin:0;">{{ \Carbon\Carbon::parse($akadDate)->translatedFormat('d F Y') }}</p>
            @if($akadTime)<p style="font-size:13px;color:#888;margin:4px 0 0;">{{ $akadTime }} WIB</p>@endif
        </div>
        @endif
        @if($eventDate)
        <div style="border:1px solid {{ $primary }}33;border-radius:16px;padding:24px 16px;background:{{ $primary }}08;">
            <p style="font-size:11px;letter-spacing:2px;text-transform:uppercase;color:var(--primary);margin:0 0 8px;">RESEPSI</p>
            <p style="font-size:15px;font-weight:600;color:#2d1f0f;margin:0;">{{ \Carbon\Carbon::parse($eventDate)->translatedFormat('d F Y') }}</p>
            @if($eventTime)<p style="font-size:13px;color:#888;margin:4px 0 0;">{{ $eventTime }} WIB</p>@endif
        </div>
        @endif
    </div>
    @if($loc)
    <div style="margin-top:24px;background:{{ $primary }}08;border-radius:16px;padding:24px;">
        <p style="font-weight:600;color:#2d1f0f;margin:0 0 4px;">📍 {{ $loc }}</p>
        @if($locAddr)<p style="font-size:12px;color:#888;margin:0;">{{ $locAddr }}</p>@endif
        @if($mapsUrl)
        <a href="{{ $mapsUrl }}" target="_blank" style="display:inline-block;margin-top:12px;background:var(--primary);color:white;text-decoration:none;padding:10px 24px;border-radius:50px;font-size:12px;">Buka Google Maps</a>
        @endif
    </div>
    @endif
</section>

{{-- Story --}}
@if(($sections['story'] ?? true) && $story)
<section style="text-align:center;padding:64px 24px;background:{{ $primary }}08;max-width:100%;">
    <div style="max-width:560px;margin:0 auto;">
        <span class="section-label">KISAH CINTA KAMI</span>
        <p style="font-size:14px;color:#555;line-height:2;margin-top:16px;">{{ $story }}</p>
    </div>
</section>
@endif

{{-- Gallery --}}
@if(($sections['gallery'] ?? true) && $inv->galleries->isNotEmpty())
<section style="text-align:center;padding:64px 24px;max-width:100%;">
    <div style="max-width:600px;margin:0 auto;">
        <span class="section-label">GALERI FOTO</span>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:6px;margin-top:24px;">
            @foreach($inv->galleries as $gallery)
            <img src="{{ $gallery->getUrl() }}" style="width:100%;aspect-ratio:1;object-fit:cover;border-radius:8px;" loading="lazy">
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Digital Gift --}}
@if(($sections['gift'] ?? true) && $inv->digitalGifts->where('is_visible',true)->isNotEmpty())
<section style="text-align:center;padding:64px 24px;background:{{ $primary }}08;max-width:100%;">
    <div style="max-width:480px;margin:0 auto;">
        <span class="section-label">HADIAH DIGITAL</span>
        <p style="font-size:13px;color:#888;margin:8px 0 24px;">Jika ingin memberikan hadiah, Anda dapat mentransfer ke rekening berikut</p>
        <div style="space-y:12px;">
        @foreach($inv->digitalGifts->where('is_visible',true) as $gift)
        <div style="background:white;border-radius:16px;padding:20px 24px;margin-bottom:12px;display:flex;align-items:center;justify-content:space-between;box-shadow:0 2px 8px rgba(0,0,0,0.06);">
            <div style="text-align:left;">
                <p style="font-size:12px;font-weight:600;color:var(--primary);margin:0 0 4px;">{{ $gift->icon }} {{ $gift->label }} @if($gift->bank_name)({{ $gift->bank_name }})@endif</p>
                <p style="font-size:15px;font-weight:700;font-family:monospace;color:#2d1f0f;margin:0;">{{ $gift->account_number }}</p>
                <p style="font-size:12px;color:#888;margin:2px 0 0;">{{ $gift->account_name }}</p>
            </div>
            <button onclick="navigator.clipboard.writeText('{{ $gift->account_number }}')" style="background:{{ $primary }}11;border:1px solid {{ $primary }}33;color:var(--primary);padding:8px 16px;border-radius:8px;font-size:11px;cursor:pointer;">Salin</button>
        </div>
        @endforeach
        </div>
    </div>
</section>
@endif

{{-- RSVP --}}
@if($sections['rsvp'] ?? true)
<section style="text-align:center;padding:64px 24px;max-width:100%;">
    <div style="max-width:480px;margin:0 auto;">
        <span class="section-label">KONFIRMASI KEHADIRAN</span>
        @if($rsvpSent)
        <div style="background:#f0fdf4;border:1px solid #bbf7d0;border-radius:16px;padding:24px;margin-top:16px;">
            <p style="font-size:32px;margin:0 0 8px;">✅</p>
            <p style="font-size:15px;font-weight:600;color:#166534;margin:0;">Terima kasih!</p>
            <p style="font-size:13px;color:#4ade80;margin:4px 0 0;">RSVP Anda telah kami terima.</p>
        </div>
        @else
        <form wire:submit="submitRsvp" style="text-align:left;margin-top:24px;">
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:12px;font-weight:600;color:#444;margin-bottom:6px;">Nama Lengkap</label>
                <input type="text" wire:model="rsvpName" style="width:100%;border:1px solid #ddd;border-radius:10px;padding:12px 16px;font-size:14px;box-sizing:border-box;outline:none;" placeholder="Nama Anda">
                @error('rsvpName')<span style="color:#ef4444;font-size:11px;">{{ $message }}</span>@enderror
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:12px;font-weight:600;color:#444;margin-bottom:6px;">Konfirmasi Kehadiran</label>
                <select wire:model="rsvpAttendance" style="width:100%;border:1px solid #ddd;border-radius:10px;padding:12px 16px;font-size:14px;box-sizing:border-box;outline:none;">
                    <option value="attending">✅ Hadir</option>
                    <option value="not_attending">❌ Tidak Hadir</option>
                    <option value="maybe">🤔 Mungkin Hadir</option>
                </select>
            </div>
            <div style="margin-bottom:16px;">
                <label style="display:block;font-size:12px;font-weight:600;color:#444;margin-bottom:6px;">Jumlah Tamu</label>
                <input type="number" wire:model="rsvpGuestCount" min="1" max="20" style="width:100%;border:1px solid #ddd;border-radius:10px;padding:12px 16px;font-size:14px;box-sizing:border-box;outline:none;">
            </div>
            <div style="margin-bottom:20px;">
                <label style="display:block;font-size:12px;font-weight:600;color:#444;margin-bottom:6px;">Pesan (opsional)</label>
                <textarea wire:model="rsvpMessage" rows="3" style="width:100%;border:1px solid #ddd;border-radius:10px;padding:12px 16px;font-size:14px;box-sizing:border-box;outline:none;resize:none;" placeholder="Tulis pesan untuk mempelai..."></textarea>
            </div>
            <button type="submit" style="width:100%;background:var(--primary);color:white;border:none;padding:14px;border-radius:12px;font-size:14px;font-family:var(--font-b);cursor:pointer;font-weight:600;">Kirim Konfirmasi</button>
        </form>
        @endif
    </div>
</section>
@endif

{{-- Guestbook --}}
@if($sections['guestbook'] ?? true)
<section style="text-align:center;padding:64px 24px;background:{{ $primary }}08;max-width:100%;">
    <div style="max-width:480px;margin:0 auto;">
        <span class="section-label">BUKU TAMU</span>
        @if(!$guestbookSent)
        <form wire:submit="submitGuestbook" style="text-align:left;margin-top:24px;margin-bottom:32px;">
            <div style="margin-bottom:12px;">
                <input type="text" wire:model="guestbookName" style="width:100%;border:1px solid #ddd;border-radius:10px;padding:12px 16px;font-size:14px;box-sizing:border-box;outline:none;" placeholder="Nama Anda">
                @error('guestbookName')<span style="color:#ef4444;font-size:11px;">{{ $message }}</span>@enderror
            </div>
            <div style="margin-bottom:12px;">
                <textarea wire:model="guestbookMessage" rows="3" style="width:100%;border:1px solid #ddd;border-radius:10px;padding:12px 16px;font-size:14px;box-sizing:border-box;outline:none;resize:none;" placeholder="Tulis ucapan selamat..."></textarea>
                @error('guestbookMessage')<span style="color:#ef4444;font-size:11px;">{{ $message }}</span>@enderror
            </div>
            <button type="submit" style="width:100%;background:var(--primary);color:white;border:none;padding:12px;border-radius:10px;font-size:14px;font-family:var(--font-b);cursor:pointer;font-weight:600;">Kirim Ucapan 💌</button>
        </form>
        @else
        <div style="background:#f0fdf4;border-radius:12px;padding:16px;margin-bottom:24px;">
            <p style="font-size:13px;color:#166534;margin:0;">✅ Ucapan Anda telah terkirim!</p>
        </div>
        @endif
        <div style="space-y:12px;text-align:left;">
            @foreach($inv->guestbookEntries as $entry)
            <div style="background:white;border-radius:12px;padding:16px;margin-bottom:12px;box-shadow:0 1px 4px rgba(0,0,0,0.06);">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:8px;">
                    <div style="width:32px;height:32px;border-radius:50%;background:{{ $primary }}22;display:flex;align-items:center;justify-content:center;font-size:14px;">💌</div>
                    <div>
                        <p style="font-size:13px;font-weight:600;color:#2d1f0f;margin:0;">{{ $entry->name }}</p>
                        <p style="font-size:10px;color:#aaa;margin:0;">{{ $entry->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                <p style="font-size:13px;color:#555;margin:0;line-height:1.6;">{{ $entry->message }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- Footer --}}
<footer style="text-align:center;padding:40px 24px;background:#2d1f0f;color:white;">
    <p style="font-family:var(--font-h);font-size:24px;margin:0;">{{ $groom }} & {{ $bride }}</p>
    @if($eventDate)<p style="font-size:12px;color:#aaa;margin:8px 0 0;">{{ \Carbon\Carbon::parse($eventDate)->translatedFormat('d F Y') }}</p>@endif
    <p style="font-size:11px;color:#666;margin:16px 0 0;">💌 Dibuat dengan UndanganKu</p>
</footer>

@endif
</div>
