<?php
namespace Database\Seeders;
use App\Models\Category;
use App\Models\Plan;
use App\Models\Template;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        // Plans
        $basic = Plan::updateOrCreate(['slug' => 'basic'], [
            'name' => 'Basic', 'price' => 0, 'max_invitations' => 1,
            'can_use_premium_templates' => false, 'can_upload_music' => false,
            'max_gallery_images' => 5, 'sort_order' => 1,
        ]);
        $premium = Plan::updateOrCreate(['slug' => 'premium'], [
            'name' => 'Premium', 'price' => 99000, 'max_invitations' => 3,
            'can_use_premium_templates' => true, 'can_upload_music' => true,
            'max_gallery_images' => 50, 'sort_order' => 2,
        ]);
        Plan::updateOrCreate(['slug' => 'business'], [
            'name' => 'Business', 'price' => 249000, 'max_invitations' => 10,
            'can_use_premium_templates' => true, 'can_upload_music' => true,
            'can_use_custom_domain' => true, 'max_gallery_images' => 200, 'sort_order' => 3,
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

        $this->command->info('✅ Database seeded successfully!');
    }
}
