<div>
    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Masuk</h2>
    <form wire:submit="login" class="space-y-4">
        @if($errors->has('email'))
            <div class="bg-red-50 text-red-600 text-sm px-4 py-3 rounded-lg">{{ $errors->first('email') }}</div>
        @endif
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <input type="email" wire:model="email" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="email@example.com">
            @error('email')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <input type="password" wire:model="password" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 focus:outline-none focus:ring-2 focus:ring-amber-500" placeholder="••••••••">
            @error('password')<span class="text-red-500 text-xs">{{ $message }}</span>@enderror
        </div>
        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm text-gray-600">
                <input type="checkbox" wire:model="remember" class="rounded"> Ingat saya
            </label>
            <a href="{{ route('password.request') }}" wire:navigate class="text-sm text-amber-600 hover:underline">Lupa password?</a>
        </div>
        <button type="submit" class="w-full bg-amber-600 hover:bg-amber-700 text-white font-semibold py-2.5 rounded-lg transition" wire:loading.attr="disabled">
            <span wire:loading.remove>Masuk</span>
            <span wire:loading>Memproses...</span>
        </button>
    </form>
    <p class="text-center text-sm text-gray-500 mt-6">Belum punya akun? <a href="{{ route('register') }}" wire:navigate class="text-amber-600 font-medium hover:underline">Daftar</a></p>
</div>
