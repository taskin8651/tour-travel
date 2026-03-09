<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\Category;
use App\Models\Listing;
use App\Models\Brand;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\Gallery;
use App\Models\Service;


class HomeController extends Controller
{
   public function index()
{
    $hero = HeroSection::where('status', 1)->first();
    $categories = Category::where('status',1)->get();

    // Default first category listings
    $defaultCategory = $categories->first();

    $listings = Listing::where('status',1)->get();


                // PACKAGE CATEGORY
    $packageCategory = Category::where('slug', 'tour-package')
        ->with(['subCategories.listings' => function ($q) {
            $q->where('status', 1);
        }])
        ->first();

         // Travel Booking Category
    $travelCategory = Category::where('slug', 'travel-booking')->first();

    $travelListings = Listing::where('status',1)
        ->where('category_id', $travelCategory->id ?? 0)
        ->latest()
        ->take(6) // max 6 show
        ->get();

         // Room Booking Category
    $roomCategory = Category::where('slug', 'room-booking')->first();

    $roomListings = Listing::where('status',1)
        ->where('category_id', $roomCategory->id ?? 0)
        ->latest()
        ->get();

         $brands = Brand::where('status',1)
        ->orderBy('sort_order')
        ->get();

        $setting = Setting::first();

        $testimonials = Testimonial::where('status', 1)->get();

        $galleryImages = Gallery::where('status', 1)->get();

    $services = Service::where('status', 1)
                        ->latest()
                        ->take(6)
                        ->get();

        


    return view('custom.error', compact(
        'hero',
        'categories',
        'listings',
        'packageCategory',
        'travelListings',
        'roomListings',
        'brands',
        'setting',
        'testimonials',
        'galleryImages',
        'services'



    ));
}
}