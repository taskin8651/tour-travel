<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;

class GalleryController extends Controller
{
    // Gallery Listing Page
    public function index()
    {
        $galleries = Gallery::where('status', 1)
                        ->latest()
                        ->paginate(12);

        return view('custom.gallery', compact('galleries'));
    }

    // Gallery Detail Page
    public function show($id)
    {
        $gallery = Gallery::where('id', $id)
                    ->where('status', 1)
                    ->firstOrFail();

        return view('custom.gallery-detail', compact('gallery'));
    }
}