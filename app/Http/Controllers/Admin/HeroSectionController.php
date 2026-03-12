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
            'subtitle'    => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'status'      => 'required|boolean',
            'media'       => 'required|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $hero = HeroSection::create([
            'title'       => $request->title,
            'subtitle'    => $request->subtitle,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'status'      => $request->status,
        ]);

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
            'subtitle'    => 'nullable|string',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'status'      => 'required|boolean',
            'media'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $hero_section->update([
            'title'       => $request->title,
            'subtitle'    => $request->subtitle,
            'button_text' => $request->button_text,
            'button_link' => $request->button_link,
            'status'      => $request->status,
        ]);

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