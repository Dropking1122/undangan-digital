<?php
namespace Database\Seeders;
use App\Models\Category;
use App\Models\Invitation;
use App\Models\Plan;
use App\Models\Subscription;
use App\Models\Template;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(['email' => 'admin@undanganku.id'], [
            'name' => 'Admin UndanganKu',
            'password' => Hash::make('password'),
            'is_admin' => true,
        ]);

        // Demo user
        User::updateOrCreate(['email' => 'demo@undanganku.id'], [
            'name' => 'Demo User',
            'password' => Hash::make('password'),
            'is_admin' => false,
        ]);

        // Hapus paket lama yang sudah tidak dipakai
        Plan::whereIn('slug', ['premium', 'business'])->delete();

        // Plans — hanya 2 paket
        $basic = Plan::updateOrCreate(['slug' => 'basic'], [
            'name'                       => 'Basic',
            'description'                => 'Undangan digital elegan tanpa foto galeri',
            'price'                      => 45000,
            'max_invitations'            => 1,
            'can_use_premium_templates'  => true,
            'can_use_gallery'            => false,
            'can_upload_music'           => true,
            'can_use_custom_domain'      => false,
            'max_gallery_images'         => 0,
            'is_active'                  => true,
            'sort_order'                 => 1,
        ]);
        $pro = Plan::updateOrCreate(['slug' => 'pro'], [
            'name'                       => 'Pro',
            'description'                => 'Semua fitur lengkap termasuk galeri foto',
            'price'                      => 60000,
            'max_invitations'            => 5,
            'can_use_premium_templates'  => true,
            'can_use_gallery'            => true,
            'can_upload_music'           => true,
            'can_use_custom_domain'      => false,
            'max_gallery_images'         => 50,
            'is_active'                  => true,
            'sort_order'                 => 2,
        ]);

        // Categories
        $catWedding = Category::updateOrCreate(['slug' => 'pernikahan'], ['name' => 'Pernikahan', 'is_active' => true, 'sort_order' => 1]);
        $catEngagement = Category::updateOrCreate(['slug' => 'lamaran'], ['name' => 'Lamaran', 'is_active' => true, 'sort_order' => 2]);

        // Templates
        Template::updateOrCreate(['slug' => 'elegant-gold'], [
            'category_id' => $catWedding->id,
            'name' => 'Elegant Gold',
            'theme_directory' => 'elegant-gold',
            'status' => 'active',
            'is_premium' => false,
            'sort_order' => 1,
            'default_theme_settings' => [
                'primary_color' => '#D4AF37',
                'secondary_color' => '#ffffff',
                'font_heading' => 'Playfair Display',
                'font_body' => 'Poppins',
                'background_color' => '#fffdf7',
            ],
            'default_sections' => [
                'cover' => true, 'couple' => true, 'countdown' => true,
                'gallery' => true, 'story' => true, 'gift' => true,
                'rsvp' => true, 'guestbook' => true, 'video' => false,
            ],
        ]);

        Template::updateOrCreate(['slug' => 'minimalist'], [
            'category_id' => $catWedding->id,
            'name' => 'Minimalist',
            'theme_directory' => 'minimalist',
            'status' => 'active',
            'is_premium' => false,
            'sort_order' => 2,
            'default_theme_settings' => [
                'primary_color' => '#1a1a1a',
                'secondary_color' => '#ffffff',
                'font_heading' => 'Playfair Display',
                'font_body' => 'Poppins',
                'background_color' => '#ffffff',
            ],
            'default_sections' => [
                'cover' => true, 'couple' => true, 'countdown' => true,
                'gallery' => true, 'story' => true, 'gift' => false,
                'rsvp' => true, 'guestbook' => true, 'video' => false,
            ],
        ]);

        Template::updateOrCreate(['slug' => 'floral-romantic'], [
            'category_id' => $catWedding->id,
            'name' => 'Floral Romantic',
            'theme_directory' => 'floral-romantic',
            'status' => 'active',
            'is_premium' => false,
            'sort_order' => 3,
            'default_theme_settings' => [
                'primary_color' => '#C8956C',
                'secondary_color' => '#ffffff',
                'font_heading' => 'Cormorant Garamond',
                'font_body' => 'Poppins',
                'background_color' => '#FDF8F2',
            ],
            'default_sections' => [
                'cover' => true, 'couple' => true, 'countdown' => true,
                'gallery' => true, 'story' => true, 'gift' => true,
                'rsvp' => true, 'guestbook' => true, 'video' => false,
            ],
        ]);

        // Demo invitation
        $demoUser = User::where('email', 'demo@undanganku.id')->first();
        $elegantTemplate = Template::where('slug', 'elegant-gold')->first();
        if ($demoUser && $elegantTemplate) {
            Invitation::updateOrCreate(['slug' => 'demo-wedding'], [
                'uuid'        => Str::uuid(),
                'user_id'     => $demoUser->id,
                'template_id' => $elegantTemplate->id,
                'title'       => 'Pernikahan Budi & Sari',
                'status'      => 'published',
                'published_at'=> now(),
                'invitation_data' => [
                    'groom_name'         => 'Budi Santoso',
                    'groom_father'       => 'Bapak Hadi Santoso',
                    'groom_mother'       => 'Ibu Sri Wahyuni',
                    'bride_name'         => 'Sari Dewi',
                    'bride_father'       => 'Bapak Agus Prasetyo',
                    'bride_mother'       => 'Ibu Rina Lestari',
                    'event_date'         => '2026-08-17',
                    'event_time'         => '10:00',
                    'event_end_time'     => '14:00',
                    'venue_name'         => 'Gedung Serbaguna Harmoni',
                    'venue_address'      => 'Jl. Harmoni No. 10, Jakarta Pusat',
                    'venue_maps_url'     => 'https://maps.google.com',
                    'opening_text'       => 'Dengan memohon rahmat dan ridho Allah SWT, kami mengundang Bapak/Ibu/Saudara/i untuk menghadiri pernikahan kami.',
                    'couple_story'       => 'Kami pertama kali bertemu di sebuah acara komunitas pada tahun 2020. Sejak saat itu, perjalanan kami penuh dengan kenangan indah yang akhirnya membawa kami ke hari yang paling istimewa ini.',
                    'bride_photo'        => null,
                    'groom_photo'        => null,
                    'cover_photo'        => null,
                    'rsvp_deadline'      => '2026-08-10',
                ],
                'theme_settings' => [
                    'primary_color'    => '#C9A96E',
                    'secondary_color'  => '#ffffff',
                    'font_heading'     => 'Playfair Display',
                    'font_body'        => 'Poppins',
                    'background_color' => '#fffdf7',
                ],
                'sections' => [
                    'cover'     => true,
                    'couple'    => true,
                    'countdown' => true,
                    'gallery'   => true,
                    'story'     => true,
                    'gift'      => true,
                    'rsvp'      => true,
                    'guestbook' => true,
                    'video'     => false,
                ],
            ]);
        }

        $this->command->info('✅ Database seeded successfully!');
    }
}
