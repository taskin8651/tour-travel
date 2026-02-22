@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-7xl mx-auto">

<div class="flex justify-between items-center mb-6">
    <h2 class="text-2xl font-bold text-gray-800">Testimonials</h2>

    <a href="{{ route('admin.testimonials.create') }}"
       class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-xl shadow">
        + Add Testimonial
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
<th class="p-4 text-left">Image</th>
<th class="p-4 text-left">Name</th>
<th class="p-4 text-left">Rating</th>
<th class="p-4 text-left">Status</th>
<th class="p-4 text-left">Action</th>
</tr>
</thead>

<tbody>
@foreach($testimonials as $testimonial)
<tr class="border-t">

<td class="p-4">
@if($testimonial->getFirstMediaUrl('testimonial'))
<img src="{{ $testimonial->getFirstMediaUrl('testimonial') }}"
     class="w-14 h-14 object-cover rounded-full">
@endif
</td>

<td class="p-4">
<div class="font-semibold">{{ $testimonial->name }}</div>
@if($testimonial->designation)
<div class="text-xs text-gray-500">
{{ $testimonial->designation }}
</div>
@endif
</td>

<td class="p-4 text-yellow-500">
@for($i=1;$i<=$testimonial->rating;$i++)
★
@endfor
</td>

<td class="p-4">
<span class="px-3 py-1 text-xs rounded-full
@if($testimonial->status)
bg-green-100 text-green-700
@else
bg-red-100 text-red-700
@endif">
{{ $testimonial->status ? 'Active' : 'Inactive' }}
</span>
</td>

<td class="p-4 flex gap-3">
<a href="{{ route('admin.testimonials.edit',$testimonial->id) }}"
   class="text-indigo-600 hover:underline">
   Edit
</a>

<form action="{{ route('admin.testimonials.destroy',$testimonial->id) }}"
      method="POST"
      onsubmit="return confirm('Delete this testimonial?')">
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