<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use App\Models\Setting;

class HomeController extends Controller
{
    public function index()
    {
        $page = Page::where('slug', 'home')->with('activeSections')->first();
        $featuredProducts = Product::where('is_active', true)
            ->where('is_featured', true)
            ->take(8)
            ->get();
        $latestProducts = Product::where('is_active', true)
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.home', compact('page', 'featuredProducts', 'latestProducts'));
    }

    public function about()
    {
        $page = Page::where('slug', 'about')->with('activeSections')->first();
        return view('frontend.about', compact('page'));
    }

    public function contact()
    {
        $page = Page::where('slug', 'contact')->with('activeSections')->first();
        $whatsapp = Setting::get('whatsapp_number', '+2348034966505');
        $email = Setting::get('contact_email', 'admin@cnuelmedicine.com');
        $address = Setting::get('contact_address', 'Nigeria');

        return view('frontend.contact', compact('page', 'whatsapp', 'email', 'address'));
    }
}
