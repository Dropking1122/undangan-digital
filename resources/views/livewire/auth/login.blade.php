<div>
    <h2 class="text-2xl font-bold text-center mb-1" style="color:#1A1A2E;font-family:'Cormorant Garamond',serif;">Selamat Datang</h2>
    <p class="text-center text-sm mb-7" style="color:#9B9BAB;">Masuk ke akun UndanganKu Anda</p>

    <form wire:submit="login" class="space-y-4">
        @if($errors->has('email') && !$errors->has('password'))
        <div style="background:#FEF2F2;border:1px solid #FCA5A5;color:#DC2626;font-size:13px;padding:12px 14px;border-radius:12px;display:flex;align-items:center;gap:8px;">
            <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            {{ $errors->first('email') }}
        </div>
        @endif

        <div>
            <label class="block text-sm font-semibold mb-1.5" style="color:#4A4A5A;">Email</label>
            <div style="position:relative;">
                <svg width="16" height="16" fill="none" stroke="#C4BFBA" stroke-width="2" viewBox="0 0 24 24" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);pointer-events:none;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <input type="email" wire:model="email" placeholder="email@example.com" autocomplete="email"
                    style="width:100%;border:1.5px solid #EDE9E3;border-radius:12px;padding:11px 14px 11px 42px;font-size:14px;outline:none;transition:border-color .2s;font-family:'Inter',sans-serif;"
                    onfocus="this.style.borderColor='#C9A96E'" onblur="this.style.borderColor='#EDE9E3'">
            </div>
            @error('email')<span style="color:#EF4444;font-size:11.5px;margin-top:4px;display:block;">{{ $message }}</span>@enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1.5" style="color:#4A4A5A;">Password</label>
            <div style="position:relative;">
                <svg width="16" height="16" fill="none" stroke="#C4BFBA" stroke-width="2" viewBox="0 0 24 24" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);pointer-events:none;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                <input type="password" wire:model="password" placeholder="••••••••" autocomplete="current-password"
                    style="width:100%;border:1.5px solid #EDE9E3;border-radius:12px;padding:11px 14px 11px 42px;font-size:14px;outline:none;transition:border-color .2s;font-family:'Inter',sans-serif;"
                    onfocus="this.style.borderColor='#C9A96E'" onblur="this.style.borderColor='#EDE9E3'">
            </div>
            @error('password')<span style="color:#EF4444;font-size:11.5px;margin-top:4px;display:block;">{{ $message }}</span>@enderror
        </div>

        <div class="flex items-center justify-between">
            <label class="flex items-center gap-2 text-sm cursor-pointer" style="color:#6B6B7B;">
                <input type="checkbox" wire:model="remember" class="rounded" style="accent-color:#C9A96E;">
                Ingat saya
            </label>
            <a href="{{ route('password.request') }}" wire:navigate style="font-size:13px;color:#C9A96E;text-decoration:none;font-weight:500;">Lupa password?</a>
        </div>

        <button type="submit" wire:loading.attr="disabled"
            style="width:100%;background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;font-size:14px;font-weight:700;padding:13px;border-radius:12px;border:none;cursor:pointer;transition:opacity .2s;box-shadow:0 4px 16px rgba(201,169,110,.35);"
            wire:loading.style="opacity:.7">
            <span wire:loading.remove wire:target="login">Masuk</span>
            <span wire:loading wire:target="login">Memproses...</span>
        </button>
    </form>

    <p class="text-center text-sm mt-6" style="color:#9B9BAB;">
        Belum punya akun?
        <a href="{{ route('register') }}" wire:navigate style="color:#C9A96E;font-weight:600;text-decoration:none;">Daftar Gratis</a>
    </p>
</div>
