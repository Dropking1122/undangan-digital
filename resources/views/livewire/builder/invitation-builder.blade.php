<div class="flex h-full">
    {{-- Sidebar --}}
    <div class="w-80 bg-white border-r border-gray-200 flex flex-col overflow-hidden shadow-sm">
        {{-- Save Status --}}
        @if($saveStatus)
        <div class="bg-green-50 text-green-700 text-xs text-center py-2 border-b border-green-100">
            ✅ {{ $saveStatus }}
        </div>
        @endif

        {{-- Tabs --}}
        <div class="flex overflow-x-auto border-b border-gray-200 bg-gray-50 px-1 pt-1 gap-1 flex-shrink-0">
            @foreach([
                'event'=>'📅', 'couple'=>'💑', 'gallery'=>'🖼️',
                'story'=>'📖', 'theme'=>'🎨', 'music'=>'🎵',
                'rsvp'=>'✉️', 'gift'=>'🎁', 'sections'=>'⚙️'
            ] as $tab => $icon)
            <button wire:click="$set('activeTab', '{{ $tab }}')"
                class="flex-shrink-0 px-3 py-2 text-xs rounded-t-lg transition font-medium
                {{ $activeTab === $tab ? 'bg-white text-amber-700 border border-b-white border-gray-200 -mb-px' : 'text-gray-500 hover:text-gray-700' }}">
                {{ $icon }}
            </button>
            @endforeach
        </div>

        {{-- Tab Content --}}
        <div class="flex-1 overflow-y-auto p-4 space-y-4">

            {{-- EVENT TAB --}}
            @if($activeTab === 'event')
            <h3 class="font-semibold text-gray-800 text-sm">📅 Info Acara</h3>
            <div class="space-y-3">
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Tanggal Akad</label>
                    <input type="date" wire:model.live="akadDate" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400">
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Waktu Akad</label>
                    <input type="time" wire:model.live="akadTime" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400">
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Tanggal Resepsi</label>
                    <input type="date" wire:model.live="eventDate" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400">
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Waktu Resepsi</label>
                    <input type="time" wire:model.live="eventTime" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400">
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Nama Venue</label>
                    <input type="text" wire:model.live="location" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400" placeholder="Nama gedung/tempat">
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Alamat Lengkap</label>
                    <textarea wire:model.live="locationAddress" rows="2" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400" placeholder="Alamat lengkap venue"></textarea>
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Link Google Maps</label>
                    <input type="url" wire:model.live="mapsUrl" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400" placeholder="https://maps.google.com/...">
                </div>
            </div>

            {{-- COUPLE TAB --}}
            @elseif($activeTab === 'couple')
            <h3 class="font-semibold text-gray-800 text-sm">💑 Info Mempelai</h3>
            <div class="space-y-3">
                <p class="text-xs text-amber-600 font-medium">Mempelai Pria</p>
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Nama Lengkap</label>
                    <input type="text" wire:model.live="groomName" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400" placeholder="Nama mempelai pria">
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Nama Ayah</label>
                    <input type="text" wire:model.live="groomFather" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400">
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Nama Ibu</label>
                    <input type="text" wire:model.live="groomMother" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400">
                </div>
                <div class="border-t pt-3">
                    <p class="text-xs text-rose-500 font-medium mb-3">Mempelai Wanita</p>
                    <div class="space-y-3">
                        <div>
                            <label class="text-xs font-medium text-gray-600 block mb-1">Nama Lengkap</label>
                            <input type="text" wire:model.live="brideName" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400" placeholder="Nama mempelai wanita">
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-600 block mb-1">Nama Ayah</label>
                            <input type="text" wire:model.live="brideFather" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400">
                        </div>
                        <div>
                            <label class="text-xs font-medium text-gray-600 block mb-1">Nama Ibu</label>
                            <input type="text" wire:model.live="brideMother" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400">
                        </div>
                    </div>
                </div>
            </div>

            {{-- GALLERY TAB --}}
            @elseif($activeTab === 'gallery')
            <h3 class="font-semibold text-gray-800 text-sm">🖼️ Galeri Foto</h3>
            <div class="space-y-3">
                <form wire:submit="uploadGallery">
                    <label class="block border-2 border-dashed border-amber-300 rounded-xl p-4 text-center cursor-pointer hover:bg-amber-50 transition">
                        <input type="file" wire:model="galleryFiles" multiple accept="image/*" class="hidden">
                        <div class="text-amber-400 text-2xl mb-1">📷</div>
                        <p class="text-xs text-gray-600">Klik untuk upload foto (maks. 10 foto)</p>
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, maks. 5MB/foto</p>
                    </label>
                    <div wire:loading wire:target="galleryFiles" class="text-xs text-gray-400 text-center mt-2">Mengupload...</div>
                    @if($galleryFiles)
                    <button type="submit" class="w-full mt-2 bg-amber-600 text-white text-sm py-2 rounded-lg hover:bg-amber-700 transition">Upload Foto</button>
                    @endif
                </form>
                <div class="grid grid-cols-3 gap-2">
                    @foreach($invitation->galleries as $gallery)
                    <div class="relative group rounded-lg overflow-hidden aspect-square">
                        <img src="{{ $gallery->getUrl() }}" class="w-full h-full object-cover">
                        <button wire:click="deleteGallery({{ $gallery->id }})" wire:confirm="Hapus foto ini?"
                            class="absolute inset-0 bg-black/50 text-white text-xs opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                            🗑️ Hapus
                        </button>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- STORY TAB --}}
            @elseif($activeTab === 'story')
            <h3 class="font-semibold text-gray-800 text-sm">📖 Kisah Cinta</h3>
            <div>
                <label class="text-xs font-medium text-gray-600 block mb-1">Cerita Pertemuan</label>
                <textarea wire:model.live="story" rows="8" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400" placeholder="Ceritakan kisah cinta kalian..."></textarea>
            </div>

            {{-- THEME TAB --}}
            @elseif($activeTab === 'theme')
            <h3 class="font-semibold text-gray-800 text-sm">🎨 Tema & Warna</h3>
            <div class="space-y-3">
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Warna Utama</label>
                    <div class="flex items-center gap-2">
                        <input type="color" wire:model.live="primaryColor" class="w-10 h-10 rounded-lg border cursor-pointer">
                        <input type="text" wire:model.live="primaryColor" class="flex-1 border rounded-lg px-3 py-2 text-sm font-mono focus:outline-none focus:ring-1 focus:ring-amber-400">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Warna Latar</label>
                    <div class="flex items-center gap-2">
                        <input type="color" wire:model.live="backgroundColor" class="w-10 h-10 rounded-lg border cursor-pointer">
                        <input type="text" wire:model.live="backgroundColor" class="flex-1 border rounded-lg px-3 py-2 text-sm font-mono focus:outline-none focus:ring-1 focus:ring-amber-400">
                    </div>
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Font Judul</label>
                    <select wire:model.live="fontHeading" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400">
                        <option value="Playfair Display">Playfair Display</option>
                        <option value="Cormorant Garamond">Cormorant Garamond</option>
                        <option value="Great Vibes">Great Vibes</option>
                        <option value="Poppins">Poppins</option>
                    </select>
                </div>
                <div>
                    <label class="text-xs font-medium text-gray-600 block mb-1">Font Body</label>
                    <select wire:model.live="fontBody" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400">
                        <option value="Poppins">Poppins</option>
                        <option value="Montserrat">Montserrat</option>
                        <option value="Lato">Lato</option>
                    </select>
                </div>
            </div>

            {{-- MUSIC TAB --}}
            @elseif($activeTab === 'music')
            <h3 class="font-semibold text-gray-800 text-sm">🎵 Musik Latar</h3>
            <div class="space-y-3">
                @if($invitation->music && $invitation->music->path)
                <div class="bg-green-50 rounded-xl p-3">
                    <p class="text-xs font-medium text-green-700 mb-2">🎵 {{ $invitation->music->title ?? 'Musik aktif' }}</p>
                    <audio controls class="w-full" style="height:32px">
                        <source src="{{ $invitation->music->getUrl() }}" type="audio/mpeg">
                    </audio>
                    <button wire:click="deleteMusic" class="text-xs text-red-500 hover:text-red-700 mt-2">Hapus musik</button>
                </div>
                @endif
                <form wire:submit="uploadMusic" class="space-y-2">
                    <label class="block border-2 border-dashed border-amber-300 rounded-xl p-4 text-center cursor-pointer hover:bg-amber-50 transition">
                        <input type="file" wire:model="musicFile" accept=".mp3,.ogg,.wav" class="hidden">
                        <div class="text-2xl mb-1">🎵</div>
                        <p class="text-xs text-gray-600">Upload file musik (MP3, OGG, WAV)</p>
                        <p class="text-xs text-gray-400">Maks. 20MB</p>
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" wire:model="autoPlay" class="rounded"> Auto Play
                    </label>
                    <label class="flex items-center gap-2 text-sm text-gray-700">
                        <input type="checkbox" wire:model="loop" class="rounded"> Ulangi (Loop)
                    </label>
                    @if($musicFile)
                    <button type="submit" class="w-full bg-amber-600 text-white text-sm py-2 rounded-lg hover:bg-amber-700 transition">Upload Musik</button>
                    @endif
                </form>
                @error('musicFile')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>

            {{-- RSVP TAB --}}
            @elseif($activeTab === 'rsvp')
            <h3 class="font-semibold text-gray-800 text-sm">✉️ RSVP</h3>
            <div class="space-y-3">
                <div class="bg-amber-50 rounded-xl p-4">
                    <p class="text-xs font-medium text-amber-700 mb-3">Statistik RSVP</p>
                    @php
                        $stats = app(\App\Services\RsvpService::class)->getStats($invitation);
                    @endphp
                    <div class="grid grid-cols-2 gap-2 text-center">
                        <div class="bg-white rounded-lg p-2"><p class="text-lg font-bold text-gray-800">{{ $stats['attending'] }}</p><p class="text-xs text-gray-500">Hadir</p></div>
                        <div class="bg-white rounded-lg p-2"><p class="text-lg font-bold text-gray-800">{{ $stats['not_attending'] }}</p><p class="text-xs text-gray-500">Tidak Hadir</p></div>
                        <div class="bg-white rounded-lg p-2"><p class="text-lg font-bold text-gray-800">{{ $stats['total'] }}</p><p class="text-xs text-gray-500">Total</p></div>
                        <div class="bg-white rounded-lg p-2"><p class="text-lg font-bold text-gray-800">{{ $stats['total_guests'] }}</p><p class="text-xs text-gray-500">Total Tamu</p></div>
                    </div>
                </div>
                <div class="space-y-2 max-h-60 overflow-y-auto">
                    @foreach($invitation->rsvps()->latest()->get() as $rsvp)
                    <div class="border rounded-lg p-2 text-xs">
                        <div class="flex items-center justify-between">
                            <span class="font-medium">{{ $rsvp->name }}</span>
                            <span class="px-1.5 py-0.5 rounded text-xs {{ $rsvp->isAttending() ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-600' }}">
                                {{ $rsvp->attendance === 'attending' ? 'Hadir' : ($rsvp->attendance === 'not_attending' ? 'Tidak' : 'Mungkin') }}
                            </span>
                        </div>
                        @if($rsvp->message)<p class="text-gray-500 mt-1">{{ $rsvp->message }}</p>@endif
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- GIFT TAB --}}
            @elseif($activeTab === 'gift')
            <h3 class="font-semibold text-gray-800 text-sm">🎁 Hadiah Digital</h3>
            <div class="space-y-3">
                <form wire:submit="addGift" class="space-y-2 bg-gray-50 rounded-xl p-3">
                    <p class="text-xs font-medium text-gray-700">Tambah Rekening</p>
                    <select wire:model="giftType" class="w-full border rounded-lg px-3 py-2 text-sm focus:outline-none focus:ring-1 focus:ring-amber-400">
                        <option value="bank">Bank Transfer</option>
                        <option value="dana">DANA</option>
                        <option value="ovo">OVO</option>
                        <option value="gopay">GoPay</option>
                        <option value="shopeepay">ShopeePay</option>
                    </select>
                    @if($giftType === 'bank')
                    <input type="text" wire:model="giftBankName" class="w-full border rounded-lg px-3 py-2 text-sm" placeholder="Nama Bank (BCA, BNI, ...)">
                    @endif
                    <input type="text" wire:model="giftAccountName" class="w-full border rounded-lg px-3 py-2 text-sm" placeholder="Nama Penerima">
                    <input type="text" wire:model="giftAccountNumber" class="w-full border rounded-lg px-3 py-2 text-sm" placeholder="Nomor Rekening">
                    <button type="submit" class="w-full bg-amber-600 text-white text-sm py-2 rounded-lg hover:bg-amber-700 transition">Tambah</button>
                </form>
                <div class="space-y-2">
                    @foreach($invitation->digitalGifts as $gift)
                    <div class="border rounded-xl p-3 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-medium text-gray-800">{{ $gift->label }} {{ $gift->bank_name ? "({$gift->bank_name})" : '' }}</p>
                            <p class="text-xs text-gray-600">{{ $gift->account_name }}</p>
                            <p class="text-xs font-mono text-gray-700">{{ $gift->account_number }}</p>
                        </div>
                        <button wire:click="deleteGift({{ $gift->id }})" class="text-red-400 hover:text-red-600 p-1">🗑️</button>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- SECTIONS TAB --}}
            @elseif($activeTab === 'sections')
            <h3 class="font-semibold text-gray-800 text-sm">⚙️ Kelola Section</h3>
            <div class="space-y-2">
                @foreach([
                    'cover'=>'Cover Undangan', 'couple'=>'Info Mempelai',
                    'countdown'=>'Hitung Mundur', 'gallery'=>'Galeri Foto',
                    'story'=>'Kisah Cinta', 'gift'=>'Hadiah Digital',
                    'rsvp'=>'RSVP', 'guestbook'=>'Buku Tamu', 'video'=>'Video',
                ] as $key => $label)
                <label class="flex items-center justify-between bg-gray-50 rounded-xl px-4 py-3 cursor-pointer hover:bg-gray-100 transition">
                    <span class="text-sm text-gray-700">{{ $label }}</span>
                    <input type="checkbox" wire:model.live="sections.{{ $key }}" class="rounded accent-amber-500 w-4 h-4">
                </label>
                @endforeach
            </div>
            @endif
        </div>

        {{-- Action Buttons --}}
        <div class="border-t p-4 space-y-2 flex-shrink-0">
            <button wire:click="save" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2.5 rounded-xl text-sm transition" wire:loading.attr="disabled">
                <span wire:loading.remove wire:target="save">💾 Simpan</span>
                <span wire:loading wire:target="save">Menyimpan...</span>
            </button>
            @if($invitation->isPublished())
            <div class="flex gap-2">
                <a href="{{ url('/'.$invitation->slug) }}" target="_blank" class="flex-1 text-center bg-green-600 hover:bg-green-700 text-white text-sm py-2 rounded-xl font-medium transition">
                    👁️ Lihat
                </a>
                <button wire:click="unpublish" class="flex-1 bg-gray-200 hover:bg-gray-300 text-gray-700 text-sm py-2 rounded-xl font-medium transition">
                    Unpublish
                </button>
            </div>
            @else
            <button wire:click="publish" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-2.5 rounded-xl text-sm transition">
                🚀 Publish Undangan
            </button>
            @endif
        </div>
    </div>

    {{-- Preview Area --}}
    <div class="flex-1 overflow-hidden bg-gray-200 flex flex-col">
        <div class="bg-gray-100 border-b px-4 py-2 text-xs text-gray-500 flex items-center gap-2">
            <span>👁️ Live Preview</span>
            @if($invitation->isPublished())
            <span class="bg-green-100 text-green-700 px-2 py-0.5 rounded-full">Published</span>
            @else
            <span class="bg-yellow-100 text-yellow-700 px-2 py-0.5 rounded-full">Draft</span>
            @endif
        </div>
        <div class="flex-1 overflow-y-auto">
            <div class="mx-auto" style="max-width: 430px; min-height: 100%;">
                @include('themes.' . $invitation->template->theme_directory . '.preview', [
                    'invitation' => $invitation,
                    'data' => $invitation->getInvitationData(),
                    'theme' => $invitation->getThemeSettings(),
                    'sections' => $invitation->getSections(),
                    'groomName' => $groomName,
                    'brideName' => $brideName,
                    'eventDate' => $eventDate,
                    'eventTime' => $eventTime,
                    'location' => $location,
                    'primaryColor' => $primaryColor,
                    'backgroundColor' => $backgroundColor,
                    'fontHeading' => $fontHeading,
                    'fontBody' => $fontBody,
                ])
            </div>
        </div>
    </div>
</div>
