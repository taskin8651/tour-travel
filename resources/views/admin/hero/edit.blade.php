@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto">
    <div class="bg-white shadow-xl rounded-2xl p-8">

        <h2 class="text-2xl font-bold mb-8">Edit Hero Section</h2>

        <form action="{{ route('admin.hero-sections.update',$hero_section->id) }}"
              method="POST"
              enctype="multipart/form-data"
              class="grid grid-cols-12 gap-6">

            @csrf
            @method('PUT')

            <div class="col-span-12 md:col-span-6">
                <label class="block mb-2 font-medium">Title *</label>
                <input type="text"
                       name="title"
                       value="{{ old('title',$hero_section->title) }}"
                       required
                       class="w-full border rounded-xl px-4 py-2">
            </div>

            <div class="col-span-12 md:col-span-6">
                <label class="block mb-2 font-medium">Subtitle</label>
                <input type="text"
                       name="subtitle"
                       value="{{ old('subtitle',$hero_section->subtitle) }}"
                       class="w-full border rounded-xl px-4 py-2">
            </div>

            <div class="col-span-12 md:col-span-6">
                <label class="block mb-2 font-medium">Button Text</label>
                <input type="text"
                       name="button_text"
                       value="{{ old('button_text',$hero_section->button_text) }}"
                       class="w-full border rounded-xl px-4 py-2">
            </div>

            <div class="col-span-12 md:col-span-6">
                <label class="block mb-2 font-medium">Button Link</label>
                <input type="text"
                       name="button_link"
                       value="{{ old('button_link',$hero_section->button_link) }}"
                       class="w-full border rounded-xl px-4 py-2">
            </div>

            <div class="col-span-12 md:col-span-6">
                <label class="block mb-2 font-medium">Hero Image</label>
                <input type="file"
                       name="media"
                       id="mediaInput"
                       accept="image/*"
                       class="w-full border rounded-xl px-4 py-2">
            </div>

            <div class="col-span-12 md:col-span-6">
                <label class="block mb-2 font-medium">Status</label>
                <select name="status"
                        class="w-full border rounded-xl px-4 py-2">

                    <option value="1" {{ $hero_section->status == 1 ? 'selected' : '' }}>
                        Active
                    </option>

                    <option value="0" {{ $hero_section->status == 0 ? 'selected' : '' }}>
                        Inactive
                    </option>

                </select>
            </div>

            @php
                $mediaUrl = $hero_section->getFirstMediaUrl('hero_media');
            @endphp

            <div class="col-span-12">
                @if($mediaUrl)
                    <label class="block mb-2 font-medium">Current Image</label>
                    <img src="{{ $mediaUrl }}" class="h-40 mt-2 rounded shadow">
                @endif
            </div>

            <div class="col-span-12" id="previewArea"></div>

            <div class="col-span-12 flex justify-end pt-4">
                <button class="bg-indigo-600 text-white px-6 py-2 rounded-xl">
                    Update Hero
                </button>
            </div>

        </form>
    </div>
</div>

<script>
document.getElementById('mediaInput').addEventListener('change', function(e){
    const file = e.target.files[0];
    const preview = document.getElementById('previewArea');
    preview.innerHTML = '';

    if(file){
        const url = URL.createObjectURL(file);
        preview.innerHTML = `<img src="${url}" class="h-40 mt-4 rounded shadow">`;
    }
});
</script>
@endsection