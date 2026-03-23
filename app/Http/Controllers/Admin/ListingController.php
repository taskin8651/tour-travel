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
        'title' => 'required',
        'image' => 'nullable|image',
        'gallery.*' => 'nullable|image'
    ]);

    // ✅ Safe update (avoid unwanted fields)
    $listing->update([
        'category_id' => $request->category_id,
        'sub_category_id' => $request->sub_category_id,
        'title' => $request->title,
        'location' => $request->location,
        'price' => $request->price,
        'rooms' => $request->rooms,
        'seats' => $request->seats,
        'days' => $request->days,
        'description' => $request->description,
        'status' => $request->status,
    ]);

    // =========================
    // MAIN IMAGE UPDATE
    // =========================
    if ($request->hasFile('image')) {
        $listing->clearMediaCollection('main');
        $listing->addMediaFromRequest('image')
                ->toMediaCollection('main');
    }

    // =========================
    // DELETE OLD GALLERY IMAGES
    // =========================
    if ($request->delete_images) {
        $ids = explode(',', $request->delete_images);

        foreach ($ids as $id) {
            $media = \Spatie\MediaLibrary\MediaCollections\Models\Media::find($id);
            if ($media && $media->model_id == $listing->id) {
                $media->delete();
            }
        }
    }

    // =========================
    // ADD NEW GALLERY IMAGES
    // =========================
    if ($request->hasFile('gallery')) {
        foreach ($request->file('gallery') as $image) {
            $listing->addMedia($image)
                    ->toMediaCollection('gallery');
        }
    }

    return redirect()->route('admin.listings.index')
        ->with('success', 'Listing Updated Successfully');
}

    public function destroy(Listing $listing)
    {
        $listing->delete();
        return back()->with('success','Listing Deleted Successfully');
    }
}