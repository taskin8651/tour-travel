<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::latest()->get();
        return view('admin.testimonials.index', compact('testimonials'));
    }

    public function create()
    {
        return view('admin.testimonials.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'review' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'image' => 'nullable|image|max:2048'
        ]);

        $testimonial = Testimonial::create($request->only([
            'name','designation','rating','review','status'
        ]));

        if($request->hasFile('image')){
            $testimonial->addMediaFromRequest('image')
                        ->toMediaCollection('testimonial');
        }

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success','Testimonial Created Successfully');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonials.edit', compact('testimonial'));
    }

    public function update(Request $request, Testimonial $testimonial)
    {
        $testimonial->update($request->only([
            'name','designation','rating','review','status'
        ]));

        if($request->hasFile('image')){
            $testimonial->clearMediaCollection('testimonial');
            $testimonial->addMediaFromRequest('image')
                        ->toMediaCollection('testimonial');
        }

        return redirect()
            ->route('admin.testimonials.index')
            ->with('success','Testimonial Updated');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->clearMediaCollection('testimonial');
        $testimonial->delete();

        return back()->with('success','Deleted Successfully');
    }
}