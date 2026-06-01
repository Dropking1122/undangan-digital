# UndanganKu — Digital Wedding Invitation SaaS

Platform undangan digital pernikahan berbasis web. Pengguna bisa membuat undangan elegan, bagikan via WhatsApp, kelola RSVP secara real-time.

---

## Stack Teknologi

| Layer | Teknologi |
|---|---|
| Backend | Laravel 13, PHP 8.4 |
| Frontend | Livewire v4, Tailwind CSS v4, Vite |
| Admin Panel | Filament v5.6 |
| Database | **MySQL 8.0** (via `start.sh`) |
| Storage | Local disk `public` (storage:link) |
| Server | `php artisan serve --host=0.0.0.0 --port=5000` |

---

## Cara Menjalankan

Workflow `Start application` menjalankan `bash start.sh` yang:
1. Init & start MySQL 8.0 (data di `/home/runner/.mysql/data`)
2. Jalankan `php artisan migrate --force`
3. Jalankan `php artisan db:seed --force`
4. Start Laravel di port 5000

**Jangan ubah workflow command** — MySQL harus distart sebelum Laravel.

---

## Kredensial

| Role | Email | Password | Path |
|---|---|---|---|
| Super Admin | `admin@undanganku.id` | `password` | `/admin` |
| Demo User | `demo@undanganku.id` | `password` | `/dashboard` |
| Demo Undangan | — | — | `/demo-wedding` |

### Database MySQL
- Host: `127.0.0.1:3306`
- Database: `undanganku`
- User: `undanganku` / Password: `undanganku123`
- Root: no password (socket auth)

---

## Struktur Direktori Penting

```
app/
├── Filament/Resources/          # Admin panel resources (Filament v5)
│   ├── UserResource.php
│   ├── CategoryResource.php
│   ├── PlanResource.php
│   ├── TemplateResource.php
│   ├── InvitationResource.php
│   └── {Resource}/Pages/       # ListRecords, CreateRecord, EditRecord
├── Livewire/
│   ├── Auth/Login.php           # Login manual (no Breeze)
│   ├── Auth/Register.php
│   ├── Auth/ForgotPassword.php
│   ├── Builder/InvitationBuilder.php   # Builder utama
│   ├── Dashboard/InvitationList.php    # Dashboard user
│   └── Public/PublicInvitation.php     # Halaman publik undangan
├── Models/
│   ├── User.php                 # implements FilamentUser
│   ├── Invitation.php           # model utama
│   ├── InvitationMusic.php      # PENTING: $table = 'invitation_musics'
│   ├── Template.php
│   └── ...
├── Services/
│   ├── InvitationService.php
│   ├── GalleryService.php
│   ├── MusicService.php
│   └── RsvpService.php
└── Providers/Filament/
    └── AdminPanelProvider.php

resources/views/
├── welcome.blade.php            # Landing page utama
├── layouts/
│   ├── app.blade.php            # Layout dashboard
│   ├── guest.blade.php          # Layout auth
│   ├── builder.blade.php        # Layout full-screen builder
│   └── public.blade.php         # Layout halaman undangan publik
├── livewire/
│   ├── auth/                    # Login, Register, ForgotPassword views
│   ├── builder/invitation-builder.blade.php
│   ├── dashboard/invitation-list.blade.php
│   └── public/public-invitation.blade.php
└── themes/
    ├── elegant-gold/preview.blade.php   # Preview di builder
    └── minimalist/preview.blade.php

routes/web.php                   # Semua route (auth, dashboard, builder, public)
start.sh                         # Startup script (MySQL + Laravel)
```

---

## Database Schema (16 Tabel)

```
users               — auth + is_admin flag
plans               — paket subscription (Basic, Premium, Business)
subscriptions       — link user ke plan
categories          — kategori template
templates           — template undangan (theme_directory → views/themes/{dir}/)
invitations         — undangan utama (invitation_data JSON, theme_settings JSON, sections JSON)
invitation_galleries — foto galeri
invitation_musics    — musik latar (table name: invitation_musics bukan invitation_music!)
rsvps               — konfirmasi kehadiran tamu
guestbook_entries   — ucapan dari tamu
digital_gifts       — rekening bank / e-wallet
settings            — pengaturan global
```

