@extends('layouts.admin')

@section('content')
<div class="p-6">

<h2 class="text-2xl font-bold mb-6">Enquiries</h2>

<div class="bg-white shadow rounded-xl overflow-hidden">
<table class="w-full text-sm">
<thead class="bg-gray-100">
<tr>
<th class="p-3">Listing</th>
<th class="p-3">Name</th>
<th class="p-3">Phone</th>
<th class="p-3">Travel Date</th>
<th class="p-3">Status</th>
<th class="p-3">Action</th>
</tr>
</thead>
<tbody>
@foreach($enquiries as $enquiry)
<tr class="border-t">

<td class="p-3">
{{ $enquiry->listing->title ?? '-' }}
</td>

<td class="p-3">
{{ $enquiry->name }}
</td>

<td class="p-3">
{{ $enquiry->phone }}
</td>

<td class="p-3">
{{ $enquiry->travel_date }}
</td>

<td class="p-3">
<span class="px-2 py-1 text-xs rounded
@if($enquiry->status=='pending') bg-yellow-100 text-yellow-700
@elseif($enquiry->status=='confirmed') bg-green-100 text-green-700
@else bg-red-100 text-red-700
@endif">
{{ ucfirst($enquiry->status) }}
</span>
</td>

<td class="p-3">
<a href="{{ route('admin.enquiries.show',$enquiry->id) }}"
class="text-indigo-600">View</a>
</td>

</tr>
@endforeach
</tbody>
</table>
</div>

</div>
@endsection