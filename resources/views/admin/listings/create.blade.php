@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

    <div class="bg-white shadow-xl rounded-2xl p-8">
        <h2 class="text-2xl font-bold text-gray-800 mb-8">
            Create Listing
        </h2>

        <form action="{{ route('admin.listings.store') }}"
              method="POST"
              enctype="multipart/form-data"
              class="grid grid-cols-12 gap-6">
            @csrf

           {{-- Category --}}
<div class="col-span-12 md:col-span-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Category
    </label>
    <select name="category_id"
        class="w-full border border-gray-300 rounded-xl px-4 py-2
               shadow-sm focus:border-indigo-500 focus:ring-2
               focus:ring-indigo-200 focus:outline-none transition">
        <option value="">Select Category</option>
        @foreach($categories as $category)
            <option value="{{ $category->id }}">
                {{ $category->name }}
            </option>
        @endforeach
    </select>
</div>

{{-- Sub Category --}}
<div class="col-span-12 md:col-span-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Sub Category
    </label>
    <select name="sub_category_id"
        class="w-full border border-gray-300 rounded-xl px-4 py-2
               shadow-sm focus:border-indigo-500 focus:ring-2
               focus:ring-indigo-200 focus:outline-none transition">
        <option value="">Select Sub Category</option>
        @foreach($subCategories as $sub)
            <option value="{{ $sub->id }}">
                {{ $sub->name }}
            </option>
        @endforeach
    </select>
</div>

          {{-- Title --}}
<div class="col-span-12 md:col-span-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Title
    </label>
    <input type="text" name="title"
        class="w-full border border-gray-300 rounded-xl px-4 py-2
               shadow-sm focus:border-indigo-500 focus:ring-2
               focus:ring-indigo-200 focus:outline-none transition">
</div>

{{-- Location --}}
<div class="col-span-12 md:col-span-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Location
    </label>
    <input type="text" name="location"
        class="w-full border border-gray-300 rounded-xl px-4 py-2
               shadow-sm focus:border-indigo-500 focus:ring-2
               focus:ring-indigo-200 focus:outline-none transition">
</div>

{{-- Price --}}
<div class="col-span-12 md:col-span-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Price
    </label>
    <input type="number" name="price"
        class="w-full border border-gray-300 rounded-xl px-4 py-2
               shadow-sm focus:border-indigo-500 focus:ring-2
               focus:ring-indigo-200 focus:outline-none transition">
</div>

{{-- Rooms --}}
<div class="col-span-12 md:col-span-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Rooms
    </label>
    <input type="number" name="rooms"
        class="w-full border border-gray-300 rounded-xl px-4 py-2
               shadow-sm focus:border-indigo-500 focus:ring-2
               focus:ring-indigo-200 focus:outline-none transition">
</div>

{{-- Seats --}}
<div class="col-span-12 md:col-span-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Seats
    </label>
    <input type="number" name="seats"
        class="w-full border border-gray-300 rounded-xl px-4 py-2
               shadow-sm focus:border-indigo-500 focus:ring-2
               focus:ring-indigo-200 focus:outline-none transition">
</div>

{{-- Days --}}
<div class="col-span-12 md:col-span-6">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Days
    </label>
    <input type="number" name="days"
        class="w-full border border-gray-300 rounded-xl px-4 py-2
               shadow-sm focus:border-indigo-500 focus:ring-2
               focus:ring-indigo-200 focus:outline-none transition">
</div>

{{-- Description --}}
<div class="col-span-12">
    <label class="block text-sm font-medium text-gray-700 mb-2">
        Description
    </label>
    <textarea name="description" rows="4"
        class="w-full border border-gray-300 rounded-xl px-4 py-2
               shadow-sm focus:border-indigo-500 focus:ring-2
               focus:ring-indigo-200 focus:outline-none transition"></textarea>
</div>
{{-- Main Image --}}
<div class="col-span-12 md:col-span-6">
    <label class="block text-sm font-semibold text-gray-700 mb-3">
        Main Image
    </label>

    <label class="upload-box">
        <div class="upload-content flex flex-col items-center justify-center w-full h-40
               border-2 border-dashed border-gray-300
               rounded-2xl cursor-pointer bg-gray-50
               hover:bg-gray-100 transition">
            <p class="upload-text text-indigo-600 text-sm font-medium text-indigo-600">Click to upload or drag & drop</p>
            <p class="upload-sub text-xs text-gray-500 mt-1">PNG, JPG (800x600 recommended)</p>
        </div>
        <input type="file" name="image" id="mainImageInput" class="hidden">
    </label>

    {{-- Preview --}}
    <div id="mainPreview" class="mt-4 hidden">
        <img id="mainPreviewImg"
             class="w-40 h-32 object-cover rounded-xl shadow">
    </div>
</div>


{{-- Gallery Images --}}
<div class="col-span-12 md:col-span-6">
    <label class="block text-sm font-semibold text-gray-700 mb-3">
        Gallery Images
    </label>

    <label class="upload-box flex flex-col items-center justify-center w-full h-40
           border-2 border-dashed border-gray-300
           rounded-2xl cursor-pointer bg-gray-50
           hover:bg-gray-100 transition bg-indigo-50 border-indigo-300">
        <div class="upload-content text-center">
            <p class="upload-text text-indigo-600 text-sm font-medium text-indigo-600">Upload multiple images</p>
            <p class="upload-sub text-xs text-gray-500 mt-1">You can select multiple files</p>
        </div>
        <input type="file" name="gallery[]" id="galleryInput" multiple class="hidden">
    </label>

    {{-- Gallery Preview --}}
    <div id="galleryPreview"
         class="grid grid-cols-3 gap-4 mt-4"></div>
</div>

<script>
/* Main Image Preview */
document.getElementById('mainImageInput')
.addEventListener('change', function(e){
    const file = e.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(event){
            const preview = document.getElementById('mainPreview');
            const img = document.getElementById('mainPreviewImg');
            img.src = event.target.result;
            preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});

/* Gallery Preview */
document.getElementById('galleryInput')
.addEventListener('change', function(e){
    const previewContainer = document.getElementById('galleryPreview');
    previewContainer.innerHTML = '';

    Array.from(e.target.files).forEach(file => {
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

            wrapper.appendChild(img);
            previewContainer.appendChild(wrapper);
        };

        reader.readAsDataURL(file);
    });
});
</script>


            {{-- Status --}}
           <div class="col-span-12 md:col-span-6">
    <label class="block text-sm font-semibold text-gray-700 mb-3">
        Status
    </label>

    <div class="relative">
        <select name="status"
            class="w-full appearance-none border border-gray-300
                   rounded-xl px-4 py-2 pr-10
                   shadow-sm bg-white
                   focus:border-indigo-500 focus:ring-2
                   focus:ring-indigo-200 focus:outline-none transition">

            <option value="1">🟢 Active</option>
            <option value="0">🔴 Inactive</option>

        </select>

        {{-- Custom Dropdown Icon --}}
        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none">
            <svg class="w-4 h-4 text-gray-400"
                 fill="none" stroke="currentColor" stroke-width="2"
                 viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      d="M19 9l-7 7-7-7" />
            </svg>
        </div>
    </div>
</div>

            {{-- Submit --}}
            <div class="col-span-12 flex justify-end pt-4">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium
                               px-8 py-3 rounded-xl shadow-md transition duration-200">
                    Save Listing
                </button>
            </div>

        </form>
    </div>
</div>
@endsection