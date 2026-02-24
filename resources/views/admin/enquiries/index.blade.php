@extends('layouts.admin')

@section('content')
<div class="p-6">

<h2 class="text-2xl font-bold mb-6">Enquiries</h2>

<div class="bg-white shadow rounded-xl overflow-x-auto">
<table class="w-full text-sm">
<thead class="bg-gray-100">
<tr>
<th class="p-3">Type</th>
<th class="p-3">Category</th>
<th class="p-3">Listing</th>
<th class="p-3">Name</th>
<th class="p-3">Email</th>
<th class="p-3">Phone</th>
<th class="p-3">Travel Date</th>
<th class="p-3">Persons</th>
<th class="p-3">Checkin</th>
<th class="p-3">Checkout</th>
<th class="p-3">Rooms</th>
<th class="p-3">Message</th>
<th class="p-3">Status</th>
<th class="p-3">Action</th>
</tr>
</thead>

<tbody>
@foreach($enquiries as $enquiry)
<tr class="border-t">

{{-- Type --}}
<td class="p-3">
@if($enquiry->listing_id)
    <span class="text-blue-600 font-semibold">Booking</span>
@else
    <span class="text-purple-600 font-semibold">Contact</span>
@endif
</td>

{{-- Category --}}
<td class="p-3">
{{ $enquiry->category->name ?? '-' }}
</td>

{{-- Listing --}}
<td class="p-3">
@if($enquiry->listing)
    {{ $enquiry->listing->title }}
@else
    <span class="text-gray-500 italic">Contact Form</span>
@endif
</td>

<td class="p-3">{{ $enquiry->name }}</td>
<td class="p-3">{{ $enquiry->email ?? '-' }}</td>
<td class="p-3">{{ $enquiry->phone }}</td>

{{-- Travel --}}
<td class="p-3">{{ $enquiry->travel_date ?? '-' }}</td>
<td class="p-3">{{ $enquiry->persons ?? '-' }}</td>

{{-- Room --}}
<td class="p-3">{{ $enquiry->checkin_date ?? '-' }}</td>
<td class="p-3">{{ $enquiry->checkout_date ?? '-' }}</td>
<td class="p-3">{{ $enquiry->rooms ?? '-' }}</td>

{{-- Message --}}
<td class="p-3 max-w-xs truncate">
{{ $enquiry->message ?? '-' }}
</td>

{{-- Status --}}
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