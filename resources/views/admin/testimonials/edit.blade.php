@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto">

<div class="bg-white shadow-xl rounded-2xl p-8">

<h2 class="text-2xl font-bold mb-8">
    Edit Testimonial
</h2>

<form action="{{ route('admin.testimonials.update',$testimonial->id) }}"
      method="POST"
      enctype="multipart/form-data"
      class="grid grid-cols-12 gap-6">
@csrf
@method('PUT')

{{-- Name --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Name *</label>
<input type="text"
       name="name"
       value="{{ old('name',$testimonial->name) }}"
       class="w-full border border-gray-300 rounded-xl px-4 py-2
              focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Designation --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Designation</label>
<input type="text"
       name="designation"
       value="{{ old('designation',$testimonial->designation) }}"
       class="w-full border border-gray-300 rounded-xl px-4 py-2
              focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Rating --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Rating</label>
<select name="rating"
class="w-full border border-gray-300 rounded-xl px-4 py-2
       focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
@for($i=1;$i<=5;$i++)
<option value="{{ $i }}"
{{ $testimonial->rating == $i ? 'selected' : '' }}>
{{ $i }} Star
</option>
@endfor
</select>
</div>

{{-- Status --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Status</label>
<select name="status"
class="w-full border border-gray-300 rounded-xl px-4 py-2
       focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
<option value="1" {{ $testimonial->status ? 'selected' : '' }}>
Active
</option>
<option value="0" {{ !$testimonial->status ? 'selected' : '' }}>
Inactive
</option>
</select>
</div>

{{-- Review --}}
<div class="col-span-12">
<label class="block mb-2 font-medium">Review *</label>
<textarea name="review" rows="4"
class="w-full border border-gray-300 rounded-xl px-4 py-2
       focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">{{ old('review',$testimonial->review) }}</textarea>
</div>

{{-- Current Image --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Current Image</label>

@if($testimonial->getFirstMediaUrl('testimonial'))
<img src="{{ $testimonial->getFirstMediaUrl('testimonial') }}"
class="w-24 h-24 rounded-full object-cover mb-4 shadow">
@endif

<input type="file"
       name="image"
       class="w-full border border-gray-300 rounded-xl px-4 py-2
              focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Submit --}}
<div class="col-span-12 flex justify-end pt-4">
<button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-xl shadow transition">
Update Testimonial
</button>
</div>

</form>

</div>
</div>
@endsection