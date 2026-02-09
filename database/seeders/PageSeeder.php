<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\PageSection;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Home Page
        $home = Page::firstOrCreate(
            ['slug' => 'home'],
            [
                'title' => 'Home',
                'meta_description' => 'Welcome to C-Nuel Medicine and Store - Your trusted source for quality medicines and healthcare products.',
                'is_active' => true,
            ]
        );

        PageSection::firstOrCreate(
            ['page_id' => $home->id, 'type' => 'hero'],
            [
                'title' => 'Welcome to C-Nuel Medicine and Store',
                'content' => 'Your trusted source for quality medicines and healthcare products. We provide genuine medications at affordable prices.',
                'button_text' => 'Shop Now',
                'button_link' => '/shop',
                'order' => 1,
                'is_active' => true,
            ]
        );

        PageSection::firstOrCreate(
            ['page_id' => $home->id, 'type' => 'featured_products'],
            [
                'title' => 'Featured Products',
                'content' => 'Discover our best-selling medicines and healthcare products.',
                'order' => 2,
                'is_active' => true,
            ]
        );

        PageSection::firstOrCreate(
            ['page_id' => $home->id, 'type' => 'cta'],
            [
                'title' => 'Need Help?',
                'content' => 'Contact us on WhatsApp for personalized assistance with your healthcare needs.',
                'button_text' => 'Contact Us',
                'button_link' => '/contact',
                'order' => 3,
                'is_active' => true,
            ]
        );

        // About Page
        $about = Page::firstOrCreate(
            ['slug' => 'about'],
            [
                'title' => 'About Us',
                'meta_description' => 'Learn about C-Nuel Medicine and Store - Our mission, vision, and commitment to your health.',
                'is_active' => true,
            ]
        );

        PageSection::firstOrCreate(
            ['page_id' => $about->id, 'type' => 'hero'],
            [
                'title' => 'About C-Nuel Medicine and Store',
                'content' => 'We are dedicated to providing quality healthcare products to our community.',
                'order' => 1,
                'is_active' => true,
            ]
        );

        PageSection::firstOrCreate(
            ['page_id' => $about->id, 'type' => 'text'],
            [
                'title' => 'Our Mission',
                'content' => 'At C-Nuel Medicine and Store, our mission is to make quality healthcare accessible to everyone. We believe that everyone deserves access to genuine, affordable medications and healthcare products. Our team of dedicated professionals works tirelessly to ensure that you receive the best products and services.',
                'order' => 2,
                'is_active' => true,
            ]
        );

        PageSection::firstOrCreate(
            ['page_id' => $about->id, 'type' => 'text'],
            [
                'title' => 'Why Choose Us?',
                'content' => 'We offer 100% genuine products from trusted manufacturers, competitive prices, fast delivery, and excellent customer service. Your health and satisfaction are our top priorities.',
                'order' => 3,
                'is_active' => true,
            ]
        );

        // Contact Page
        $contact = Page::firstOrCreate(
            ['slug' => 'contact'],
            [
                'title' => 'Contact Us',
                'meta_description' => 'Get in touch with C-Nuel Medicine and Store. We\'re here to help with all your healthcare needs.',
                'is_active' => true,
            ]
        );

        PageSection::firstOrCreate(
            ['page_id' => $contact->id, 'type' => 'hero'],
            [
                'title' => 'Contact Us',
                'content' => 'We\'re here to help! Reach out to us for any questions or assistance.',
                'order' => 1,
                'is_active' => true,
            ]
        );

        PageSection::firstOrCreate(
            ['page_id' => $contact->id, 'type' => 'contact_info'],
            [
                'title' => 'Get In Touch',
                'content' => json_encode([
                    'whatsapp' => '+2348034966505',
                    'email' => 'admin@cnuelmedicine.com',
                    'address' => 'Nigeria',
                ]),
                'order' => 2,
                'is_active' => true,
            ]
        );
    }
}
