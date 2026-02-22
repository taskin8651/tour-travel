@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-4xl mx-auto">

<div class="bg-white shadow-xl rounded-2xl p-8">
<h2 class="text-xl font-bold mb-6">Create Blog Category</h2>

<form action="{{ route('admin.blog-categories.store') }}"
method="POST"
class="space-y-6">
@csrf

<div>
<label>Name *</label>
<input type="text" name="name"
class="w-full border rounded-xl px-4 py-2">
</div>

<div>
<label>Status</label>
<select name="status"
class="w-full border rounded-xl px-4 py-2">
<option value="1">Active</option>
<option value="0">Inactive</option>
</select>
</div>

<button class="bg-indigo-600 text-white px-6 py-2 rounded-xl">
Save
</button>

</form>
</div>
</div>
@endsection