@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

<div class="bg-white shadow-xl rounded-2xl p-8">

<h2 class="text-2xl font-bold mb-8">Create Blog</h2>

<form action="{{ route('admin.blogs.store') }}"
method="POST"
enctype="multipart/form-data"
class="grid grid-cols-12 gap-6">
@csrf

{{-- Category --}}
<div class="col-span-12 md:col-span-6">
<label>Category</label>
<select name="blog_category_id"
class="w-full border rounded-xl px-4 py-2">
@foreach($categories as $category)
<option value="{{ $category->id }}">
{{ $category->name }}
</option>
@endforeach
</select>
</div>

{{-- Title --}}
<div class="col-span-12 md:col-span-6">
<label>Title</label>
<input type="text" name="title"
class="w-full border rounded-xl px-4 py-2">
</div>

{{-- Short Description --}}
<div class="col-span-12">
<label>Short Description</label>
<textarea name="short_description"
class="w-full border rounded-xl px-4 py-2"></textarea>
</div>

{{-- Content --}}
<div class="col-span-12">
<label>Content</label>
<textarea name="content"
rows="6"
class="w-full border rounded-xl px-4 py-2"></textarea>
</div>

{{-- Featured Image --}}
<div class="col-span-12 md:col-span-6">
<label>Featured Image</label>
<input type="file" name="image"
class="w-full border rounded-xl px-4 py-2">
</div>

{{-- Status --}}
<div class="col-span-12 md:col-span-6">
<label>Status</label>
<select name="status"
class="w-full border rounded-xl px-4 py-2">
<option value="1">Published</option>
<option value="0">Draft</option>
</select>
</div>

<div class="col-span-12 flex justify-end">
<button class="bg-indigo-600 text-white px-6 py-2 rounded-xl">
Save Blog
</button>
</div>

</form>
</div>
</div>
@endsection