<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        return view('admin.gallery.index', compact('galleries'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'  => 'nullable|string|max:255',
            'images' => 'required',
        ]);

        $gallery = Gallery::create([
            'title'  => $request->title,
            'status' => $request->status ?? 1,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $gallery->addMedia($image)
                        ->toMediaCollection('gallery');
            }
        }

        return redirect()
            ->route('admin.galleries.index')
            ->with('success','Gallery Created Successfully');
    }

    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $gallery->update([
            'title'  => $request->title,
            'status' => $request->status ?? 0,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $gallery->addMedia($image)
                        ->toMediaCollection('gallery');
            }
        }

        return redirect()
            ->route('admin.galleries.index')
            ->with('success','Gallery Updated Successfully');
    }

    public function destroy(Gallery $gallery)
    {
        $gallery->clearMediaCollection('gallery');
        $gallery->delete();

        return back()->with('success','Gallery Deleted');
    }
}