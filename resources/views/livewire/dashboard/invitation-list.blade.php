<div>
    {{-- Page Header --}}
    <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:32px;flex-wrap:wrap;gap:16px;">
        <div>
            <h1 style="font-size:22px;font-weight:700;color:#1A1A2E;letter-spacing:-.3px;">Undangan Saya</h1>
            <p style="font-size:13px;color:#9B9BAB;margin-top:3px;">Buat dan kelola undangan digital pernikahan Anda</p>
        </div>
        <button wire:click="$set('showCreateModal', true)"
            style="background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;border:none;padding:11px 20px;border-radius:12px;font-weight:600;font-size:13.5px;cursor:pointer;display:flex;align-items:center;gap:7px;box-shadow:0 4px 16px rgba(201,169,110,.3);transition:all .2s;"
            onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Buat Undangan
        </button>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
    <div style="background:#F0FDF4;border:1px solid #BBF7D0;border-radius:12px;padding:12px 16px;margin-bottom:24px;display:flex;align-items:center;gap:10px;color:#166534;font-size:13.5px;">
        <svg width="17" height="17" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><path d="M22 11.08V12a10 10 0 11-5.93-9.14" stroke-linecap="round" stroke-linejoin="round"/><polyline points="22 4 12 14.01 9 11.01" stroke-linecap="round" stroke-linejoin="round"/></svg>
        {{ session('success') }}
    </div>
    @endif

    @if($invitations->isEmpty())
    {{-- Empty State --}}
    <div style="text-align:center;padding:88px 24px;background:white;border-radius:24px;border:2px dashed #E8D5B0;">
        <div style="width:80px;height:80px;background:linear-gradient(135deg,#FDF8F0,#FBF1E1);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
            <svg width="36" height="36" fill="none" stroke="#C9A96E" stroke-width="1.6" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z"/>
                <polyline points="22,6 12,13 2,6"/>
            </svg>
        </div>
        <h3 style="font-size:20px;font-weight:700;color:#1A1A2E;margin-bottom:8px;">Belum ada undangan</h3>
        <p style="color:#9B9BAB;font-size:14px;margin-bottom:28px;max-width:320px;margin-left:auto;margin-right:auto;line-height:1.75;">Buat undangan digital pernikahan pertama Anda. Elegan, mudah dibagikan via WhatsApp.</p>
        <button wire:click="$set('showCreateModal', true)"
            style="background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;border:none;padding:13px 28px;border-radius:50px;font-weight:600;font-size:14px;cursor:pointer;box-shadow:0 4px 18px rgba(201,169,110,.35);display:inline-flex;align-items:center;gap:7px;">
            <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" stroke-linecap="round"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Buat Undangan Pertama
        </button>
    </div>

    @else

    {{-- Stats Summary --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(160px,1fr));gap:14px;margin-bottom:28px;">
        @php
            $total     = $invitations->count();
            $published = $invitations->where('status','published')->count();
            $drafts    = $invitations->where('status','draft')->count();
        @endphp
        @foreach([
            [$total,     'Total Undangan', '#FDF8F0', '#A0824A', 'M20 4H4a2 2 0 00-2 2v12a2 2 0 002 2h16a2 2 0 002-2V6a2 2 0 00-2-2z M22 6l-10 7L2 6'],
            [$published, 'Dipublish',      '#F0FDF4', '#15803D', 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            [$drafts,    'Draft',          '#FFF8F0', '#B45309', 'M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z'],
        ] as [$val,$label,$bg,$color,$iconPath])
        <div style="background:{{ $bg }};border-radius:16px;padding:18px 20px;display:flex;align-items:center;gap:12px;">
            <div style="width:40px;height:40px;background:white;border-radius:12px;display:flex;align-items:center;justify-content:center;flex-shrink:0;box-shadow:0 2px 8px rgba(0,0,0,.06);">
                <svg width="18" height="18" fill="none" stroke="{{ $color }}" stroke-width="1.8" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round"><path d="{{ $iconPath }}"/></svg>
            </div>
            <div>
                <div style="font-size:22px;font-weight:700;color:{{ $color }};line-height:1;font-family:'Cormorant Garamond',serif;">{{ $val }}</div>
                <div style="font-size:11px;color:#9B9BAB;margin-top:2px;letter-spacing:.3px;">{{ $label }}</div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Invitation Grid --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;">
        @foreach($invitations as $inv)
        <div style="background:white;border-radius:20px;border:1px solid #EDE9E3;overflow:hidden;transition:all .25s;"
             onmouseover="this.style.boxShadow='0 12px 40px rgba(0,0,0,.08)';this.style.transform='translateY(-3px)'"
             onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)'">

            {{-- Card thumbnail --}}
            <div style="height:152px;background:linear-gradient(135deg,#FDF8F0,#FBF1E1);display:flex;flex-direction:column;align-items:center;justify-content:center;position:relative;padding:16px;text-align:center;">
                <p style="font-size:8px;letter-spacing:3.5px;color:#C9A96E;text-transform:uppercase;margin-bottom:8px;">THE WEDDING OF</p>
                @php
                    $invData = $inv->getInvitationData();
                    $groom   = $invData['groom_name'] ?? null;
                    $bride   = $invData['bride_name'] ?? null;
                @endphp
                @if($groom && $bride)
                    <p style="font-family:'Cormorant Garamond',serif;font-size:20px;color:#2d1f0f;line-height:1.25;">{{ $groom }} &amp; {{ $bride }}</p>
                @else
                    <p style="font-family:'Cormorant Garamond',serif;font-size:17px;color:#bbb;">{{ $inv->title }}</p>
                @endif
                @if($invData['event_date'] ?? null)
                <p style="font-size:11px;color:#aaa;margin-top:5px;">{{ \Carbon\Carbon::parse($invData['event_date'])->translatedFormat('d F Y') }}</p>
                @endif

                {{-- Status badge --}}
                <div style="position:absolute;top:12px;right:12px;">
                    @if($inv->status === 'published')
                    <span style="background:#DCFCE7;color:#15803D;font-size:10px;font-weight:700;padding:3px 10px;border-radius:50px;display:flex;align-items:center;gap:4px;">
                        <span style="width:5px;height:5px;background:#15803D;border-radius:50%;"></span> Published
                    </span>
                    @elseif($inv->status === 'archived')
                    <span style="background:#F3F4F6;color:#6B7280;font-size:10px;font-weight:700;padding:3px 10px;border-radius:50px;">Archived</span>
                    @else
                    <span style="background:#FEF9C3;color:#A16207;font-size:10px;font-weight:700;padding:3px 10px;border-radius:50px;">Draft</span>
                    @endif
                </div>

                {{-- Template badge --}}
                @if($inv->template)
                <div style="position:absolute;bottom:10px;left:12px;background:white;border-radius:6px;padding:3px 8px;font-size:10px;color:#9B9BAB;border:1px solid #EDE9E3;">
                    {{ $inv->template->name }}
                </div>
                @endif
            </div>

            {{-- Card body --}}
            <div style="padding:16px;">
                <h3 style="font-weight:700;color:#1A1A2E;font-size:15px;margin-bottom:3px;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;">{{ $inv->title }}</h3>
                <p style="font-size:11px;color:#C4BFBA;margin-bottom:14px;">Dibuat {{ $inv->created_at->diffForHumans() }}</p>

                {{-- Quick stats --}}
                <div style="display:flex;gap:0;margin-bottom:14px;background:#F7F5F2;border-radius:10px;overflow:hidden;">
                    <div style="flex:1;text-align:center;padding:10px 8px;display:flex;flex-direction:column;align-items:center;gap:3px;">
                        <svg width="14" height="14" fill="none" stroke="#9B9BAB" stroke-width="2" viewBox="0 0 24 24"><path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 00-3-3.87"/><path d="M16 3.13a4 4 0 010 7.75"/></svg>
                        <div style="font-weight:700;font-size:15px;color:#1A1A2E;line-height:1;">{{ $inv->rsvps->count() }}</div>
                        <div style="font-size:9px;color:#9B9BAB;text-transform:uppercase;letter-spacing:.8px;">RSVP</div>
                    </div>
                    <div style="width:1px;background:#EDE9E3;"></div>
                    <div style="flex:1;text-align:center;padding:10px 8px;display:flex;flex-direction:column;align-items:center;gap:3px;">
                        <svg width="14" height="14" fill="none" stroke="#9B9BAB" stroke-width="2" viewBox="0 0 24 24"><rect x="3" y="3" width="18" height="18" rx="2" ry="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        <div style="font-weight:700;font-size:15px;color:#1A1A2E;line-height:1;">{{ $inv->galleries->count() }}</div>
                        <div style="font-size:9px;color:#9B9BAB;text-transform:uppercase;letter-spacing:.8px;">Foto</div>
                    </div>
                </div>

                {{-- Actions --}}
                <div style="display:flex;gap:8px;">
                    <a href="{{ route('builder', $inv->uuid) }}" wire:navigate
                       style="flex:1;text-align:center;background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;text-decoration:none;font-size:13px;font-weight:600;padding:9px 10px;border-radius:10px;display:flex;align-items:center;justify-content:center;gap:5px;transition:opacity .2s;"
                       onmouseover="this.style.opacity='.88'" onmouseout="this.style.opacity='1'">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Edit
                    </a>
                    @if($inv->isPublished())
                    <a href="{{ url('/'.$inv->slug) }}" target="_blank"
                       style="flex:1;text-align:center;background:#F0FDF4;color:#15803D;text-decoration:none;font-size:13px;font-weight:600;padding:9px 10px;border-radius:10px;border:1px solid #BBF7D0;display:flex;align-items:center;justify-content:center;gap:5px;">
                        <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Lihat
                    </a>
                    @endif
                    <button wire:click="deleteInvitation({{ $inv->id }})" wire:confirm="Yakin hapus undangan ini? Semua data tidak bisa dikembalikan."
                        style="background:#FEF2F2;color:#DC2626;border:1px solid #FCA5A5;border-radius:10px;width:38px;height:38px;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;transition:all .2s;"
                        onmouseover="this.style.background='#DC2626';this.style.color='white'" onmouseout="this.style.background='#FEF2F2';this.style.color='#DC2626'">
                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6v14a2 2 0 01-2 2H7a2 2 0 01-2-2V6m3 0V4a1 1 0 011-1h4a1 1 0 011 1v2"/></svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Create Modal --}}
    @if($showCreateModal)
    <div style="position:fixed;inset:0;background:rgba(15,15,26,.6);z-index:50;display:flex;align-items:center;justify-content:center;padding:16px;backdrop-filter:blur(4px);">
        <div style="background:white;border-radius:24px;width:100%;max-width:560px;max-height:90vh;overflow-y:auto;box-shadow:0 32px 80px rgba(0,0,0,.18);" wire:click.stop>
            {{-- Modal header --}}
            <div style="padding:22px 24px;border-bottom:1px solid #F0EDE8;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;background:white;z-index:1;border-radius:24px 24px 0 0;">
                <div>
                    <h2 style="font-size:18px;font-weight:700;color:#1A1A2E;">Buat Undangan Baru</h2>
                    <p style="font-size:12px;color:#9B9BAB;margin-top:2px;">Isi detail dasar, selesaikan di builder</p>
                </div>
                <button wire:click="$set('showCreateModal', false)"
                    style="background:none;border:1px solid #EDE9E3;border-radius:10px;width:36px;height:36px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#9B9BAB;transition:all .2s;"
                    onmouseover="this.style.background='#F7F5F2'" onmouseout="this.style.background='none'">
                    <svg width="15" height="15" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>
            </div>

            <div style="padding:24px;">
                <form wire:submit="createInvitation">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px;margin-bottom:14px;">
                        <div>
                            <label style="display:block;font-size:12px;font-weight:600;color:#4A4A5A;margin-bottom:6px;">Nama Mempelai Pria</label>
                            <input type="text" wire:model="groomName" placeholder="Nama pria"
                                style="width:100%;border:1.5px solid #EDE9E3;border-radius:10px;padding:10px 14px;font-size:13.5px;outline:none;transition:border-color .2s;font-family:'Inter',sans-serif;"
                                onfocus="this.style.borderColor='#C9A96E'" onblur="this.style.borderColor='#EDE9E3'">
                        </div>
                        <div>
                            <label style="display:block;font-size:12px;font-weight:600;color:#4A4A5A;margin-bottom:6px;">Nama Mempelai Wanita</label>
                            <input type="text" wire:model="brideName" placeholder="Nama wanita"
                                style="width:100%;border:1.5px solid #EDE9E3;border-radius:10px;padding:10px 14px;font-size:13.5px;outline:none;transition:border-color .2s;font-family:'Inter',sans-serif;"
                                onfocus="this.style.borderColor='#C9A96E'" onblur="this.style.borderColor='#EDE9E3'">
                        </div>
                    </div>

                    <div style="margin-bottom:20px;">
                        <label style="display:block;font-size:12px;font-weight:600;color:#4A4A5A;margin-bottom:6px;">Judul Undangan</label>
                        <input type="text" wire:model="invitationTitle" placeholder="cth: Pernikahan Budi & Sari"
                            style="width:100%;border:1.5px solid #EDE9E3;border-radius:10px;padding:10px 14px;font-size:13.5px;outline:none;transition:border-color .2s;font-family:'Inter',sans-serif;"
                            onfocus="this.style.borderColor='#C9A96E'" onblur="this.style.borderColor='#EDE9E3'">
                        @error('invitationTitle')<span style="color:#EF4444;font-size:11px;margin-top:4px;display:block;">{{ $message }}</span>@enderror
                    </div>

                    <div style="margin-bottom:24px;">
                        <label style="display:block;font-size:12px;font-weight:600;color:#4A4A5A;margin-bottom:10px;">Pilih Template</label>
                        @error('selectedTemplateId')<span style="color:#EF4444;font-size:11px;display:block;margin-bottom:8px;">{{ $message }}</span>@enderror
                        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:10px;">
                            @foreach($templates as $template)
                            <div wire:click="$set('selectedTemplateId', {{ $template->id }})"
                                style="border:2px solid {{ $selectedTemplateId == $template->id ? '#C9A96E' : '#EDE9E3' }};border-radius:14px;padding:18px 12px;text-align:center;transition:all .2s;background:{{ $selectedTemplateId == $template->id ? '#FDF8F0' : 'white' }};cursor:pointer;">
                                <div style="width:36px;height:36px;background:{{ $selectedTemplateId == $template->id ? 'linear-gradient(135deg,#C9A96E,#A0824A)' : '#F7F5F2' }};border-radius:10px;display:flex;align-items:center;justify-content:center;margin:0 auto 8px;">
                                    <svg width="18" height="18" fill="none" stroke="{{ $selectedTemplateId == $template->id ? 'white' : '#9B9BAB' }}" stroke-width="1.8" viewBox="0 0 24 24"><path d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" stroke-linecap="round" stroke-linejoin="round"/></svg>
                                </div>
                                <p style="font-size:12px;font-weight:600;color:{{ $selectedTemplateId == $template->id ? '#A0824A' : '#1A1A2E' }};">{{ $template->name }}</p>
                                @if($template->is_premium)
                                <span style="font-size:10px;color:#A0824A;display:block;margin-top:2px;font-weight:600;">Premium</span>
                                @else
                                <span style="font-size:10px;color:#15803D;display:block;margin-top:2px;font-weight:600;">Gratis</span>
                                @endif
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div style="display:flex;gap:10px;">
                        <button type="button" wire:click="$set('showCreateModal', false)"
                            style="flex:1;border:1.5px solid #EDE9E3;background:white;color:#4A4A5A;padding:11px;border-radius:12px;font-weight:600;font-size:13.5px;cursor:pointer;transition:background .2s;"
                            onmouseover="this.style.background='#F7F5F2'" onmouseout="this.style.background='white'">
                            Batal
                        </button>
                        <button type="submit" wire:loading.attr="disabled"
                            style="flex:1;background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;border:none;padding:11px;border-radius:12px;font-weight:600;font-size:13.5px;cursor:pointer;box-shadow:0 4px 16px rgba(201,169,110,.3);"
                            wire:loading.style="opacity:.7">
                            <span wire:loading.remove wire:target="createInvitation">Buat Undangan</span>
                            <span wire:loading wire:target="createInvitation">Membuat...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
