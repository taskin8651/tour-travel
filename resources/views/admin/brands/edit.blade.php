@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-5xl mx-auto">

<div class="bg-white shadow-xl rounded-2xl p-8">

<h2 class="text-2xl font-bold mb-8 text-gray-800">
Edit Brand
</h2>

<form action="{{ route('admin.brands.update',$brand->id) }}"
      method="POST"
      enctype="multipart/form-data"
      class="grid grid-cols-12 gap-6">
@csrf
@method('PUT')

{{-- Name --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Brand Name *</label>
<input type="text" name="name"
       value="{{ $brand->name }}"
       class="w-full border rounded-xl px-4 py-2">
</div>

{{-- Website --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Website URL</label>
<input type="text" name="website_url"
       value="{{ $brand->website_url }}"
       class="w-full border rounded-xl px-4 py-2">
</div>

{{-- Sort Order --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Sort Order</label>
<input type="number" name="sort_order"
       value="{{ $brand->sort_order }}"
       class="w-full border rounded-xl px-4 py-2">
</div>

{{-- Status --}}
<div class="col-span-12 md:col-span-6">
<label class="block mb-2 font-medium">Status</label>
<select name="status"
        class="w-full border rounded-xl px-4 py-2">
<option value="1" {{ $brand->status ? 'selected' : '' }}>Active</option>
<option value="0" {{ !$brand->status ? 'selected' : '' }}>Inactive</option>
</select>
</div>

{{-- Logo --}}
<div class="col-span-12">
<label class="block mb-2 font-medium">Brand Logo</label>

@if($brand->getFirstMediaUrl('brand_logo'))
<img src="{{ $brand->getFirstMediaUrl('brand_logo') }}"
     class="h-20 mb-4 object-contain rounded shadow">
@endif

<input type="file" name="logo"
       class="w-full border rounded-xl px-4 py-2">
</div>

<div class="col-span-12 flex justify-end">
<button class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-3 rounded-xl shadow">
Update Brand
</button>
</div>

</form>

</div>
</div>
@endsection