@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-6xl mx-auto">

<div class="flex justify-between mb-6">
<h2 class="text-2xl font-bold">Blog Categories</h2>

<a href="{{ route('admin.blog-categories.create') }}"
class="bg-indigo-600 text-white px-5 py-2 rounded-xl shadow">
+ Add Category
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
<th class="p-4 text-left">Name</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>
@foreach($categories as $category)
<tr class="border-t">
<td class="p-4">{{ $category->name }}</td>
<td>
<span class="px-3 py-1 text-xs rounded-full
{{ $category->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
{{ $category->status ? 'Active' : 'Inactive' }}
</span>
</td>

<td class="flex gap-3 p-4">
<a href="{{ route('admin.blog-categories.edit',$category->id) }}"
class="text-indigo-600">Edit</a>

<form action="{{ route('admin.blog-categories.destroy',$category->id) }}"
method="POST"
onsubmit="return confirm('Delete this category?')">
@csrf
@method('DELETE')
<button class="text-red-600">Delete</button>
</form>
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
@endsection