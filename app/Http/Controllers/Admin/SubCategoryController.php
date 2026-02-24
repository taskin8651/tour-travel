<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::with('category')->latest()->get();
        return view('admin.subcategories.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = Category::where('status',1)->get();
        return view('admin.subcategories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]);

        SubCategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.sub-categories.index')
            ->with('success','Sub Category Created Successfully');
    }

    public function edit(SubCategory $sub_category)
    {
        $categories = Category::where('status',1)->get();
        return view('admin.subcategories.edit', compact('sub_category','categories'));
    }

    public function update(Request $request, SubCategory $sub_category)
    {
        $request->validate([
            'category_id' => 'required',
            'name' => 'required',
        ]);

        $sub_category->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status ?? 1,
        ]);

        return redirect()->route('admin.sub-categories.index')
            ->with('success','Sub Category Updated Successfully');
    }

    public function destroy(SubCategory $sub_category)
    {
        $sub_category->delete();

        return redirect()->route('sub-categories.index')
            ->with('success','Sub Category Deleted Successfully');
    }
}