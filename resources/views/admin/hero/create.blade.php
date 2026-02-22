@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto">

<div class="bg-white shadow-xl rounded-2xl p-8">

<h2 class="text-2xl font-bold mb-8">
    Create Hero Section
</h2>

<form action="{{ route('admin.hero-sections.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="grid grid-cols-12 gap-6">
@csrf

{{-- Title --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Title *</label>
<input type="text" name="title"
class="w-full border border-gray-300 rounded-xl px-4 py-2
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Subtitle --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Subtitle</label>
<input type="text" name="subtitle"
class="w-full border border-gray-300 rounded-xl px-4 py-2
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Button Text --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Button Text</label>
<input type="text" name="button_text"
class="w-full border border-gray-300 rounded-xl px-4 py-2
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Button Link --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Button Link</label>
<input type="text" name="button_link"
class="w-full border border-gray-300 rounded-xl px-4 py-2
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Background Image --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Background Image *</label>
<input type="file" name="image"
class="w-full border border-gray-300 rounded-xl px-4 py-2
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Status --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Status</label>
<select name="status"
class="w-full border border-gray-300 rounded-xl px-4 py-2
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>

{{-- Submit --}}
<div class="col-span-12 flex justify-end pt-4">
<button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-xl shadow transition">
Save Hero
</button>
</div>

</form>

</div>
</div>
@endsection