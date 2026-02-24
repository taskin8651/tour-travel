<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\Models\Listing;
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    public function create($slug)
{
    $category = \App\Models\Category::where('slug', $slug)
                    ->where('status', 1)
                    ->firstOrFail();

    $listings = \App\Models\Listing::where('category_id', $category->id)
                    ->where('status', 1)
                    ->get();

    return view('custom.enquiry', compact('category', 'listings'));
}

   public function store(Request $request)
{
    $request->validate([
        'category_id' => 'required|exists:categories,id',
        'listing_id'  => 'required|exists:listings,id',
        'name'        => 'required|string|max:255',
        'email'       => 'nullable|email',
        'phone'       => 'required|string|max:20',
    ]);

    $listing = Listing::findOrFail($request->listing_id);

    // Extra safety: ensure listing belongs to selected category
    if ($listing->category_id != $request->category_id) {
        return back()->withErrors('Invalid listing selection.');
    }

    Enquiry::create([
        'category_id'        => $request->category_id,
        'listing_id'         => $request->listing_id,
        'name'               => $request->name,
        'email'              => $request->email,
        'phone'              => $request->phone,

        // Travel
        'travel_date'        => $request->travel_date,
        'persons'            => $request->persons,

        // Room
        'checkin_date'       => $request->checkin_date,
        'checkout_date'      => $request->checkout_date,
        'rooms'              => $request->rooms,

        // Sikkim
        'package_requirements' => $request->package_requirements,

        'message'            => $request->message,
        'status'             => Enquiry::STATUS_PENDING,
    ]);

    return back()->with('success', 'Enquiry Sent Successfully');
}
}