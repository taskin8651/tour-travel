@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto">

<div class="bg-white shadow-xl rounded-2xl p-8">

<h2 class="text-2xl font-bold mb-8">
    Edit Hero Section
</h2>

<form action="{{ route('admin.hero-sections.update',$hero_section->id) }}"
      method="POST"
      enctype="multipart/form-data"
      class="grid grid-cols-12 gap-6">
@csrf
@method('PUT')

{{-- Title --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Title *</label>
<input type="text"
       name="title"
       value="{{ old('title',$hero_section->title) }}"
       class="w-full border border-gray-300 rounded-xl px-4 py-2
              focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Subtitle --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Subtitle</label>
<input type="text"
       name="subtitle"
       value="{{ old('subtitle',$hero_section->subtitle) }}"
       class="w-full border border-gray-300 rounded-xl px-4 py-2
              focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Button Text --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Button Text</label>
<input type="text"
       name="button_text"
       value="{{ old('button_text',$hero_section->button_text) }}"
       class="w-full border border-gray-300 rounded-xl px-4 py-2
              focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Button Link --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Button Link</label>
<input type="text"
       name="button_link"
       value="{{ old('button_link',$hero_section->button_link) }}"
       class="w-full border border-gray-300 rounded-xl px-4 py-2
              focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Current Image + Replace --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Current Background Image</label>

@if($hero_section->getFirstMediaUrl('hero'))
    <img src="{{ $hero_section->getFirstMediaUrl('hero') }}"
         class="w-full h-40 object-cover rounded-xl mb-4 shadow">
@endif

<input type="file"
       name="image"
       id="heroImageInput"
       class="w-full border border-gray-300 rounded-xl px-4 py-2
              focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">

{{-- Live Preview --}}
<div id="imagePreviewContainer" class="mt-4 hidden">
    <p class="text-sm text-gray-600 mb-2">New Image Preview:</p>
    <img id="imagePreview"
         class="w-full h-40 object-cover rounded-xl shadow">
</div>
</div>

{{-- Status --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Status</label>
<select name="status"
class="w-full border border-gray-300 rounded-xl px-4 py-2
       focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
<option value="1" {{ $hero_section->status ? 'selected' : '' }}>
Active
</option>
<option value="0" {{ !$hero_section->status ? 'selected' : '' }}>
Inactive
</option>
</select>
</div>

{{-- Submit --}}
<div class="col-span-12 flex justify-end pt-4">
<button class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-xl shadow transition">
Update Hero
</button>
</div>

</form>
</div>
</div>
@endsection


@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function(){

    const input = document.getElementById('heroImageInput');
    const previewContainer = document.getElementById('imagePreviewContainer');
    const previewImage = document.getElementById('imagePreview');

    input.addEventListener('change', function(e){
        const file = e.target.files[0];
        if(file){
            const reader = new FileReader();
            reader.onload = function(event){
                previewImage.src = event.target.result;
                previewContainer.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        }
    });

});
</script>
@endsection