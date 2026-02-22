@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-6xl mx-auto">

<div class="bg-white shadow-xl rounded-2xl p-8">

<h2 class="text-2xl font-bold mb-8">
    Edit Gallery
</h2>

<form action="{{ route('admin.galleries.update',$gallery->id) }}"
      method="POST"
      enctype="multipart/form-data"
      class="grid grid-cols-12 gap-6">
@csrf
@method('PUT')

{{-- Title --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Title</label>
<input type="text"
       name="title"
       value="{{ old('title',$gallery->title) }}"
       class="w-full border border-gray-300 rounded-xl px-4 py-2
              focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Status --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Status</label>
<select name="status"
class="w-full border border-gray-300 rounded-xl px-4 py-2
       focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
<option value="1" {{ $gallery->status ? 'selected' : '' }}>Active</option>
<option value="0" {{ !$gallery->status ? 'selected' : '' }}>Inactive</option>
</select>
</div>

{{-- Existing Images --}}
<div class="col-span-12">
<label class="block mb-4 font-medium">Existing Images</label>

<div class="grid grid-cols-2 md:grid-cols-4 gap-4">
@foreach($gallery->getMedia('gallery') as $media)
<div class="relative group">

<img src="{{ $media->getUrl() }}"
     class="w-full h-32 object-cover rounded-xl shadow">

{{-- Delete Button --}}
<form action="{{ route('admin.gallery.media.delete',$media->id) }}"
      method="POST"
      class="absolute top-2 right-2 hidden group-hover:block">
@csrf
@method('DELETE')
<button class="bg-red-600 text-white text-xs px-2 py-1 rounded">
✕
</button>
</form>

</div>
@endforeach
</div>
</div>

{{-- Add More Images --}}
<div class="col-span-12">
<label class="block mb-2 font-medium">Add More Images</label>
<input type="file"
       name="images[]"
       multiple
       class="w-full border border-gray-300 rounded-xl px-4 py-2
              focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Submit --}}
<div class="col-span-12 flex justify-end pt-4">
<button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-xl shadow">
Update Gallery
</button>
</div>

</form>

</div>
</div>
@endsection