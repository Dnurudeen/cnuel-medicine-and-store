<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $settings = [
            ['key' => 'site_name', 'value' => 'C-Nuel Medicine and Store', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_tagline', 'value' => 'Your Trusted Healthcare Partner', 'type' => 'text', 'group' => 'general'],
            ['key' => 'site_logo', 'value' => 'images/logo.png', 'type' => 'image', 'group' => 'general'],
            ['key' => 'whatsapp_number', 'value' => '+2348034966505', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_email', 'value' => 'admin@cnuelmedicine.com', 'type' => 'text', 'group' => 'contact'],
            ['key' => 'contact_address', 'value' => 'Nigeria', 'type' => 'textarea', 'group' => 'contact'],
            ['key' => 'primary_color', 'value' => '#22c55e', 'type' => 'text', 'group' => 'theme'],
            ['key' => 'secondary_color', 'value' => '#84cc16', 'type' => 'text', 'group' => 'theme'],
            ['key' => 'currency', 'value' => '₦', 'type' => 'text', 'group' => 'general'],
            ['key' => 'currency_code', 'value' => 'NGN', 'type' => 'text', 'group' => 'general'],
        ];

        foreach ($settings as $setting) {
            Setting::firstOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}
