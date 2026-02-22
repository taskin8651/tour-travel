<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Listing;
use App\Models\PackageItinerary;
use Illuminate\Http\Request;

class PackageItineraryController extends Controller
{
    public function index(Listing $listing)
    {
        $itineraries = $listing->itineraries;
        return view('admin.itineraries.index', compact('listing','itineraries'));
    }

    public function create(Listing $listing)
    {
        return view('admin.itineraries.create', compact('listing'));
    }

    public function store(Request $request, Listing $listing)
    {
        $request->validate([
            'day_number' => 'required|integer',
            'title' => 'required',
            'description' => 'required'
        ]);

        $listing->itineraries()->create($request->all());

        return redirect()
            ->route('admin.listings.itineraries.index',$listing->id)
            ->with('success','Itinerary Added');
    }

    public function edit(Listing $listing, PackageItinerary $itinerary)
    {
        return view('admin.itineraries.edit', compact('listing','itinerary'));
    }

    public function update(Request $request, Listing $listing, PackageItinerary $itinerary)
    {
        $itinerary->update($request->all());

        return back()->with('success','Updated');
    }

    public function destroy(Listing $listing, PackageItinerary $itinerary)
    {
        $itinerary->delete();
        return back()->with('success','Deleted');
    }
}