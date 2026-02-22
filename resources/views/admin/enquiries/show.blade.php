@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-3xl mx-auto">

<div class="bg-white shadow rounded-xl p-6 space-y-4">

<h2 class="text-xl font-bold">Enquiry Details</h2>

<p><strong>Listing:</strong> {{ $enquiry->listing->title }}</p>
<p><strong>Name:</strong> {{ $enquiry->name }}</p>
<p><strong>Email:</strong> {{ $enquiry->email }}</p>
<p><strong>Phone:</strong> {{ $enquiry->phone }}</p>
<p><strong>Travel Date:</strong> {{ $enquiry->travel_date }}</p>
<p><strong>Persons:</strong> {{ $enquiry->persons }}</p>
<p><strong>Message:</strong> {{ $enquiry->message }}</p>

<form method="POST"
action="{{ route('enquiries.update',$enquiry->id) }}">
@csrf
@method('PUT')

<select name="status"
class="border rounded px-3 py-2">
<option value="pending">Pending</option>
<option value="confirmed">Confirmed</option>
<option value="cancelled">Cancelled</option>
</select>

<button class="bg-indigo-600 text-white px-4 py-2 rounded ml-3">
Update Status
</button>
</form>

</div>
</div>
@endsection