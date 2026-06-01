<div>
    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Undangan Saya</h1>
            <p class="text-gray-500 text-sm mt-1">Buat dan kelola undangan digital Anda</p>
        </div>
        <button wire:click="$set('showCreateModal', true)" class="bg-amber-600 hover:bg-amber-700 text-white px-5 py-2.5 rounded-xl font-medium transition flex items-center gap-2">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Buat Undangan
        </button>
    </div>

    {{-- Invitation Grid --}}
    @if($invitations->isEmpty())
        <div class="text-center py-20">
            <div class="text-6xl mb-4">💌</div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada undangan</h3>
            <p class="text-gray-500 mb-6">Buat undangan digital pertama Anda sekarang!</p>
            <button wire:click="$set('showCreateModal', true)" class="bg-amber-600 hover:bg-amber-700 text-white px-6 py-3 rounded-xl font-medium transition">
                Buat Undangan Pertama
            </button>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($invitations as $invitation)
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                <div class="h-40 bg-gradient-to-br from-amber-100 to-rose-100 flex items-center justify-center relative">
                    @if($invitation->template)
                        <div class="text-center">
                            <div class="text-4xl mb-1">💍</div>
                            <p class="text-xs text-gray-500">{{ $invitation->template->name }}</p>
                        </div>
                    @endif
                    <div class="absolute top-3 right-3">
                        <span class="px-2 py-1 rounded-full text-xs font-medium
                            {{ $invitation->status === 'published' ? 'bg-green-100 text-green-700' :
                               ($invitation->status === 'archived' ? 'bg-gray-100 text-gray-600' : 'bg-yellow-100 text-yellow-700') }}">
                            {{ ucfirst($invitation->status) }}
                        </span>
                    </div>
                </div>
                <div class="p-4">
                    <h3 class="font-semibold text-gray-900 mb-1">{{ $invitation->title }}</h3>
                    <p class="text-xs text-gray-400 mb-4">{{ $invitation->created_at->format('d M Y') }}</p>
                    <div class="flex items-center gap-2">
                        <a href="{{ route('builder', $invitation->uuid) }}" wire:navigate class="flex-1 text-center bg-amber-600 hover:bg-amber-700 text-white text-sm py-2 rounded-lg transition font-medium">
                            Edit
                        </a>
                        @if($invitation->isPublished())
                        <a href="{{ url('/' . $invitation->slug) }}" target="_blank" class="flex-1 text-center bg-green-600 hover:bg-green-700 text-white text-sm py-2 rounded-lg transition font-medium">
                            Lihat
                        </a>
                        @endif
                        <button wire:click="deleteInvitation({{ $invitation->id }})" wire:confirm="Hapus undangan ini?" class="p-2 text-red-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                        </button>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif

    {{-- Create Modal --}}
    @if($showCreateModal)
    <div class="fixed inset-0 bg-black/50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b flex items-center justify-between">
                <h2 class="text-xl font-bold text-gray-900">Buat Undangan Baru</h2>
                <button wire:click="$set('showCreateModal', false)" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>
            <div class="p-6 space-y-6">
                <form wire:submit="createInvitation" class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mempelai Pria</label>
                            <input type="text" wire:model="groomName" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="Nama pria">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Mempelai Wanita</label>
                            <input type="text" wire:model="brideName" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="Nama wanita">
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Judul Undangan</label>
                        <input type="text" wire:model="invitationTitle" class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="cth: Pernikahan Revaldi & Siti">
                        @error('invitationTitle')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-3">Pilih Template</label>
                        @error('selectedTemplateId')<span class="text-red-500 text-xs block mb-2">{{ $message }}</span>@enderror
                        <div class="grid grid-cols-2 gap-3">
                            @foreach($templates as $template)
                            <label class="relative cursor-pointer">
                                <input type="radio" wire:model="selectedTemplateId" value="{{ $template->id }}" class="sr-only peer">
                                <div class="border-2 rounded-xl p-4 text-center transition peer-checked:border-amber-500 peer-checked:bg-amber-50 hover:border-amber-300">
                                    <div class="text-3xl mb-2">
                                        @switch($template->theme_directory)
                                            @case('elegant-gold') 👑 @break
                                            @case('minimalist') 🤍 @break
                                            @default 💍
                                        @endswitch
                                    </div>
                                    <p class="font-medium text-sm text-gray-800">{{ $template->name }}</p>
                                    @if($template->is_premium)<span class="text-xs text-amber-600">✨ Premium</span>@endif
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>
                    <div class="flex gap-3 pt-2">
                        <button type="button" wire:click="$set('showCreateModal', false)" class="flex-1 border border-gray-300 text-gray-700 py-2.5 rounded-xl font-medium hover:bg-gray-50 transition">
                            Batal
                        </button>
                        <button type="submit" class="flex-1 bg-amber-600 hover:bg-amber-700 text-white py-2.5 rounded-xl font-medium transition" wire:loading.attr="disabled">
                            <span wire:loading.remove>Buat Undangan</span>
                            <span wire:loading>Membuat...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
