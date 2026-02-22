@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

<div class="flex justify-between mb-6">
<h2 class="text-2xl font-bold">Blogs</h2>

<a href="{{ route('admin.blogs.create') }}"
class="bg-indigo-600 text-white px-5 py-2 rounded-xl shadow">
+ Add Blog
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
<th class="p-4">Image</th>
<th>Title</th>
<th>Category</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>
@foreach($blogs as $blog)
<tr class="border-t">

<td class="p-4">
@if($blog->getFirstMediaUrl('blog'))
<img src="{{ $blog->getFirstMediaUrl('blog') }}"
class="w-20 h-14 object-cover rounded">
@endif
</td>

<td>{{ $blog->title }}</td>
<td>{{ $blog->category->name }}</td>

<td>
<span class="px-3 py-1 text-xs rounded-full
{{ $blog->status ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
{{ $blog->status ? 'Published' : 'Draft' }}
</span>
</td>

<td class="flex gap-3 p-4">
<a href="{{ route('admin.blogs.edit',$blog->id) }}"
class="text-indigo-600">Edit</a>

<form action="{{ route('admin.blogs.destroy',$blog->id) }}"
method="POST"
onsubmit="return confirm('Delete this blog?')">
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