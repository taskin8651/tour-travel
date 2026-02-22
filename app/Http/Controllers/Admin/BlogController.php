<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('category')->latest()->get();

        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::where('status',1)->get();

        return view('admin.blogs.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title'            => 'required|string|max:255',
            'content'          => 'required',
            'image'            => 'nullable|image|max:2048'
        ]);

        // Generate Unique Slug
        $slug = Str::slug($request->title);
        $count = Blog::where('slug','LIKE',"$slug%")->count();
        $slug = $count ? $slug.'-'.$count : $slug;

        $blog = Blog::create([
            'blog_category_id' => $request->blog_category_id,
            'title'            => $request->title,
            'slug'             => $slug,
            'short_description'=> $request->short_description,
            'content'          => $request->content,
            'status'           => $request->status ?? 1,
        ]);

        // Upload Featured Image
        if ($request->hasFile('image')) {
            $blog->addMediaFromRequest('image')
                 ->toMediaCollection('blog');
        }

        return redirect()
            ->route('admin.blogs.index')
            ->with('success','Blog Created Successfully');
    }

    public function edit(Blog $blog)
    {
        $categories = BlogCategory::where('status',1)->get();

        return view('admin.blogs.edit', compact('blog','categories'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'blog_category_id' => 'required|exists:blog_categories,id',
            'title'            => 'required|string|max:255',
            'content'          => 'required',
            'image'            => 'nullable|image|max:2048'
        ]);

        // Slug Update (only if title changed)
        if ($blog->title != $request->title) {
            $slug = Str::slug($request->title);
            $count = Blog::where('slug','LIKE',"$slug%")
                        ->where('id','!=',$blog->id)
                        ->count();
            $slug = $count ? $slug.'-'.$count : $slug;
        } else {
            $slug = $blog->slug;
        }

        $blog->update([
            'blog_category_id' => $request->blog_category_id,
            'title'            => $request->title,
            'slug'             => $slug,
            'short_description'=> $request->short_description,
            'content'          => $request->content,
            'status'           => $request->status ?? 0,
        ]);

        // Replace Image
        if ($request->hasFile('image')) {
            $blog->clearMediaCollection('blog');
            $blog->addMediaFromRequest('image')
                 ->toMediaCollection('blog');
        }

        return redirect()
            ->route('admin.blogs.index')
            ->with('success','Blog Updated Successfully');
    }

    public function destroy(Blog $blog)
    {
        $blog->clearMediaCollection('blog');
        $blog->delete();

        return back()->with('success','Blog Deleted Successfully');
    }
}