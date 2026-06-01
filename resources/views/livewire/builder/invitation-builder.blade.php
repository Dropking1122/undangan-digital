<div class="flex h-full flex-col md:flex-row" x-data="{ mobileTab: 'editor' }">

    {{-- Mobile top bar --}}
    <div class="md:hidden flex items-center justify-between px-4 py-3 bg-white border-b border-gray-200 flex-shrink-0">
        <a href="{{ route('dashboard') }}" wire:navigate style="display:flex;align-items:center;gap:6px;text-decoration:none;color:#4A4A5A;font-size:13px;font-weight:500;">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
            Dashboard
        </a>
        <div class="flex rounded-xl overflow-hidden border border-gray-200">
            <button @click="mobileTab='editor'" :class="mobileTab==='editor' ? 'bg-amber-600 text-white' : 'bg-white text-gray-600'" class="px-4 py-1.5 text-xs font-semibold transition">Edit</button>
            <button @click="mobileTab='preview'" :class="mobileTab==='preview' ? 'bg-amber-600 text-white' : 'bg-white text-gray-600'" class="px-4 py-1.5 text-xs font-semibold transition">Preview</button>
        </div>
        <div class="text-xs text-gray-400 max-w-[80px] truncate">{{ $saveStatus ?: '–' }}</div>
    </div>

    {{-- Sidebar / Editor --}}
    <div class="w-full md:w-80 bg-white border-r border-gray-200 flex flex-col overflow-hidden shadow-sm flex-shrink-0"
         :class="mobileTab==='editor' ? 'flex' : 'hidden md:flex'">

        {{-- Desktop back + save status --}}
        <div class="hidden md:flex items-center justify-between px-4 py-3 border-b border-gray-100 bg-gray-50 flex-shrink-0">
            <a href="{{ route('dashboard') }}" wire:navigate style="display:flex;align-items:center;gap:5px;text-decoration:none;color:#6B6B7B;font-size:12px;font-weight:500;">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/></svg>
                Dashboard
            </a>
            @if($saveStatus)
            <span class="text-xs text-green-600 font-medium">✅ {{ $saveStatus }}</span>
            @endif
        </div>

        {{-- Tabs --}}
        <div class="flex overflow-x-auto border-b border-gray-200 bg-gray-50 px-1 pt-1 gap-0.5 flex-shrink-0 scrollbar-hide">
            @php
            $tabs = [
                'event'    => ['<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg>','Acara'],
                'couple'   => ['<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg>','Mempelai'],
                'gallery'  => ['<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>','Galeri'],
                'story'    => ['<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg>','Kisah'],
                'theme'    => ['<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 2a10 10 0 000 20c1.1 0 2-.9 2-2v-1a2 2 0 012-2h3a2 2 0 002-2 10 10 0 00-9-10z"/></svg>','Tema'],
                'music'    => ['<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>','Musik'],
                'rsvp'     => ['<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z"/><polyline points="22,6 12,13 2,6"/></svg>','RSVP'],
                'gift'     => ['<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><polyline points="20,12 20,22 4,22 4,12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/><path d="M12 7H7.5a2.5 2.5 0 010-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 000-5C13 2 12 7 12 7z"/></svg>','Hadiah'],
                'sections' => ['<svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/></svg>','Bagian'],
            ];
            @endphp
            @foreach($tabs as $tab => [$icon, $label])
            <button wire:click="$set('activeTab','{{ $tab }}')"
                class="flex-shrink-0 flex flex-col items-center px-2.5 py-2 rounded-t-lg transition text-center min-w-[52px]
                {{ $activeTab === $tab ? 'bg-white text-amber-700 border border-b-white border-gray-200 -mb-px shadow-sm' : 'text-gray-400 hover:text-gray-600' }}">
                {!! $icon !!}
                <span style="font-size:9px;font-weight:600;margin-top:3px;letter-spacing:.3px;">{{ $label }}</span>
            </button>
            @endforeach
        </div>

        {{-- Tab Content --}}
        <div class="flex-1 overflow-y-auto p-4 space-y-4">

            {{-- EVENT TAB --}}
            @if($activeTab === 'event')
            <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2"><svg width="14" height="14" fill="none" stroke="#C9A96E" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="4" width="18" height="18" rx="2"/><path d="M16 2v4M8 2v4M3 10h18"/></svg><span>Info Acara</span></h3>
            <div class="space-y-3">
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="builder-label">Tanggal Akad</label>
                        <input type="date" wire:model.live="akadDate" class="builder-input">
                    </div>
                    <div>
                        <label class="builder-label">Waktu Akad</label>
                        <input type="time" wire:model.live="akadTime" class="builder-input">
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <div>
                        <label class="builder-label">Tanggal Resepsi</label>
                        <input type="date" wire:model.live="eventDate" class="builder-input">
                    </div>
                    <div>
                        <label class="builder-label">Waktu Resepsi</label>
                        <input type="time" wire:model.live="eventTime" class="builder-input">
                    </div>
                </div>
                <div>
                    <label class="builder-label">Nama Venue</label>
                    <input type="text" wire:model.live="location" class="builder-input" placeholder="Nama gedung/tempat">
                </div>
                <div>
                    <label class="builder-label">Alamat Lengkap</label>
                    <textarea wire:model.live="locationAddress" rows="2" class="builder-input resize-none" placeholder="Alamat lengkap venue"></textarea>
                </div>
                <div>
                    <label class="builder-label">Link Google Maps</label>
                    <input type="url" wire:model.live="mapsUrl" class="builder-input" placeholder="https://maps.google.com/...">
                </div>
            </div>

            {{-- COUPLE TAB --}}
            @elseif($activeTab === 'couple')
            <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2"><svg width="14" height="14" fill="none" stroke="#C9A96E" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/></svg><span>Info Mempelai</span></h3>
            <div class="space-y-3">
                <div class="bg-amber-50 rounded-xl p-3">
                    <p class="text-xs font-bold text-amber-700 mb-2.5 uppercase tracking-wider">Mempelai Pria</p>
                    <div class="space-y-2">
                        <div>
                            <label class="builder-label">Nama Lengkap</label>
                            <input type="text" wire:model.live="groomName" class="builder-input" placeholder="Nama mempelai pria">
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="builder-label">Nama Ayah</label>
                                <input type="text" wire:model.live="groomFather" class="builder-input">
                            </div>
                            <div>
                                <label class="builder-label">Nama Ibu</label>
                                <input type="text" wire:model.live="groomMother" class="builder-input">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-rose-50 rounded-xl p-3">
                    <p class="text-xs font-bold text-rose-600 mb-2.5 uppercase tracking-wider">Mempelai Wanita</p>
                    <div class="space-y-2">
                        <div>
                            <label class="builder-label">Nama Lengkap</label>
                            <input type="text" wire:model.live="brideName" class="builder-input" placeholder="Nama mempelai wanita">
                        </div>
                        <div class="grid grid-cols-2 gap-2">
                            <div>
                                <label class="builder-label">Nama Ayah</label>
                                <input type="text" wire:model.live="brideFather" class="builder-input">
                            </div>
                            <div>
                                <label class="builder-label">Nama Ibu</label>
                                <input type="text" wire:model.live="brideMother" class="builder-input">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- GALLERY TAB --}}
            @elseif($activeTab === 'gallery')
            <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2"><svg width="14" height="14" fill="none" stroke="#C9A96E" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg><span>Galeri Foto</span></h3>

            @if(!$canUseGallery)
            {{-- Upgrade banner untuk paket Basic --}}
            <div style="background:linear-gradient(135deg,#FFF7ED,#FEF3C7);border:1.5px solid #F59E0B33;border-radius:16px;padding:20px 16px;text-align:center;">
                <div style="width:48px;height:48px;background:#FEF3C7;border-radius:14px;display:flex;align-items:center;justify-content:center;margin:0 auto 12px;">
                    <svg width="22" height="22" fill="none" stroke="#D97706" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg>
                </div>
                <p style="font-size:13px;font-weight:700;color:#92400E;margin:0 0 6px;">Fitur Galeri Foto</p>
                <p style="font-size:11px;color:#B45309;margin:0 0 16px;line-height:1.6;">Paket <strong>Basic</strong> tidak menyertakan galeri foto.<br>Upgrade ke <strong>Pro</strong> untuk menambahkan foto ke undangan Anda.</p>
                <div style="background:white;border-radius:12px;padding:12px;margin-bottom:16px;border:1px solid #FDE68A;">
                    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:6px;">
                        <span style="font-size:11px;font-weight:700;color:#1A1A2E;">Paket Pro</span>
                        <span style="font-size:13px;font-weight:700;color:#C9A96E;">Rp 60.000</span>
                    </div>
                    <div style="display:flex;flex-direction:column;gap:4px;">
                        <div style="display:flex;align-items:center;gap:6px;font-size:11px;color:#555;">
                            <svg width="11" height="11" fill="none" stroke="#C9A96E" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                            Galeri foto hingga 50 foto
                        </div>
                        <div style="display:flex;align-items:center;gap:6px;font-size:11px;color:#555;">
                            <svg width="11" height="11" fill="none" stroke="#C9A96E" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                            5 undangan aktif
                        </div>
                        <div style="display:flex;align-items:center;gap:6px;font-size:11px;color:#555;">
                            <svg width="11" height="11" fill="none" stroke="#C9A96E" stroke-width="2.5" viewBox="0 0 24 24"><path d="M20 6L9 17l-5-5"/></svg>
                            Semua fitur lainnya tetap ada
                        </div>
                    </div>
                </div>
                <a href="{{ route('register') }}" style="display:block;background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;text-decoration:none;padding:10px 16px;border-radius:10px;font-size:12px;font-weight:700;text-align:center;">
                    Upgrade ke Pro - Rp 60.000
                </a>
            </div>
            @else
            <div class="space-y-3">
                <form wire:submit="uploadGallery">
                    <label class="block border-2 border-dashed border-amber-300 rounded-xl p-4 text-center cursor-pointer hover:bg-amber-50 transition">
                        <input type="file" wire:model="galleryFiles" multiple accept="image/*" class="hidden">
                        <div class="flex justify-center mb-1"><svg width="24" height="24" fill="none" stroke="#C9A96E" stroke-width="1.5" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><path d="M21 15l-5-5L5 21"/></svg></div>
                        <p class="text-xs text-gray-600 font-medium">Klik untuk upload foto</p>
                        <p class="text-xs text-gray-400 mt-0.5">JPG, PNG · Maks. 5MB/foto · Maks. 10 foto</p>
                    </label>
                    <div wire:loading wire:target="galleryFiles" class="text-xs text-amber-600 text-center mt-2 animate-pulse">Memuat file...</div>
                    @if($galleryFiles)
                    <button type="submit" class="w-full mt-2 bg-amber-600 text-white text-sm py-2 rounded-lg hover:bg-amber-700 transition font-medium" wire:loading.attr="disabled" wire:target="uploadGallery">
                        <span wire:loading.remove wire:target="uploadGallery">Upload Foto</span>
                        <span wire:loading wire:target="uploadGallery">Mengupload...</span>
                    </button>
                    @endif
                </form>
                @if($invitation->galleries->isNotEmpty())
                <p class="text-xs text-gray-500">{{ $invitation->galleries->count() }} foto tersimpan</p>
                <div class="grid grid-cols-3 gap-1.5">
                    @foreach($invitation->galleries as $gallery)
                    <div class="relative group rounded-lg overflow-hidden aspect-square bg-gray-100">
                        <img src="{{ $gallery->getUrl() }}" class="w-full h-full object-cover" loading="lazy">
                        <button wire:click="deleteGallery({{ $gallery->id }})" wire:confirm="Hapus foto ini?"
                            class="absolute inset-0 bg-black/60 text-white text-xs opacity-0 group-hover:opacity-100 transition flex flex-col items-center justify-center gap-1">
                            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                            Hapus
                        </button>
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-xs text-gray-400 text-center py-4">Belum ada foto. Upload foto untuk galeri undangan.</p>
                @endif
            </div>
            @endif

            {{-- STORY TAB --}}
            @elseif($activeTab === 'story')
            <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2"><svg width="14" height="14" fill="none" stroke="#C9A96E" stroke-width="2" viewBox="0 0 24 24"><path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14,2 14,8 20,8"/><line x1="16" y1="13" x2="8" y2="13"/><line x1="16" y1="17" x2="8" y2="17"/></svg><span>Kisah Cinta</span></h3>
            <div>
                <label class="builder-label">Cerita Pertemuan Kalian</label>
                <textarea wire:model.live="story" rows="10" class="builder-input resize-none" placeholder="Ceritakan kisah cinta kalian... Kapan pertama bertemu? Bagaimana kisah cintanya?"></textarea>
                <p class="text-xs text-gray-400 mt-1">{{ strlen($story) }}/2000 karakter</p>
            </div>

            {{-- THEME TAB --}}
            @elseif($activeTab === 'theme')
            <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2"><svg width="14" height="14" fill="none" stroke="#C9A96E" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="M12 2a10 10 0 000 20c1.1 0 2-.9 2-2v-1a2 2 0 012-2h3a2 2 0 002-2 10 10 0 00-9-10z"/></svg><span>Tema & Warna</span></h3>
            <div class="space-y-3">
                <div>
                    <label class="builder-label">Warna Utama</label>
                    <div class="flex items-center gap-2">
                        <input type="color" wire:model.live="primaryColor" class="w-11 h-11 rounded-xl border border-gray-200 cursor-pointer p-0.5">
                        <input type="text" wire:model.live="primaryColor" class="builder-input font-mono uppercase flex-1">
                    </div>
                </div>
                <div>
                    <label class="builder-label">Warna Latar</label>
                    <div class="flex items-center gap-2">
                        <input type="color" wire:model.live="backgroundColor" class="w-11 h-11 rounded-xl border border-gray-200 cursor-pointer p-0.5">
                        <input type="text" wire:model.live="backgroundColor" class="builder-input font-mono uppercase flex-1">
                    </div>
                </div>
                <div>
                    <label class="builder-label">Font Judul</label>
                    <select wire:model.live="fontHeading" class="builder-input">
                        <option value="Playfair Display">Playfair Display - Elegan</option>
                        <option value="Cormorant Garamond">Cormorant Garamond - Klasik</option>
                        <option value="Great Vibes">Great Vibes - Romantis</option>
                        <option value="Poppins">Poppins - Modern</option>
                    </select>
                </div>
                <div>
                    <label class="builder-label">Font Body</label>
                    <select wire:model.live="fontBody" class="builder-input">
                        <option value="Poppins">Poppins</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Lato">Lato</option>
                    </select>
                </div>
                {{-- Live color preview --}}
                <div style="border:1px solid #EDE9E3;border-radius:12px;overflow:hidden;margin-top:4px;">
                    <div style="background:{{ $backgroundColor }};padding:16px;text-align:center;">
                        <p style="font-family:'{{ $fontHeading }}',serif;font-size:22px;color:{{ $primaryColor }};margin:0;">Preview Tema</p>
                        <p style="font-family:'{{ $fontBody }}',sans-serif;font-size:12px;color:#777;margin:4px 0 0;">Teks body dengan font pilihan</p>
                    </div>
                </div>
            </div>

            {{-- MUSIC TAB --}}
            @elseif($activeTab === 'music')
            <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2"><svg width="14" height="14" fill="none" stroke="#C9A96E" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg><span>Musik Latar</span></h3>
            <div class="space-y-3">
                @if($invitation->music && $invitation->music->path)
                <div class="bg-green-50 border border-green-100 rounded-xl p-3">
                    <p class="text-xs font-semibold text-green-700 mb-2 flex items-center gap-1.5"><svg width="12" height="12" fill="none" stroke="#15803D" stroke-width="2" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg>{{ $invitation->music->title ?? 'Musik aktif' }}</p>
                    <audio controls class="w-full" style="height:34px">
                        <source src="{{ $invitation->music->getUrl() }}" type="audio/mpeg">
                    </audio>
                    <button wire:click="deleteMusic" class="text-xs text-red-500 hover:text-red-700 mt-2 block">Hapus musik</button>
                </div>
                @endif
                <form wire:submit="uploadMusic" class="space-y-2">
                    <label class="block border-2 border-dashed border-amber-300 rounded-xl p-4 text-center cursor-pointer hover:bg-amber-50 transition">
                        <input type="file" wire:model="musicFile" accept=".mp3,.ogg,.wav" class="hidden">
                        <div class="flex justify-center mb-1"><svg width="24" height="24" fill="none" stroke="#C9A96E" stroke-width="1.5" viewBox="0 0 24 24"><path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/></svg></div>
                        <p class="text-xs text-gray-600 font-medium">Upload file musik</p>
                        <p class="text-xs text-gray-400">MP3, OGG, WAV · Maks. 20MB</p>
                    </label>
                    @error('musicFile')<span class="text-red-500 text-xs block">{{ $message }}</span>@enderror
                    <div class="flex gap-4">
                        <label class="flex items-center gap-1.5 text-xs text-gray-700 cursor-pointer">
                            <input type="checkbox" wire:model="autoPlay" class="rounded accent-amber-500">
                            <span>Auto Play</span>
                        </label>
                        <label class="flex items-center gap-1.5 text-xs text-gray-700 cursor-pointer">
                            <input type="checkbox" wire:model="loop" class="rounded accent-amber-500">
                            <span>Loop</span>
                        </label>
                    </div>
                    @if($musicFile)
                    <button type="submit" class="w-full bg-amber-600 text-white text-sm py-2 rounded-lg hover:bg-amber-700 transition font-medium" wire:loading.attr="disabled">
                        <span wire:loading.remove wire:target="uploadMusic">Upload Musik</span>
                        <span wire:loading wire:target="uploadMusic">Mengupload...</span>
                    </button>
                    @endif
                </form>
            </div>

            {{-- RSVP TAB --}}
            @elseif($activeTab === 'rsvp')
            <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2"><svg width="14" height="14" fill="none" stroke="#C9A96E" stroke-width="2" viewBox="0 0 24 24"><path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z"/><polyline points="22,6 12,13 2,6"/></svg><span>RSVP</span></h3>
            <div class="space-y-3">
                <div class="bg-amber-50 rounded-xl p-4">
                    <p class="text-xs font-bold text-amber-800 mb-3 uppercase tracking-wider">Statistik RSVP</p>
                    <div class="grid grid-cols-2 gap-2 text-center">
                        @foreach([[$rsvpStats['attending'],'Hadir','#DCFCE7','#15803D'],[$rsvpStats['not_attending'],'Tidak Hadir','#FEE2E2','#DC2626'],[$rsvpStats['total'],'Total RSVP','#FEF3C7','#92400E'],[$rsvpStats['total_guests'],'Total Tamu','#EDE9FE','#6D28D9']] as [$val,$label,$bg,$color])
                        <div style="background:{{ $bg }};border-radius:10px;padding:10px 6px;">
                            <p style="font-size:22px;font-weight:700;color:{{ $color }};line-height:1;">{{ $val }}</p>
                            <p style="font-size:10px;color:#6B6B7B;margin-top:3px;">{{ $label }}</p>
                        </div>
                        @endforeach
                    </div>
                </div>
                @if($invitation->rsvps->isNotEmpty())
                <p class="text-xs font-semibold text-gray-600">Daftar Konfirmasi</p>
                <div class="space-y-1.5 max-h-64 overflow-y-auto pr-1">
                    @foreach($invitation->rsvps->sortByDesc('created_at') as $rsvp)
                    <div class="border border-gray-100 rounded-xl p-2.5 bg-gray-50">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-semibold text-gray-800">{{ $rsvp->name }}</span>
                            <span class="px-2 py-0.5 rounded-full text-xs font-medium {{ $rsvp->attendance==='attending'?'bg-green-100 text-green-700':($rsvp->attendance==='not_attending'?'bg-red-100 text-red-600':'bg-yellow-100 text-yellow-700') }}">
                                {{ $rsvp->attendance==='attending'?'✓ Hadir':($rsvp->attendance==='not_attending'?'✗ Tidak':'? Mungkin') }}
                            </span>
                        </div>
                        @if($rsvp->guest_count > 1)
                        <p class="text-xs text-gray-400 mt-0.5">{{ $rsvp->guest_count }} tamu</p>
                        @endif
                        @if($rsvp->message)<p class="text-xs text-gray-500 mt-1 italic">"{{ Str::limit($rsvp->message, 60) }}"</p>@endif
                    </div>
                    @endforeach
                </div>
                @else
                <p class="text-xs text-gray-400 text-center py-4">Belum ada konfirmasi kehadiran.</p>
                @endif
            </div>

            {{-- GIFT TAB --}}
            @elseif($activeTab === 'gift')
            <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2"><svg width="14" height="14" fill="none" stroke="#C9A96E" stroke-width="2" viewBox="0 0 24 24"><polyline points="20,12 20,22 4,22 4,12"/><rect x="2" y="7" width="20" height="5"/><line x1="12" y1="22" x2="12" y2="7"/><path d="M12 7H7.5a2.5 2.5 0 010-5C11 2 12 7 12 7z"/><path d="M12 7h4.5a2.5 2.5 0 000-5C13 2 12 7 12 7z"/></svg><span>Hadiah Digital</span></h3>
            <div class="space-y-3">
                <form wire:submit="addGift" class="space-y-2 bg-gray-50 rounded-xl p-3 border border-gray-100">
                    <p class="text-xs font-semibold text-gray-700">Tambah Rekening / E-Wallet</p>
                    <select wire:model="giftType" class="builder-input">
                        <option value="bank">🏦 Bank Transfer</option>
                        <option value="dana">💙 DANA</option>
                        <option value="ovo">💜 OVO</option>
                        <option value="gopay">💚 GoPay</option>
                        <option value="shopeepay">🧡 ShopeePay</option>
                        <option value="bsi">🟢 BSI</option>
                    </select>
                    @if($giftType === 'bank')
                    <input type="text" wire:model="giftBankName" class="builder-input" placeholder="Nama Bank (BCA, BNI, BRI, ...)">
                    @endif
                    <input type="text" wire:model="giftAccountName" class="builder-input" placeholder="Nama Penerima">
                    @error('giftAccountName')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    <input type="text" wire:model="giftAccountNumber" class="builder-input" placeholder="Nomor Rekening / No. HP">
                    @error('giftAccountNumber')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    <button type="submit" class="w-full bg-amber-600 text-white text-sm py-2 rounded-lg hover:bg-amber-700 transition font-medium">+ Tambah</button>
                </form>
                @if($invitation->digitalGifts->isNotEmpty())
                <div class="space-y-2">
                    @foreach($invitation->digitalGifts as $gift)
                    <div class="border border-gray-100 rounded-xl p-3 flex items-center justify-between bg-white">
                        <div>
                            <p class="text-xs font-semibold text-gray-800">{{ $gift->label }} {{ $gift->bank_name?"({$gift->bank_name})":'' }}</p>
                            <p class="text-xs text-gray-500">{{ $gift->account_name }}</p>
                            <p class="text-xs font-mono text-gray-700">{{ $gift->account_number }}</p>
                        </div>
                        <button wire:click="deleteGift({{ $gift->id }})" wire:confirm="Hapus rekening ini?"
                            class="text-red-400 hover:text-red-600 p-1.5 rounded-lg hover:bg-red-50 transition">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                    @endforeach
                </div>
                @endif
            </div>

            {{-- SECTIONS TAB --}}
            @elseif($activeTab === 'sections')
            <h3 class="text-sm font-semibold text-gray-700 flex items-center gap-2"><svg width="14" height="14" fill="none" stroke="#C9A96E" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="3"/><path d="M19.07 4.93a10 10 0 010 14.14M4.93 4.93a10 10 0 000 14.14"/></svg><span>Kelola Bagian</span></h3>
            <p class="text-xs text-gray-400">Aktifkan/nonaktifkan bagian yang tampil di undangan.</p>
            <div class="space-y-1.5">
                @foreach([
                    'cover'     => ['Cover Undangan','Tampilan awal saat undangan dibuka'],
                    'couple'    => ['Info Mempelai','Nama dan info keluarga kedua mempelai'],
                    'countdown' => ['Hitung Mundur','Timer menuju hari H'],
                    'gallery'   => ['Galeri Foto','Kumpulan foto pasangan'],
                    'story'     => ['Kisah Cinta','Cerita pertemuan dan perjalanan cinta'],
                    'gift'      => ['Hadiah Digital','Rekening bank & e-wallet'],
                    'rsvp'      => ['Konfirmasi Kehadiran','Form RSVP untuk tamu'],
                    'guestbook' => ['Buku Tamu','Ucapan selamat dari tamu'],
                ] as $key => [$label, $hint])
                <label class="flex items-center justify-between bg-gray-50 hover:bg-gray-100 rounded-xl px-4 py-3 cursor-pointer transition">
                    <div>
                        <p class="text-sm text-gray-700 font-medium">{{ $label }}</p>
                        <p class="text-xs text-gray-400">{{ $hint }}</p>
                    </div>
                    <input type="checkbox" wire:model.live="sections.{{ $key }}" class="w-4 h-4 rounded accent-amber-500">
                </label>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Action Buttons --}}
        <div class="border-t border-gray-100 p-4 space-y-2 flex-shrink-0 bg-white">
            <button wire:click="save" wire:loading.attr="disabled"
                class="w-full font-semibold py-2.5 rounded-xl text-sm transition"
                style="background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;border:none;cursor:pointer;box-shadow:0 3px 12px rgba(201,169,110,.3);">
                <span wire:loading.remove wire:target="save" class="flex items-center justify-center gap-2"><svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17,21 17,13 7,13 7,21"/><polyline points="7,3 7,8 15,8"/></svg>Simpan Perubahan</span>
                <span wire:loading wire:target="save">Menyimpan...</span>
            </button>
            @if($invitation->isPublished())
            <div class="flex gap-2">
                <a href="{{ url('/'.$invitation->slug) }}" target="_blank"
                   class="flex-1 text-center text-sm py-2.5 rounded-xl font-semibold transition flex items-center justify-center gap-1.5"
                   style="background:#DCFCE7;color:#15803D;text-decoration:none;">
                    <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg> Lihat Live
                </a>
                <button wire:click="unpublish"
                    class="flex-1 text-sm py-2.5 rounded-xl font-medium transition"
                    style="background:#F3F4F6;color:#374151;border:none;cursor:pointer;">
                    Unpublish
                </button>
            </div>
            @else
            <button wire:click="publish"
                class="w-full font-semibold py-2.5 rounded-xl text-sm transition flex items-center justify-center gap-2"
                style="background:linear-gradient(135deg,#16A34A,#15803D);color:white;border:none;cursor:pointer;box-shadow:0 3px 12px rgba(22,163,74,.25);">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M22 2L11 13"/><path d="M22 2L15 22l-4-9-9-4 20-7z"/></svg> Publish Undangan
            </button>
            <p class="text-center text-xs text-gray-400">Undangan masih berstatus draft</p>
            @endif
        </div>
    </div>

    {{-- Preview Area --}}
    <div class="flex-1 overflow-hidden bg-gray-100 flex flex-col"
         :class="mobileTab==='preview' ? 'flex' : 'hidden md:flex'">
        <div class="bg-gray-50 border-b border-gray-200 px-4 py-2 flex items-center justify-between flex-shrink-0">
            <div class="flex items-center gap-2 text-xs text-gray-500">
                <svg width="13" height="13" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                <span>Live Preview · 430px</span>
            </div>
            @if($invitation->isPublished())
            <span class="bg-green-100 text-green-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">● Published</span>
            @else
            <span class="bg-yellow-100 text-yellow-700 text-xs font-semibold px-2.5 py-0.5 rounded-full">Draft</span>
            @endif
        </div>
        <div class="flex-1 overflow-y-auto p-4 md:p-6">
            <div class="mx-auto bg-white rounded-2xl overflow-hidden shadow-xl" style="max-width:430px;min-height:600px;">
                @include('themes.' . $invitation->template->theme_directory . '.preview', [
                    'invitation'       => $invitation,
                    'data'             => $invitation->getInvitationData(),
                    'theme'            => $invitation->getThemeSettings(),
                    'sections'         => $invitation->getSections(),
                    'groomName'        => $groomName,
                    'brideName'        => $brideName,
                    'eventDate'        => $eventDate,
                    'eventTime'        => $eventTime,
                    'location'         => $location,
                    'primaryColor'     => $primaryColor,
                    'backgroundColor'  => $backgroundColor,
                    'fontHeading'      => $fontHeading,
                    'fontBody'         => $fontBody,
                ])
            </div>
        </div>
    </div>
</div>

<style>
.builder-label { display:block; font-size:11px; font-weight:600; color:#6B6B7B; margin-bottom:5px; text-transform:uppercase; letter-spacing:.5px; }
.builder-input { width:100%; border:1.5px solid #EDE9E3; border-radius:9px; padding:8px 12px; font-size:13px; outline:none; transition:border-color .2s; background:white; color:#1A1A2E; }
.builder-input:focus { border-color:#C9A96E; }
.scrollbar-hide::-webkit-scrollbar { display:none; }
.scrollbar-hide { -ms-overflow-style:none; scrollbar-width:none; }
</style>
