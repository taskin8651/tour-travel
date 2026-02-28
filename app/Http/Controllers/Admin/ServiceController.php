<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->paginate(10);
        return view('admin.services.index', compact('services'));
    }

    public function create()
    {
        return view('admin.services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Unique Slug Generate
        $slug = Str::slug($request->title);
        $count = Service::where('slug', 'LIKE', "{$slug}%")->count();
        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $service = Service::create([
            'title' => $request->title,
            'slug' => $slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'status' => $request->status ?? 1,
        ]);

        // Featured Image
        if ($request->hasFile('featured_image')) {
            $service->addMediaFromRequest('featured_image')
                    ->toMediaCollection('featured_image');
        }

        // Banner Image
        if ($request->hasFile('banner_image')) {
            $service->addMediaFromRequest('banner_image')
                    ->toMediaCollection('banner_image');
        }

        // Gallery Images (Multiple)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $service->addMedia($image)
                        ->toMediaCollection('gallery');
            }
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service Created Successfully');
    }

    public function edit(Service $service)
    {
        return view('admin.services.create', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'required|string',
            'description' => 'required|string',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'banner_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'gallery.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Unique Slug Update
        $slug = Str::slug($request->title);
        $count = Service::where('slug', 'LIKE', "{$slug}%")
                        ->where('id', '!=', $service->id)
                        ->count();

        if ($count > 0) {
            $slug = $slug . '-' . ($count + 1);
        }

        $service->update([
            'title' => $request->title,
            'slug' => $slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'status' => $request->status ?? 1,
        ]);

        // Replace Featured Image
        if ($request->hasFile('featured_image')) {
            $service->clearMediaCollection('featured_image');
            $service->addMediaFromRequest('featured_image')
                    ->toMediaCollection('featured_image');
        }

        // Replace Banner Image
        if ($request->hasFile('banner_image')) {
            $service->clearMediaCollection('banner_image');
            $service->addMediaFromRequest('banner_image')
                    ->toMediaCollection('banner_image');
        }

        // Add More Gallery Images (Old Gallery Safe)
        if ($request->hasFile('gallery')) {
            foreach ($request->file('gallery') as $image) {
                $service->addMedia($image)
                        ->toMediaCollection('gallery');
            }
        }

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service Updated Successfully');
    }

    public function destroy(Service $service)
    {
        // Automatically deletes related media
        $service->delete();

        return redirect()
            ->route('admin.services.index')
            ->with('success', 'Service Deleted Successfully');
    }

    // Optional Status Toggle
    public function toggleStatus(Service $service)
    {
        $service->update([
            'status' => !$service->status
        ]);

        return back()->with('success', 'Service Status Updated');
    }
}