---

## Filament v5 — Hal Penting

1. **Method signature `form()`** — gunakan `Schema` bukan `Form`:
   ```php
   use Filament\Schemas\Schema;
   public static function form(Schema $schema): Schema {
       return $schema->components([...]);
   }
   ```

2. **`$navigationIcon`** — PHP 8.4 strict type conflict → gunakan method override:
   ```php
   public static function getNavigationIcon(): string|\BackedEnum|null { return 'heroicon-o-xxx'; }
   ```

3. **Page classes** — `ListRecords` (plural 's'), bukan `ListRecord`

4. **Form components** — masih `Filament\Forms\Components\*`

---

## Route Penting

```
GET  /                          Landing page
GET  /login                     Login (Livewire)
GET  /register                  Register (Livewire)
GET  /dashboard                 Dashboard user (auth)
GET  /builder/{invitation:uuid} Builder undangan (auth)
GET  /{invitation:slug}         Halaman publik undangan
GET  /admin                     Admin panel (Filament)
POST /logout                    Logout
```

---

## Theme System

Template punya `theme_directory` yang menunjuk ke `resources/views/themes/{dir}/`.
- `preview.blade.php` — digunakan di Builder (live preview) dan PublicInvitation
- Data dikirim via `$invitation`, `$data`, `$theme`, `$sections`, dll.
- Sections dikontrol via JSON `sections` di tabel invitations

---

## Model Gotcha

- `InvitationMusic` → harus declare `protected $table = 'invitation_musics';`
  karena Laravel pluralize menjadi `invitation_music` (salah)

---

## Paket Harga (2 Paket)

| Paket | Harga | Galeri Foto | Fitur |
|---|---|---|---|
| **Basic** | Rp 45.000 sekali bayar | ✗ Tidak bisa | RSVP, Buku Tamu, Musik, 1 undangan |
| **Pro** | Rp 60.000 sekali bayar | ✓ Maks. 50 foto | Semua fitur, 5 undangan |

Perbedaan utama: Basic **tidak bisa** upload foto galeri (`can_use_gallery = false`).
Semua setting paket bisa diubah di admin panel `/admin/plans`.

---

## Fitur yang Sudah Selesai

- [x] Auth: Login, Register, ForgotPassword (Livewire, no Breeze)
- [x] Landing page profesional (Cormorant Garamond + Inter)
- [x] Dashboard dengan create invitation modal
- [x] Invitation Builder: event, couple, gallery, story, theme, music, RSVP, gift, sections
- [x] Builder tabs: semua emoji → SVG icons profesional
- [x] Live preview di builder
- [x] Public invitation page (open animation, music player, countdown, gallery, RSVP, guestbook, digital gifts)
- [x] 2 tema: elegant-gold, minimalist
- [x] Guest name personalization (`?to=NamaTamu`)
- [x] Admin panel Filament v5: Users, Categories, Plans, Templates, Invitations
- [x] Admin panel Plans: field `can_use_gallery` (toggle Upload Foto Galeri)
- [x] Database MySQL 8.0
- [x] Auto-start script (start.sh)
- [x] Hamburger menu fixed (vanilla JS, no Alpine conflict)
- [x] Semua emoji → SVG icons (welcome, auth, dashboard, builder)

## Fitur yang Belum / Bisa Dikembangkan

- [ ] RSVP stats dashboard di builder
- [ ] Upload template thumbnail
- [ ] Payment/subscription flow (Midtrans/Xendit)
- [ ] Custom domain support
- [ ] More themes (Rustic, Modern Navy, dll)
- [ ] Email notifications saat RSVP masuk
- [ ] Countdown timer di public page (JavaScript)
- [ ] WhatsApp broadcast template
- [ ] Multi-language support (ID/EN)

---

## User Preferences

- Bahasa Indonesia untuk UI dan komunikasi
- Design profesional dan elegan (color palette: gold #C9A96E, dark navy #1A1A2E)
- Font: Cormorant Garamond (heading) + Inter (body) untuk landing page
- Font: Playfair Display + Poppins untuk tema undangan
