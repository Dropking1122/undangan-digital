<div>
    <h2 class="text-2xl font-bold text-gray-800 mb-2 text-center">Lupa Password</h2>
    <p class="text-gray-500 text-sm text-center mb-6">Masukkan email untuk menerima link reset password</p>
    @if($sent)
        <div class="bg-green-50 text-green-700 px-4 py-3 rounded-lg text-sm text-center">
            ✅ Link reset telah dikirim ke email Anda.
        </div>
    @else
        <form wire:submit="send" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                <input type="email" wire:model="email" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="email@example.com">
                @error('email')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
            </div>
            <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2.5 rounded-lg transition">Kirim Link Reset</button>
        </form>
    @endif
    <p class="text-center text-sm text-gray-500 mt-6"><a href="{{ route('login') }}" wire:navigate class="text-amber-600 hover:underline">← Kembali ke Login</a></p>
</div>
