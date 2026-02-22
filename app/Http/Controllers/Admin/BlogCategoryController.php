<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogCategoryController extends Controller
{
    public function index()
    {
        $categories = BlogCategory::latest()->get();
        return view('admin.blog-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.blog-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255'
        ]);

        BlogCategory::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status ?? 1
        ]);

        return redirect()->route('admin.blog-categories.index')
            ->with('success','Category Created');
    }

    public function edit(BlogCategory $blog_category)
    {
        return view('admin.blog-categories.edit', compact('blog_category'));
    }

    public function update(Request $request, BlogCategory $blog_category)
    {
        $blog_category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status ?? 0
        ]);

        return redirect()->route('admin.blog-categories.index')
            ->with('success','Category Updated');
    }

    public function destroy(BlogCategory $blog_category)
    {
        $blog_category->delete();
        return back()->with('success','Deleted');
    }
}