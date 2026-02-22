<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('sort_order')->get();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brands.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'logo' => 'required|image'
        ]);

        $brand = Brand::create($request->all());

        if ($request->hasFile('logo')) {
            $brand->addMediaFromRequest('logo')
                  ->toMediaCollection('brand_logo');
        }

        return redirect()->route('admin.brands.index')
            ->with('success','Brand Created');
    }

    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $brand->update($request->all());

        if ($request->hasFile('logo')) {
            $brand->clearMediaCollection('brand_logo');
            $brand->addMediaFromRequest('logo')
                  ->toMediaCollection('brand_logo');
        }

        return redirect()->route('admin.brands.index')
            ->with('success','Brand Updated');
    }

    public function destroy(Brand $brand)
    {
        $brand->clearMediaCollection('brand_logo');
        $brand->delete();

        return back()->with('success','Deleted');
    }
}