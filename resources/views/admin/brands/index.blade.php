@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Brands</h2>

    <a href="{{ route('admin.brands.create') }}"
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-xl shadow">
        + Add Brand
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow-xl rounded-2xl overflow-hidden">
<table class="w-full text-sm">

<thead class="bg-gray-100 text-gray-700">
<tr>
    <th class="p-4 text-left">Logo</th>
    <th>Name</th>
    <th>Website</th>
    <th>Sort</th>
    <th>Status</th>
    <th>Action</th>
</tr>
</thead>

<tbody>
@forelse($brands as $brand)
<tr class="border-t">

<td class="p-4">
@if($brand->getFirstMediaUrl('brand_logo'))
<img src="{{ $brand->getFirstMediaUrl('brand_logo') }}"
     class="h-12 object-contain">
@endif
</td>

<td>{{ $brand->name }}</td>

<td>
@if($brand->website_url)
<a href="{{ $brand->website_url }}"
   target="_blank"
   class="text-indigo-600 hover:underline">
   Visit
</a>
@endif
</td>

<td>{{ $brand->sort_order }}</td>

<td>
<span class="px-3 py-1 text-xs rounded-full
{{ $brand->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
{{ $brand->status ? 'Active' : 'Inactive' }}
</span>
</td>

<td class="flex gap-3 p-4">
<a href="{{ route('admin.brands.edit',$brand->id) }}"
   class="text-indigo-600 hover:underline">
   Edit
</a>

<form action="{{ route('admin.brands.destroy',$brand->id) }}"
      method="POST"
      onsubmit="return confirm('Delete this brand?')">
@csrf
@method('DELETE')
<button class="text-red-600 hover:underline">
Delete
</button>
</form>
</td>

</tr>
@empty
<tr>
<td colspan="6" class="text-center p-6 text-gray-500">
No brands found.
</td>
</tr>
@endforelse

</tbody>
</table>
</div>

</div>
@endsection