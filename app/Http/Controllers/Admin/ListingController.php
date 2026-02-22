<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::with(['category','subCategory'])->latest()->get();
        return view('admin.listings.index', compact('listings'));
    }

    public function create()
    {
        $categories = Category::where('status',1)->get();
        $subCategories = SubCategory::where('status',1)->get();

        return view('admin.listings.create', compact('categories','subCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'title' => 'required',
            'price' => 'nullable|numeric',
            'rooms' => 'nullable|integer',
            'seats' => 'nullable|integer',
            'days' => 'nullable|integer',
            'image' => 'nullable|image',
            'gallery.*' => 'nullable|image'
        ]);

        $listing = Listing::create($request->all());

        if ($request->hasFile('image')) {
            $listing->addMediaFromRequest('image')->toMediaCollection('main');
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $listing->addMedia($image)->toMediaCollection('gallery');
            }
        }

        return redirect()->route('admin.listings.index')
            ->with('success','Listing Created Successfully');
    }

    public function edit(Listing $listing)
    {
        $categories = Category::where('status',1)->get();
        $subCategories = SubCategory::where('status',1)->get();

        return view('admin.listings.edit', compact('listing','categories','subCategories'));
    }

    public function update(Request $request, Listing $listing)
    {
        $request->validate([
            'category_id' => 'required',
            'sub_category_id' => 'required',
            'title' => 'required',
            'image' => 'nullable|image',
            'gallery.*' => 'nullable|image'
        ]);

        $listing->update($request->all());

        if ($request->hasFile('image')) {
            $listing->clearMediaCollection('main');
            $listing->addMediaFromRequest('image')->toMediaCollection('main');
        }

        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $listing->addMedia($image)->toMediaCollection('gallery');
            }
        }

        return redirect()->route('admin.listings.index')
            ->with('success','Listing Updated Successfully');
    }

    public function destroy(Listing $listing)
    {
        $listing->delete();
        return back()->with('success','Listing Deleted Successfully');
    }
}