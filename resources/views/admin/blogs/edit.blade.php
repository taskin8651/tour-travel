@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

<div class="bg-white shadow-xl rounded-2xl p-8">
<h2 class="text-2xl font-bold mb-8">Edit Blog</h2>

<form action="{{ route('admin.blogs.update',$blog->id) }}"
method="POST"
enctype="multipart/form-data"
class="grid grid-cols-12 gap-6">
@csrf
@method('PUT')

<div class="col-span-12 md:col-span-6">
<label>Category</label>
<select name="blog_category_id"
class="w-full border rounded-xl px-4 py-2">
@foreach($categories as $category)
<option value="{{ $category->id }}"
{{ $blog->blog_category_id == $category->id ? 'selected' : '' }}>
{{ $category->name }}
</option>
@endforeach
</select>
</div>

<div class="col-span-12 md:col-span-6">
<label>Title</label>
<input type="text"
name="title"
value="{{ $blog->title }}"
class="w-full border rounded-xl px-4 py-2">
</div>

<div class="col-span-12">
<label>Short Description</label>
<textarea name="short_description"
class="w-full border rounded-xl px-4 py-2">{{ $blog->short_description }}</textarea>
</div>

<div class="col-span-12">
<label>Content</label>
<textarea name="content"
rows="6"
class="w-full border rounded-xl px-4 py-2">{{ $blog->content }}</textarea>
</div>

<div class="col-span-12 md:col-span-6">
<label>Current Image</label>
@if($blog->getFirstMediaUrl('blog'))
<img src="{{ $blog->getFirstMediaUrl('blog') }}"
class="w-32 h-20 object-cover mb-3">
@endif

<input type="file" name="image"
class="w-full border rounded-xl px-4 py-2">
</div>

<div class="col-span-12 md:col-span-6">
<label>Status</label>
<select name="status"
class="w-full border rounded-xl px-4 py-2">
<option value="1" {{ $blog->status ? 'selected' : '' }}>
Published
</option>
<option value="0" {{ !$blog->status ? 'selected' : '' }}>
Draft
</option>
</select>
</div>

<div class="col-span-12 flex justify-end">
<button class="bg-indigo-600 text-white px-6 py-2 rounded-xl">
Update Blog
</button>
</div>

</form>
</div>
</div>
@endsection