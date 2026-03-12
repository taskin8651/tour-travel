@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

<div class="bg-white shadow-xl rounded-2xl p-8">
<h2 class="text-2xl font-bold text-gray-800 mb-8">
    Edit Listing
</h2>

<form action="{{ route('admin.listings.update',$listing->id) }}"
      method="POST"
      enctype="multipart/form-data"
      class="grid grid-cols-12 gap-6">
@csrf
@method('PUT')

{{-- Category --}}
<div class="col-span-12 md:col-span-6">
<label class="block text-sm font-medium text-gray-700 mb-2">Category</label>
<select name="category_id"
class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
<option value="">Select Category</option>
@foreach($categories as $category)
<option value="{{ $category->id }}"
{{ $listing->category_id == $category->id ? 'selected' : '' }}>
{{ $category->name }}
</option>
@endforeach
</select>
</div>

{{-- Sub Category --}}
<div class="col-span-12 md:col-span-6">
<label class="block text-sm font-medium text-gray-700 mb-2">Sub Category</label>
<select name="sub_category_id"
class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
<option value="">Select Sub Category</option>
@foreach($subCategories as $sub)
<option value="{{ $sub->id }}"
{{ $listing->sub_category_id == $sub->id ? 'selected' : '' }}>
{{ $sub->name }}
</option>
@endforeach
</select>
</div>

{{-- Title --}}
<div class="col-span-12 md:col-span-6">
<label class="block text-sm font-medium text-gray-700 mb-2">Title</label>
<input type="text" name="title"
value="{{ $listing->title }}"
class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Location --}}
<div class="col-span-12 md:col-span-6">
<label class="block text-sm font-medium text-gray-700 mb-2">Location</label>
<input type="text" name="location"
value="{{ $listing->location }}"
class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Price --}}
<div class="col-span-12 md:col-span-6">
<label class="block text-sm font-medium text-gray-700 mb-2">Price</label>
<input type="number" name="price"
value="{{ $listing->price }}"
class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Rooms --}}
<div class="col-span-12 md:col-span-6">
<label class="block text-sm font-medium text-gray-700 mb-2">Nights</label>
<input type="number" name="rooms"
value="{{ $listing->rooms }}"
class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Seats --}}
<div class="col-span-12 md:col-span-6">
<label class="block text-sm font-medium text-gray-700 mb-2">Seats</label>
<input type="number" name="seats"
value="{{ $listing->seats }}"
class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Days --}}
<div class="col-span-12 md:col-span-6">
<label class="block text-sm font-medium text-gray-700 mb-2">Days</label>
<input type="number" name="days"
value="{{ $listing->days }}"
class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
</div>

{{-- Description --}}
<div class="col-span-12">
<label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
<textarea name="description" rows="4"
class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">{{ $listing->description }}</textarea>
</div>

{{-- Main Image --}}
<div class="col-span-12 md:col-span-6">
<label class="block text-sm font-semibold text-gray-700 mb-3">Main Image</label>

@if($listing->getFirstMediaUrl('main'))
<div class="mb-4">
<img src="{{ $listing->getFirstMediaUrl('main') }}"
class="w-40 h-32 object-cover rounded-xl shadow">
</div>
@endif

<input type="file" name="image" id="mainImageInput"
class="w-full border border-gray-300 rounded-xl px-4 py-2">
<div id="mainPreview" class="mt-3 hidden">
<img id="mainPreviewImg"
class="w-40 h-32 object-cover rounded-xl shadow">
</div>
</div>

{{-- Gallery --}}
<div class="col-span-12 md:col-span-6">
<label class="block text-sm font-semibold text-gray-700 mb-3">
Gallery Images
</label>

@if($listing->getMedia('gallery')->count())
<div class="grid grid-cols-3 gap-3 mb-4">
@foreach($listing->getMedia('gallery') as $media)
<img src="{{ $media->getUrl() }}"
class="h-24 object-cover rounded-xl shadow">
@endforeach
</div>
@endif

<input type="file" name="gallery[]" id="galleryInput"
multiple class="w-full border border-gray-300 rounded-xl px-4 py-2">

<div id="galleryPreview"
class="grid grid-cols-3 gap-4 mt-4"></div>
</div>

{{-- Status --}}
<div class="col-span-12 md:col-span-6">
<label class="block text-sm font-semibold text-gray-700 mb-3">
Status
</label>
<select name="status"
class="w-full border border-gray-300 rounded-xl px-4 py-2 shadow-sm
focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition">
<option value="1" {{ $listing->status == 1 ? 'selected' : '' }}>🟢 Active</option>
<option value="0" {{ $listing->status == 0 ? 'selected' : '' }}>🔴 Inactive</option>
</select>
</div>

{{-- Submit --}}
<div class="col-span-12 flex justify-end pt-4">
<button type="submit"
class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium
px-8 py-3 rounded-xl shadow-md transition">
Update Listing
</button>
</div>

</form>
</div>
</div>
@endsection


@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function () {

    // Main image preview
    const mainInput = document.getElementById('mainImageInput');
    const mainPreview = document.getElementById('mainPreview');
    const mainPreviewImg = document.getElementById('mainPreviewImg');

    if(mainInput){
        mainInput.addEventListener('change', function(e){
            const file = e.target.files[0];
            if(file){
                const reader = new FileReader();
                reader.onload = function(event){
                    mainPreviewImg.src = event.target.result;
                    mainPreview.classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    }

    // Gallery preview
    const galleryInput = document.getElementById('galleryInput');
    const galleryPreview = document.getElementById('galleryPreview');

    if(galleryInput){
        galleryInput.addEventListener('change', function(e){
            galleryPreview.innerHTML = '';

            Array.from(e.target.files).forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = function(event){
                    const wrapper = document.createElement('div');
                    wrapper.classList.add('relative');

                    const img = document.createElement('img');
                    img.src = event.target.result;
                    img.classList.add(
                        'w-full','h-24','object-cover',
                        'rounded-xl','shadow'
                    );

                    const removeBtn = document.createElement('button');
                    removeBtn.innerHTML = '✕';
                    removeBtn.type = "button";
                    removeBtn.classList.add(
                        'absolute','top-1','right-1',
                        'bg-red-500','text-white',
                        'text-xs','px-2','py-1',
                        'rounded'
                    );

                    removeBtn.onclick = function(){
                        wrapper.remove();
                    };

                    wrapper.appendChild(img);
                    wrapper.appendChild(removeBtn);
                    galleryPreview.appendChild(wrapper);
                };

                reader.readAsDataURL(file);
            });
        });
    }

});
</script>
@endsection