<div>
    <h2 class="text-2xl font-bold text-center mb-1" style="color:#1A1A2E;font-family:'Cormorant Garamond',serif;">Buat Akun Gratis</h2>
    <p class="text-center text-sm mb-7" style="color:#9B9BAB;">Mulai buat undangan digital pernikahan Anda</p>

    <form wire:submit="register" class="space-y-4">
        <div>
            <label class="block text-sm font-semibold mb-1.5" style="color:#4A4A5A;">Nama Lengkap</label>
            <div style="position:relative;">
                <svg width="16" height="16" fill="none" stroke="#C4BFBA" stroke-width="2" viewBox="0 0 24 24" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);pointer-events:none;"><path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                <input type="text" wire:model="name" placeholder="Nama Anda" autocomplete="name"
                    style="width:100%;border:1.5px solid #EDE9E3;border-radius:12px;padding:11px 14px 11px 42px;font-size:14px;outline:none;transition:border-color .2s;font-family:'Inter',sans-serif;"
                    onfocus="this.style.borderColor='#C9A96E'" onblur="this.style.borderColor='#EDE9E3'">
            </div>
            @error('name')<span style="color:#EF4444;font-size:11.5px;margin-top:4px;display:block;">{{ $message }}</span>@enderror
        </div>

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
                <input type="password" wire:model="password" placeholder="Min. 8 karakter" autocomplete="new-password"
                    style="width:100%;border:1.5px solid #EDE9E3;border-radius:12px;padding:11px 14px 11px 42px;font-size:14px;outline:none;transition:border-color .2s;font-family:'Inter',sans-serif;"
                    onfocus="this.style.borderColor='#C9A96E'" onblur="this.style.borderColor='#EDE9E3'">
            </div>
            @error('password')<span style="color:#EF4444;font-size:11.5px;margin-top:4px;display:block;">{{ $message }}</span>@enderror
        </div>

        <div>
            <label class="block text-sm font-semibold mb-1.5" style="color:#4A4A5A;">Konfirmasi Password</label>
            <div style="position:relative;">
                <svg width="16" height="16" fill="none" stroke="#C4BFBA" stroke-width="2" viewBox="0 0 24 24" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);pointer-events:none;"><rect x="3" y="11" width="18" height="11" rx="2" ry="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                <input type="password" wire:model="password_confirmation" placeholder="Ulangi password" autocomplete="new-password"
                    style="width:100%;border:1.5px solid #EDE9E3;border-radius:12px;padding:11px 14px 11px 42px;font-size:14px;outline:none;transition:border-color .2s;font-family:'Inter',sans-serif;"
                    onfocus="this.style.borderColor='#C9A96E'" onblur="this.style.borderColor='#EDE9E3'">
            </div>
        </div>

        <button type="submit" wire:loading.attr="disabled"
            style="width:100%;background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;font-size:14px;font-weight:700;padding:13px;border-radius:12px;border:none;cursor:pointer;transition:opacity .2s;box-shadow:0 4px 16px rgba(201,169,110,.35);margin-top:4px;"
            wire:loading.style="opacity:.7">
            <span wire:loading.remove wire:target="register">Daftar Sekarang</span>
            <span wire:loading wire:target="register">Memproses...</span>
        </button>
    </form>

    <p class="text-center text-sm mt-6" style="color:#9B9BAB;">
        Sudah punya akun?
        <a href="{{ route('login') }}" wire:navigate style="color:#C9A96E;font-weight:600;text-decoration:none;">Masuk</a>
    </p>
</div>
