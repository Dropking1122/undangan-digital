<div>
    {{-- Page Header --}}
    <div class="flex items-center justify-between mb-8 flex-wrap gap-4">
        <div>
            <h1 class="text-2xl font-bold" style="color:#1A1A2E;">Undangan Saya</h1>
            <p class="text-sm mt-1" style="color:#9B9BAB;">Buat dan kelola undangan digital pernikahan Anda</p>
        </div>
        <button wire:click="$set('showCreateModal', true)"
            style="background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;border:none;padding:11px 22px;border-radius:12px;font-weight:600;font-size:14px;cursor:pointer;display:flex;align-items:center;gap:7px;transition:all .2s;box-shadow:0 4px 16px rgba(201,169,110,.3);"
            onmouseover="this.style.transform='translateY(-1px)'" onmouseout="this.style.transform='translateY(0)'">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4"/></svg>
            Buat Undangan
        </button>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
    <div style="background:#F0FDF4;border:1px solid #BBF7D0;border-radius:12px;padding:12px 16px;margin-bottom:24px;display:flex;align-items:center;gap:10px;color:#166534;font-size:14px;">
        <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
    @endif

    @if($invitations->isEmpty())
    {{-- Empty State --}}
    <div style="text-align:center;padding:80px 24px;background:white;border-radius:24px;border:2px dashed #E8D5B0;">
        <div style="width:88px;height:88px;background:linear-gradient(135deg,#FDF8F0,#FBF1E1);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:40px;margin:0 auto 20px;">💌</div>
        <h3 style="font-size:20px;font-weight:700;color:#1A1A2E;margin-bottom:8px;">Belum ada undangan</h3>
        <p style="color:#9B9BAB;font-size:14px;margin-bottom:28px;max-width:320px;margin-left:auto;margin-right:auto;line-height:1.7;">Buat undangan digital pernikahan pertama Anda. Elegan, mudah dibagikan via WhatsApp.</p>
        <button wire:click="$set('showCreateModal', true)"
            style="background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;border:none;padding:13px 28px;border-radius:50px;font-weight:600;font-size:14px;cursor:pointer;box-shadow:0 4px 18px rgba(201,169,110,.35);">
            Buat Undangan Pertama ✨
        </button>
    </div>

    @else
    {{-- Stats Summary --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(150px,1fr));gap:16px;margin-bottom:28px;">
        @php
            $total     = $invitations->count();
            $published = $invitations->where('status','published')->count();
            $drafts    = $invitations->where('status','draft')->count();
        @endphp
        @foreach([[$total,'Total Undangan','💌','#FDF8F0','#A0824A'],[$published,'Dipublish','🚀','#F0FFF4','#166534'],[$drafts,'Draft','✏️','#FFF8F0','#92400E']] as [$val,$label,$icon,$bg,$color])
        <div style="background:{{ $bg }};border-radius:16px;padding:16px 20px;display:flex;align-items:center;gap:12px;">
            <div style="font-size:24px;">{{ $icon }}</div>
            <div>
                <div style="font-size:24px;font-weight:700;color:{{ $color }};line-height:1;">{{ $val }}</div>
                <div style="font-size:11px;color:#9B9BAB;margin-top:2px;">{{ $label }}</div>
            </div>
        </div>
        @endforeach
    </div>

    {{-- Invitation Grid --}}
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(300px,1fr));gap:20px;">
        @foreach($invitations as $inv)
        <div style="background:white;border-radius:20px;border:1px solid #EDE9E3;overflow:hidden;transition:all .25s;"
             onmouseover="this.style.boxShadow='0 12px 40px rgba(0,0,0,.09)';this.style.transform='translateY(-3px)'"
             onmouseout="this.style.boxShadow='none';this.style.transform='translateY(0)'">
            {{-- Card thumbnail --}}
            <div style="height:148px;background:linear-gradient(135deg,#FDF8F0,#FBF1E1);display:flex;flex-direction:column;align-items:center;justify-content:center;position:relative;padding:16px;text-align:center;">
                <p style="font-size:9px;letter-spacing:3px;color:#C9A96E;text-transform:uppercase;margin-bottom:8px;">THE WEDDING OF</p>
                @php
                    $invData = $inv->getInvitationData();
                    $groom   = $invData['groom_name'] ?? null;
                    $bride   = $invData['bride_name'] ?? null;
                @endphp
                @if($groom && $bride)
                <p style="font-family:'Cormorant Garamond',serif;font-size:20px;color:#2d1f0f;line-height:1.2;">{{ $groom }} & {{ $bride }}</p>
                @else
                <p style="font-family:'Cormorant Garamond',serif;font-size:18px;color:#aaa;">{{ $inv->title }}</p>
                @endif
                @if($invData['event_date'] ?? null)
                <p style="font-size:11px;color:#999;margin-top:6px;">{{ \Carbon\Carbon::parse($invData['event_date'])->translatedFormat('d F Y') }}</p>
                @endif
                {{-- Status badge --}}
                <div style="position:absolute;top:12px;right:12px;">
                    @if($inv->status === 'published')
                    <span style="background:#DCFCE7;color:#15803D;font-size:10px;font-weight:700;padding:3px 10px;border-radius:50px;">● Published</span>
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
                @php $rsvpCount = $inv->rsvps->count(); @endphp
                <div style="display:flex;gap:16px;margin-bottom:14px;padding:10px 12px;background:#F7F5F2;border-radius:10px;">
                    <div style="text-align:center;flex:1;">
                        <div style="font-weight:700;font-size:16px;color:#1A1A2E;">{{ $rsvpCount }}</div>
                        <div style="font-size:9px;color:#9B9BAB;text-transform:uppercase;letter-spacing:1px;">RSVP</div>
                    </div>
                    <div style="width:1px;background:#EDE9E3;"></div>
                    <div style="text-align:center;flex:1;">
                        <div style="font-weight:700;font-size:16px;color:#1A1A2E;">{{ $inv->galleries->count() }}</div>
                        <div style="font-size:9px;color:#9B9BAB;text-transform:uppercase;letter-spacing:1px;">Foto</div>
                    </div>
                </div>

                <div style="display:flex;gap:8px;">
                    <a href="{{ route('builder', $inv->uuid) }}" wire:navigate
                       style="flex:1;text-align:center;background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;text-decoration:none;font-size:13px;font-weight:600;padding:9px 12px;border-radius:10px;transition:opacity .2s;"
                       onmouseover="this.style.opacity='.85'" onmouseout="this.style.opacity='1'">
                        ✏️ Edit
                    </a>
                    @if($inv->isPublished())
                    <a href="{{ url('/'.$inv->slug) }}" target="_blank"
                       style="flex:1;text-align:center;background:#F0FDF4;color:#15803D;text-decoration:none;font-size:13px;font-weight:600;padding:9px 12px;border-radius:10px;border:1px solid #BBF7D0;">
                        👁️ Lihat
                    </a>
                    @endif
                    <button wire:click="deleteInvitation({{ $inv->id }})" wire:confirm="Yakin hapus undangan ini? Semua data tidak bisa dikembalikan."
                        style="background:#FEF2F2;color:#DC2626;border:1px solid #FCA5A5;border-radius:10px;width:38px;height:38px;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;">
                        <svg width="15" height="15" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

    {{-- Create Modal --}}
    @if($showCreateModal)
    <div style="position:fixed;inset:0;background:rgba(0,0,0,.55);z-index:50;display:flex;align-items:center;justify-content:center;padding:16px;" x-data>
        <div style="background:white;border-radius:24px;width:100%;max-width:560px;max-height:90vh;overflow-y:auto;box-shadow:0 32px 80px rgba(0,0,0,.2);">
            {{-- Modal header --}}
            <div style="padding:20px 24px;border-bottom:1px solid #F0EDE8;display:flex;align-items:center;justify-content:space-between;position:sticky;top:0;background:white;z-index:1;border-radius:24px 24px 0 0;">
                <div>
                    <h2 style="font-size:18px;font-weight:700;color:#1A1A2E;">Buat Undangan Baru</h2>
                    <p style="font-size:12px;color:#9B9BAB;margin-top:2px;">Isi detail dasar, selesaikan di builder</p>
                </div>
                <button wire:click="$set('showCreateModal', false)" style="background:none;border:1px solid #EDE9E3;border-radius:10px;width:36px;height:36px;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#9B9BAB;">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                </button>
            </div>

            <div style="padding:24px;">
                <form wire:submit="createInvitation">
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px;">
                        <div>
                            <label style="display:block;font-size:12px;font-weight:600;color:#4A4A5A;margin-bottom:6px;">Nama Mempelai Pria</label>
                            <input type="text" wire:model="groomName" placeholder="Nama pria"
                                style="width:100%;border:1.5px solid #EDE9E3;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;transition:border-color .2s;"
                                onfocus="this.style.borderColor='#C9A96E'" onblur="this.style.borderColor='#EDE9E3'">
                        </div>
                        <div>
                            <label style="display:block;font-size:12px;font-weight:600;color:#4A4A5A;margin-bottom:6px;">Nama Mempelai Wanita</label>
                            <input type="text" wire:model="brideName" placeholder="Nama wanita"
                                style="width:100%;border:1.5px solid #EDE9E3;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;transition:border-color .2s;"
                                onfocus="this.style.borderColor='#C9A96E'" onblur="this.style.borderColor='#EDE9E3'">
                        </div>
                    </div>

                    <div style="margin-bottom:20px;">
                        <label style="display:block;font-size:12px;font-weight:600;color:#4A4A5A;margin-bottom:6px;">Judul Undangan</label>
                        <input type="text" wire:model="invitationTitle" placeholder="cth: Pernikahan Budi & Sari"
                            style="width:100%;border:1.5px solid #EDE9E3;border-radius:10px;padding:10px 14px;font-size:14px;outline:none;transition:border-color .2s;"
                            onfocus="this.style.borderColor='#C9A96E'" onblur="this.style.borderColor='#EDE9E3'">
                        @error('invitationTitle')<span style="color:#EF4444;font-size:11px;margin-top:4px;display:block;">{{ $message }}</span>@enderror
                    </div>

                    <div style="margin-bottom:24px;">
                        <label style="display:block;font-size:12px;font-weight:600;color:#4A4A5A;margin-bottom:10px;">Pilih Template</label>
                        @error('selectedTemplateId')<span style="color:#EF4444;font-size:11px;display:block;margin-bottom:8px;">{{ $message }}</span>@enderror
                        <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(130px,1fr));gap:10px;">
                            @foreach($templates as $template)
                            <label style="cursor:pointer;">
                                <input type="radio" wire:model="selectedTemplateId" value="{{ $template->id }}" class="sr-only" style="display:none;">
                                <div wire:click="$set('selectedTemplateId', {{ $template->id }})"
                                    style="border:2px solid {{ $selectedTemplateId == $template->id ? '#C9A96E' : '#EDE9E3' }};border-radius:14px;padding:16px 12px;text-align:center;transition:all .2s;background:{{ $selectedTemplateId == $template->id ? '#FDF8F0' : 'white' }};">
                                    <div style="font-size:28px;margin-bottom:6px;">
                                        @switch($template->theme_directory)
                                            @case('elegant-gold') 👑 @break
                                            @case('minimalist') 🤍 @break
                                            @default 💍
                                        @endswitch
                                    </div>
                                    <p style="font-size:12px;font-weight:600;color:#1A1A2E;">{{ $template->name }}</p>
                                    @if($template->is_premium)
                                    <span style="font-size:10px;color:#A0824A;display:block;margin-top:2px;">✨ Premium</span>
                                    @else
                                    <span style="font-size:10px;color:#15803D;display:block;margin-top:2px;">Gratis</span>
                                    @endif
                                </div>
                            </label>
                            @endforeach
                        </div>
                    </div>

                    <div style="display:flex;gap:10px;">
                        <button type="button" wire:click="$set('showCreateModal', false)"
                            style="flex:1;border:1.5px solid #EDE9E3;background:white;color:#4A4A5A;padding:11px;border-radius:12px;font-weight:600;font-size:14px;cursor:pointer;">
                            Batal
                        </button>
                        <button type="submit" wire:loading.attr="disabled"
                            style="flex:1;background:linear-gradient(135deg,#C9A96E,#A0824A);color:white;border:none;padding:11px;border-radius:12px;font-weight:600;font-size:14px;cursor:pointer;box-shadow:0 4px 16px rgba(201,169,110,.35);">
                            <span wire:loading.remove wire:target="createInvitation">Buat Undangan ✨</span>
                            <span wire:loading wire:target="createInvitation">Membuat...</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
</div>
