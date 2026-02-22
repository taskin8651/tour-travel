<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSection;
use Illuminate\Http\Request;

class HeroSectionController extends Controller
{
    public function index()
    {
        $heroes = HeroSection::latest()->get();
        return view('admin.hero.index', compact('heroes'));
    }

    public function create()
    {
        return view('admin.hero.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'status'      => 'required|boolean',
            'media'       => 'required|file|mimes:jpg,jpeg,png,webp,mp4|max:51200' // 50MB max
        ]);

        // Optional: Only One Active Hero
        if ($request->status == 1) {
            HeroSection::where('status', 1)->update(['status' => 0]);
        }

        $hero = HeroSection::create($request->only([
            'title',
            'subtitle',
            'button_text',
            'button_link',
            'status'
        ]));

        if ($request->hasFile('media')) {
            $hero->addMediaFromRequest('media')
                 ->toMediaCollection('hero_media');
        }

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('success', 'Hero Section Created Successfully');
    }

    public function edit(HeroSection $hero_section)
    {
        return view('admin.hero.edit', compact('hero_section'));
    }

    public function update(Request $request, HeroSection $hero_section)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'subtitle'    => 'nullable|string|max:255',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'status'      => 'required|boolean',
            'media'       => 'nullable|file|mimes:jpg,jpeg,png,webp,mp4|max:51200' // 50MB max
        ]);

        if ($request->status == 1) {
            HeroSection::where('status', 1)
                ->where('id', '!=', $hero_section->id)
                ->update(['status' => 0]);
        }

        $hero_section->update($request->only([
            'title',
            'subtitle',
            'button_text',
            'button_link',
            'status'
        ]));

        if ($request->hasFile('media')) {
            $hero_section->clearMediaCollection('hero_media');
            $hero_section->addMediaFromRequest('media')
                         ->toMediaCollection('hero_media');
        }

        return redirect()
            ->route('admin.hero-sections.index')
            ->with('success', 'Hero Section Updated Successfully');
    }

    public function destroy(HeroSection $hero_section)
    {
        $hero_section->clearMediaCollection('hero_media');
        $hero_section->delete();

        return back()->with('success', 'Hero Section Deleted Successfully');
    }
}