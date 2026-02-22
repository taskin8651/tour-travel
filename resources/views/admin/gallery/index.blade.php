@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Gallery Sections</h2>

    <a href="{{ route('admin.galleries.create') }}"
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-xl shadow">
        + Add Gallery
    </a>
</div>

@if(session('success'))
<div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
    {{ session('success') }}
</div>
@endif

<div class="bg-white shadow rounded-xl overflow-hidden">
<table class="w-full text-sm">
<thead class="bg-gray-100">
<tr>
<th class="p-4 text-left">Title</th>
<th class="p-4 text-left">Images</th>
<th class="p-4 text-left">Status</th>
<th class="p-4 text-left">Action</th>
</tr>
</thead>

<tbody>
@foreach($galleries as $gallery)
<tr class="border-t">

<td class="p-4 font-medium">
{{ $gallery->title ?? 'No Title' }}
</td>

<td class="p-4">
<div class="flex gap-2">
@foreach($gallery->getMedia('gallery')->take(3) as $media)
<img src="{{ $media->getUrl() }}"
     class="w-14 h-14 object-cover rounded">
@endforeach
</div>
</td>

<td class="p-4">
<span class="px-3 py-1 text-xs rounded-full
@if($gallery->status)
bg-green-100 text-green-700
@else
bg-red-100 text-red-700
@endif">
{{ $gallery->status ? 'Active' : 'Inactive' }}
</span>
</td>

<td class="p-4 flex gap-3">
<a href="{{ route('admin.galleries.edit',$gallery->id) }}"
   class="text-indigo-600 hover:underline">
   Edit
</a>

<form action="{{ route('admin.galleries.destroy',$gallery->id) }}"
      method="POST"
      onsubmit="return confirm('Delete this gallery?')">
@csrf
@method('DELETE')
<button class="text-red-600 hover:underline">
Delete
</button>
</form>
</td>

</tr>
@endforeach
</tbody>
</table>
</div>

</div>
@endsection