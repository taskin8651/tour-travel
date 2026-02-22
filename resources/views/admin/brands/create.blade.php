@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto">

<div class="bg-white shadow-xl rounded-2xl p-8">

<h2 class="text-2xl font-bold mb-8 text-gray-800">
Create Brand
</h2>

<form action="{{ route('admin.brands.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="grid grid-cols-12 gap-6">
@csrf

{{-- Name --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Brand Name *</label>
<input type="text" name="name"
       class="w-full border rounded-xl px-4 py-2">
</div>

{{-- Website --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Website URL</label>
<input type="text" name="website_url"
       class="w-full border rounded-xl px-4 py-2">
</div>

{{-- Sort Order --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Sort Order</label>
<input type="number" name="sort_order" value="0"
       class="w-full border rounded-xl px-4 py-2">
</div>

{{-- Status --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Status</label>
<select name="status"
        class="w-full border rounded-xl px-4 py-2">
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>

{{-- Logo Upload --}}
<div class="col-span-12">
<label class="block mb-2 font-medium">Brand Logo *</label>

<input type="file" name="logo" id="logoInput"
       class="w-full border rounded-xl px-4 py-2">

<div id="logoPreview" class="mt-4 hidden">
    <img id="previewImg"
         class="h-20 object-contain rounded shadow">
</div>
</div>

<div class="col-span-12 flex justify-end">
<button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl shadow">
Save Brand
</button>
</div>

</form>

</div>
</div>

<script>
document.getElementById('logoInput').addEventListener('change', function(e){
    const file = e.target.files[0];
    if(file){
        const reader = new FileReader();
        reader.onload = function(event){
            document.getElementById('previewImg').src = event.target.result;
            document.getElementById('logoPreview').classList.remove('hidden');
        };
        reader.readAsDataURL(file);
    }
});
</script>

@endsection