<?php

namespace App\Filament\Pages;

use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Forms\Components\ColorPicker;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Pages\Page;

class ManageSettings extends Page implements HasForms
{
    use InteractsWithForms;

    public static function getNavigationLabel(): string
    {
        return 'Pengaturan';
    }

    public static function getNavigationIcon(): string|\BackedEnum|null
    {
        return 'heroicon-o-cog-6-tooth';
    }

    public static function getNavigationGroup(): ?string
    {
        return 'Konfigurasi';
    }

    public static function getNavigationSort(): ?int
    {
        return 99;
    }

    public function getView(): string
    {
        return 'filament.pages.manage-settings';
    }

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill([
            'site_name'             => Setting::get('site_name', 'UndanganKu'),
            'site_tagline'          => Setting::get('site_tagline', 'Undangan Digital Pernikahan yang Memukau'),
            'site_description'      => Setting::get('site_description', 'Buat undangan digital elegan dalam hitungan menit. Bagikan via WhatsApp, kelola RSVP secara real-time.'),
            'contact_email'         => Setting::get('contact_email', ''),
            'contact_whatsapp'      => Setting::get('contact_whatsapp', ''),
            'instagram_url'         => Setting::get('instagram_url', ''),
            'hero_cta_text'         => Setting::get('hero_cta_text', 'Buat Undangan Gratis'),
            'hero_stats_1_value'    => Setting::get('hero_stats_1_value', '10K+'),
            'hero_stats_1_label'    => Setting::get('hero_stats_1_label', 'Pasangan bahagia'),
            'hero_stats_2_value'    => Setting::get('hero_stats_2_value', '50K+'),
            'hero_stats_2_label'    => Setting::get('hero_stats_2_label', 'Undangan terkirim'),
            'hero_stats_3_value'    => Setting::get('hero_stats_3_value', '4.9/5'),
            'hero_stats_3_label'    => Setting::get('hero_stats_3_label', 'Rating pengguna'),
            'primary_color'         => Setting::get('primary_color', '#C9A96E'),
            'dark_color'            => Setting::get('dark_color', '#1A1A2E'),
            'maintenance_mode'      => (bool) Setting::get('maintenance_mode', false),
            'maintenance_message'   => Setting::get('maintenance_message', 'Sedang dalam pemeliharaan. Silakan coba lagi nanti.'),
            'max_invitations_basic' => Setting::get('max_invitations_basic', '1'),
            'max_invitations_pro'   => Setting::get('max_invitations_pro', '5'),
            'footer_text'           => Setting::get('footer_text', '© 2025 UndanganKu. Semua hak dilindungi.'),
            'meta_title'            => Setting::get('meta_title', 'UndanganKu — Undangan Pernikahan Digital'),
            'meta_description'      => Setting::get('meta_description', 'Platform undangan digital pernikahan #1 Indonesia'),
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Identitas Website')
                    ->description('Nama, tagline, dan deskripsi yang tampil di landing page.')
                    ->icon('heroicon-o-globe-alt')
                    ->columns(2)
                    ->schema([
                        TextInput::make('site_name')
                            ->label('Nama Website')
                            ->required()
                            ->maxLength(80),
                        TextInput::make('site_tagline')
                            ->label('Tagline Hero')
                            ->maxLength(120),
                        Textarea::make('site_description')
                            ->label('Deskripsi Hero')
                            ->rows(3)
                            ->maxLength(300)
                            ->columnSpanFull(),
                        TextInput::make('hero_cta_text')
                            ->label('Teks Tombol CTA')
                            ->maxLength(60),
                    ]),

                Section::make('Statistik Hero')
                    ->description('Angka-angka yang tampil di bagian hero landing page.')
                    ->icon('heroicon-o-chart-bar')
                    ->columns(2)
                    ->schema([
                        TextInput::make('hero_stats_1_value')->label('Stat 1 — Nilai')->maxLength(20),
                        TextInput::make('hero_stats_1_label')->label('Stat 1 — Label')->maxLength(40),
                        TextInput::make('hero_stats_2_value')->label('Stat 2 — Nilai')->maxLength(20),
                        TextInput::make('hero_stats_2_label')->label('Stat 2 — Label')->maxLength(40),
                        TextInput::make('hero_stats_3_value')->label('Stat 3 — Nilai')->maxLength(20),
                        TextInput::make('hero_stats_3_label')->label('Stat 3 — Label')->maxLength(40),
                    ]),

                Section::make('Warna Brand')
                    ->description('Warna utama yang digunakan di seluruh platform.')
                    ->icon('heroicon-o-paint-brush')
                    ->columns(2)
                    ->schema([
                        ColorPicker::make('primary_color')->label('Warna Utama (Gold)'),
                        ColorPicker::make('dark_color')->label('Warna Gelap (Navy)'),
                    ]),

                Section::make('Kontak & Sosial Media')
                    ->description('Info kontak yang ditampilkan di website.')
                    ->icon('heroicon-o-phone')
                    ->columns(3)
                    ->schema([
                        TextInput::make('contact_email')
                            ->label('Email Kontak')
                            ->email()
                            ->maxLength(100),
                        TextInput::make('contact_whatsapp')
                            ->label('Nomor WhatsApp')
                            ->placeholder('628123456789')
                            ->maxLength(20),
                        TextInput::make('instagram_url')
                            ->label('URL Instagram')
                            ->url()
                            ->maxLength(200),
                    ]),

                Section::make('SEO')
                    ->description('Judul dan deskripsi untuk mesin pencari (Google, dll).')
                    ->icon('heroicon-o-magnifying-glass')
                    ->schema([
                        TextInput::make('meta_title')
                            ->label('Meta Title')
                            ->maxLength(70),
                        Textarea::make('meta_description')
                            ->label('Meta Description')
                            ->rows(2)
                            ->maxLength(160),
                    ]),

                Section::make('Batas Undangan per Paket')
                    ->description('Jumlah maksimal undangan yang bisa dibuat per paket.')
                    ->icon('heroicon-o-envelope')
                    ->columns(2)
                    ->schema([
                        TextInput::make('max_invitations_basic')
                            ->label('Paket Basic (maks undangan)')
                            ->numeric()
                            ->minValue(1),
                        TextInput::make('max_invitations_pro')
                            ->label('Paket Pro (maks undangan)')
                            ->numeric()
                            ->minValue(1),
                    ]),

                Section::make('Footer')
                    ->icon('heroicon-o-document-text')
                    ->schema([
                        TextInput::make('footer_text')
                            ->label('Teks Footer')
                            ->maxLength(200),
                    ]),

                Section::make('Maintenance Mode')
                    ->description('Aktifkan untuk menampilkan halaman maintenance ke pengunjung biasa.')
                    ->icon('heroicon-o-wrench-screwdriver')
                    ->schema([
                        Toggle::make('maintenance_mode')
                            ->label('Aktifkan Maintenance Mode')
                            ->helperText('Pengunjung biasa akan melihat halaman maintenance. Admin tetap bisa mengakses.'),
                        Textarea::make('maintenance_message')
                            ->label('Pesan Maintenance')
                            ->rows(2)
                            ->maxLength(300),
                    ]),
            ])
            ->statePath('data');
    }

    public function save(): void
    {
        $data = $this->form->getState();

        foreach ($data as $key => $value) {
            $type = 'string';
            if (is_bool($value)) {
                $type = 'boolean';
                $value = $value ? '1' : '0';
            }
            Setting::set($key, (string) $value, $type, $this->getSettingGroup($key));
        }

        Notification::make()
            ->title('Pengaturan berhasil disimpan!')
            ->success()
            ->send();
    }

    private function getSettingGroup(string $key): string
    {
        return match(true) {
            in_array($key, ['site_name','site_tagline','site_description','hero_cta_text','footer_text']) ||
                str_starts_with($key, 'hero_stats_') => 'landing',
            str_starts_with($key, 'meta_') => 'seo',
            str_starts_with($key, 'contact_') || str_ends_with($key, '_url') => 'contact',
            in_array($key, ['primary_color','dark_color']) => 'design',
            str_starts_with($key, 'maintenance_') => 'maintenance',
            str_starts_with($key, 'max_') => 'limits',
            default => 'general',
        };
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('save')
                ->label('Simpan Pengaturan')
                ->icon('heroicon-o-check')
                ->action('save'),
        ];
    }
}
