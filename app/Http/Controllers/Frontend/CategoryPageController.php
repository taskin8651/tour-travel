<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Listing;
use Illuminate\Http\Request;

class CategoryPageController extends Controller
{
    public function index(Request $request, $slug)
    {
        // Get Category by slug
        $category = Category::where('slug', $slug)
            ->where('status',1)
            ->firstOrFail();

        // Get Sub Categories
        $subCategories = SubCategory::where('category_id', $category->id)
            ->where('status',1)
            ->get();

        // Base Query
        $query = Listing::where('category_id', $category->id)
            ->where('status',1);

        // Sub category filter
        if ($request->sub_category) {
            $query->where('sub_category_id', $request->sub_category);
        }

        $listings = $query->latest()->paginate(6)->withQueryString();

        return view('custom.category-page', compact(
            'category',
            'subCategories',
            'listings'
        ));
    }

    public function show($id)
{
    $listing = Listing::where('id', $id)
                ->where('status',1)
                ->firstOrFail();

    return view('custom.detail', compact('listing'));
}
}