@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

<div class="bg-white shadow-xl rounded-2xl p-8">
<h2 class="text-xl font-bold mb-6">Edit Blog Category</h2>

<form action="{{ route('admin.blog-categories.update',$blog_category->id) }}"
method="POST"
class="space-y-6">
@csrf
@method('PUT')

<div>
<label>Name *</label>
<input type="text"
name="name"
value="{{ $blog_category->name }}"
class="w-full border rounded-xl px-4 py-2">
</div>

<div>
<label>Status</label>
<select name="status"
class="w-full border rounded-xl px-4 py-2">
<option value="1" {{ $blog_category->status ? 'selected' : '' }}>
Active
</option>
<option value="0" {{ !$blog_category->status ? 'selected' : '' }}>
Inactive
</option>
</select>
</div>

<button class="bg-indigo-600 text-white px-6 py-2 rounded-xl">
Update
</button>

</form>
</div>
</div>
@endsection