@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto">
<div class="bg-white shadow-xl rounded-2xl p-8">

<h2 class="text-2xl font-bold mb-8">Create Testimonial</h2>

<form action="{{ route('admin.testimonials.store') }}"
method="POST"
enctype="multipart/form-data"
class="grid grid-cols-12 gap-6">
@csrf

<div class="col-span-12 md:col-span-6">
<label class="block mb-2">Name *</label>
<input type="text" name="name"
class="w-full border border-gray-300 rounded-xl px-4 py-2">
</div>

<div class="col-span-12 md:col-span-6">
<label class="block mb-2">Designation</label>
<input type="text" name="designation"
class="w-full border border-gray-300 rounded-xl px-4 py-2">
</div>

<div class="col-span-12 md:col-span-6">
<label class="block mb-2">Rating</label>
<select name="rating"
class="w-full border border-gray-300 rounded-xl px-4 py-2">
@for($i=1;$i<=5;$i++)
<option value="{{ $i }}">{{ $i }} Star</option>
@endfor
</select>
</div>

<div class="col-span-12 md:col-span-6">
<label class="block mb-2">Status</label>
<select name="status"
class="w-full border border-gray-300 rounded-xl px-4 py-2">
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>

<div class="col-span-12">
<label class="block mb-2">Review *</label>
<textarea name="review" rows="4"
class="w-full border border-gray-300 rounded-xl px-4 py-2"></textarea>
</div>

<div class="col-span-12">
<label class="block mb-2">Client Image</label>
<input type="file" name="image"
class="w-full border border-gray-300 rounded-xl px-4 py-2">
</div>

<div class="col-span-12 flex justify-end">
<button class="bg-indigo-600 text-white px-6 py-2 rounded-xl">
Save
</button>
</div>

</form>
</div>
</div>
@endsection