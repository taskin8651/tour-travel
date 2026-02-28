@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded shadow">
    <h2 class="text-xl font-semibold mb-6">
        {{ isset($service) ? 'Edit' : 'Create' }} Service
    </h2>

    <form method="POST"
          action="{{ isset($service)
                    ? route('admin.services.update',$service->id)
                    : route('admin.services.store') }}"
          enctype="multipart/form-data">
        @csrf
        @if(isset($service)) @method('PUT') @endif

        {{-- Title --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Title</label>
            <input type="text" name="title"
                   value="{{ old('title', $service->title ?? '') }}"
                   class="w-full border p-2 rounded"
                   required>
        </div>

        {{-- Short Description --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Short Description</label>
            <textarea name="short_description"
                      class="w-full border p-2 rounded"
                      rows="3"
                      required>{{ old('short_description', $service->short_description ?? '') }}</textarea>
        </div>

        {{-- Description --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Full Description</label>
            <textarea name="description"
                      class="w-full border p-2 rounded"
                      rows="5"
                      required>{{ old('description', $service->description ?? '') }}</textarea>
        </div>

        {{-- Featured Image --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Featured Image</label>

            <input type="file" name="featured_image"
                   onchange="previewImage(event, 'featuredPreview')"
                   class="mb-2">

            <img id="featuredPreview"
                 src="{{ isset($service) ? $service->getFirstMediaUrl('featured_image') : '' }}"
                 class="w-32 rounded shadow {{ isset($service) && $service->getFirstMediaUrl('featured_image') ? '' : 'hidden' }}">
        </div>

        {{-- Banner Image --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Banner Image</label>

            <input type="file" name="banner_image"
                   onchange="previewImage(event, 'bannerPreview')"
                   class="mb-2">

            <img id="bannerPreview"
                 src="{{ isset($service) ? $service->getFirstMediaUrl('banner_image') : '' }}"
                 class="w-48 rounded shadow {{ isset($service) && $service->getFirstMediaUrl('banner_image') ? '' : 'hidden' }}">
        </div>

        {{-- Gallery --}}
        <div class="mb-4">
            <label class="block font-medium mb-1">Gallery Images</label>

            <input type="file" name="gallery[]" multiple
                   onchange="previewMultiple(event)"
                   class="mb-2">

            {{-- Existing Images --}}
            <div class="flex gap-2 flex-wrap mt-2">
                @isset($service)
                    @foreach($service->getMedia('gallery') as $media)
                        <img src="{{ $media->getUrl() }}"
                             class="w-24 h-24 object-cover rounded shadow">
                    @endforeach
                @endisset
            </div>

            {{-- New Preview --}}
            <div id="galleryPreview"
                 class="flex gap-2 flex-wrap mt-2"></div>
        </div>

        {{-- Status --}}
        <div class="mb-6">
            <label class="inline-flex items-center">
                <input type="checkbox" name="status" value="1"
                       {{ isset($service) && $service->status ? 'checked' : '' }}>
                <span class="ml-2">Active</span>
            </label>
        </div>

        <button type="submit"
                class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded">
            Save Service
        </button>
    </form>
</div>

{{-- Preview Script --}}
<script>
function previewImage(event, previewId) {
    const input = event.target;
    const preview = document.getElementById(previewId);

    if (input.files && input.files[0]) {
        preview.src = URL.createObjectURL(input.files[0]);
        preview.classList.remove('hidden');
    }
}

function previewMultiple(event) {
    const previewContainer = document.getElementById('galleryPreview');
    previewContainer.innerHTML = "";

    Array.from(event.target.files).forEach(file => {
        const img = document.createElement('img');
        img.src = URL.createObjectURL(file);
        img.className = "w-24 h-24 object-cover rounded shadow";
        previewContainer.appendChild(img);
    });
}
</script>

@endsection