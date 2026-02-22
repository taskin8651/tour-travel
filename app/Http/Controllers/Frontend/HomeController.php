<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\Listing;
use App\Models\Brand;
use App\Models\Testimonial;
use App\Models\Blog;

class HomeController extends Controller
{
    public function index()
    {
        // Active Hero
        $hero = HeroSection::where('status', 1)->first();

        // Featured Listings (example: latest 6)
        $listings = Listing::where('status',1)
                        ->latest()
                        ->take(6)
                        ->get();

        // Active Brands
        $brands = Brand::where('status',1)
                        ->orderBy('sort_order')
                        ->get();

        // Testimonials
        $testimonials = Testimonial::where('status',1)
                            ->latest()
                            ->take(5)
                            ->get();

        // Latest Blogs
        $blogs = Blog::where('status',1)
                    ->latest()
                    ->take(3)
                    ->get();

        return view('custom.index', compact(
            'hero',
            'listings',
            'brands',
            'testimonials',
            'blogs'
        ));
    }
}