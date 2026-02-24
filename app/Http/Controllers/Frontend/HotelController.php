<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Listing;
use Illuminate\Http\Request;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        // Get Room Booking Category
        $roomCategory = Category::where('slug', 'room-booking')->firstOrFail();

        // Get Sub Categories of Room Booking
        $subCategories = SubCategory::where('category_id', $roomCategory->id)
            ->where('status',1)
            ->get();

        // Base Query (Only Room Booking Listings)
        $query = Listing::where('category_id', $roomCategory->id)
            ->where('status',1);

        // If Subcategory filter applied
        if ($request->sub_category) {
            $query->where('sub_category_id', $request->sub_category);
        }

        $listings = $query->latest()->paginate(6);

        return view('custom.hotel', compact(
            'listings',
            'subCategories'
        ));
    }
}