<div>
    @if($sent)
    <div style="text-align:center;padding:8px 0;">
        <div style="width:64px;height:64px;background:#F0FDF4;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 16px;">
            <svg width="28" height="28" fill="none" stroke="#15803D" stroke-width="2" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="M22 11.08V12a10 10 0 11-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
        </div>
        <h2 style="font-size:20px;font-weight:700;color:#1A1A2E;margin-bottom:8px;font-family:'Cormorant Garamond',serif;">Email Terkirim!</h2>
        <p style="font-size:13.5px;color:#6B6B7B;line-height:1.75;">Link reset password telah dikirim ke email Anda. Periksa kotak masuk atau folder spam.</p>
    </div>
    @else
    <h2 class="text-2xl font-bold text-center mb-1" style="color:#1A1A2E;font-family:'Cormorant Garamond',serif;">Lupa Password?</h2>
    <p class="text-center text-sm mb-7" style="color:#9B9BAB;line-height:1.7;">Masukkan email Anda dan kami akan kirimkan link untuk reset password.</p>

    <form wire:submit="send" class="space-y-4">
        <div>
            <label style="display:block;font-size:12px;font-weight:600;color:#4A4A5A;margin-bottom:6px;">Email</label>
            <div style="position:relative;">
                <svg width="16" height="16" fill="none" stroke="#C4BFBA" stroke-width="2" viewBox="0 0 24 24" style="position:absolute;left:14px;top:50%;transform:translateY(-50%);pointer-events:none;"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <input type="email" wire:model="email" placeholder="email@example.com" autocomplete="email"
                    style="width:100%;border:1.5px solid #EDE9E3;border-radius:12px;padding:11px 14px 11px 42px;font-size:14px;outline:none;transition:border-color .2s;font-family:'Inter',sans-serif;"
                    onfocus="this.style.borderColor='#C9A96E'" onblur="this.style.borderColor='#EDE9E3'">
            </div>
            @error('email')<span style="color:#EF4444;font-size:11.5px;margin-top:4px;display:block;">{{ $message }}</span>@enderror
        </div>
        <button type="submit" wire:loading.attr="disabled"
            style="width:100%;background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;font-size:14px;font-weight:700;padding:13px;border-radius:12px;border:none;cursor:pointer;box-shadow:0 4px 16px rgba(201,169,110,.35);transition:opacity .2s;"
            wire:loading.style="opacity:.7">
            <span wire:loading.remove>Kirim Link Reset</span>
            <span wire:loading>Mengirim...</span>
        </button>
    </form>
    @endif

    <p class="text-center text-sm mt-6" style="color:#9B9BAB;">
        <a href="{{ route('login') }}" wire:navigate style="color:#C9A96E;font-weight:500;text-decoration:none;display:inline-flex;align-items:center;gap:4px;">
            <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M19 12H5M12 5l-7 7 7 7" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Kembali ke Login
        </a>
    </p>
</div>
