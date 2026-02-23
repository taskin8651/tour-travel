<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use App\Models\Listing;
use App\Models\Brand;
use App\Models\Testimonial;
use App\Models\Blog;
use App\Models\Category;

class HomeController extends Controller
{
   public function index()
{
    $hero = HeroSection::where('status', 1)->first();
    $categories = Category::where('status',1)->get();

    return view('custom.index', compact(
        'hero',
        'categories'
    ));
}
}