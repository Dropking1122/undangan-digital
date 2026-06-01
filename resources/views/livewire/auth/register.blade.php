<div>
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Daftar Akun</h2>
    <form wire:submit="register" class="space-y-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
            <input type="text" wire:model="name" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="Nama Anda">
            @error('name')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" wire:model="email" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="email@example.com">
            @error('email')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" wire:model="password" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="Min. 8 karakter">
            @error('password')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password</label>
            <input type="password" wire:model="password_confirmation" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="Ulangi password">
        </div>
        <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2.5 rounded-lg transition" wire:loading.attr="disabled">
            <span wire:loading.remove>Daftar Sekarang</span>
            <span wire:loading>Memproses...</span>
        </button>
    </form>
    <p class="text-center text-sm text-gray-500 mt-6">Sudah punya akun? <a href="{{ route('login') }}" wire:navigate class="text-amber-600 font-medium hover:underline">Masuk</a></p>
</div>
