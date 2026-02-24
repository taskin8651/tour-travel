@extends('layouts.admin')

@section('content')
<div class="p-8 max-w-5xl mx-auto">

<div class="bg-white shadow-2xl rounded-2xl p-8 space-y-8">

{{-- Header --}}
<div class="flex justify-between items-center border-b pb-4">
    <div>
        <h2 class="text-2xl font-bold">Enquiry Invoice</h2>
        <p class="text-sm text-gray-500">
            Enquiry ID: #{{ $enquiry->id }}
        </p>
    </div>

    <span class="px-4 py-1 text-sm rounded-full
        @if($enquiry->status=='pending') bg-yellow-100 text-yellow-700
        @elseif($enquiry->status=='confirmed') bg-green-100 text-green-700
        @else bg-red-100 text-red-700
        @endif">
        {{ ucfirst($enquiry->status) }}
    </span>
</div>

{{-- Customer Details --}}
<div class="grid grid-cols-2 gap-6">

    <div>
        <h4 class="font-semibold mb-2">Customer Details</h4>
        <p><strong>Name:</strong> {{ $enquiry->name }}</p>
        <p><strong>Email:</strong> {{ $enquiry->email ?? '-' }}</p>
        <p><strong>Phone:</strong> {{ $enquiry->phone }}</p>
        <p><strong>Message:</strong> {{ $enquiry->message ?? '-' }}</p>
    </div>

    <div>
        <h4 class="font-semibold mb-2">Booking Type</h4>
        <p><strong>Category:</strong> {{ $enquiry->category->name ?? '-' }}</p>
        <p><strong>Created At:</strong> {{ $enquiry->created_at->format('d M Y') }}</p>

        @if(!$enquiry->listing)
            <p class="text-purple-600 font-semibold mt-2">Contact Form Enquiry</p>
        @endif
    </div>

</div>

{{-- Listing Details --}}
@if($enquiry->listing)
<div class="border-t pt-6">
    <h4 class="font-semibold mb-4">Listing Details</h4>

    <div class="grid grid-cols-2 gap-6">

        <div>
            <p><strong>Title:</strong> {{ $enquiry->listing->title }}</p>
            <p><strong>Location:</strong> {{ $enquiry->listing->location }}</p>
            <p><strong>Price:</strong> ₹{{ number_format($enquiry->listing->price) }}</p>
        </div>

        <div>
            @if($enquiry->travel_date)
                <p><strong>Travel Date:</strong> {{ $enquiry->travel_date }}</p>
                <p><strong>Persons:</strong> {{ $enquiry->persons ?? '-' }}</p>
            @endif

            @if($enquiry->checkin_date)
                @if($enquiry->checkin_date)
    <p><strong>Check-in:</strong>
        {{ $enquiry->checkin_date->format('d M Y') }}
    </p>
@endif

@if($enquiry->checkout_date)
    <p><strong>Check-out:</strong>
        {{ $enquiry->checkout_date->format('d M Y') }}
    </p>
@endif
                <p><strong>Rooms:</strong> {{ $enquiry->rooms ?? '-' }}</p>
            @endif

            @if($enquiry->package_requirements)
                <p><strong>Package Requirements:</strong> {{ $enquiry->package_requirements }}</p>
            @endif
        </div>

    </div>
</div>
@endif

{{-- Status Update --}}
<div class="border-t pt-6">
    <h4 class="font-semibold mb-4">Update Status</h4>

    <form method="POST"
          action="{{ route('admin.enquiries.update',$enquiry->id) }}"
          class="flex items-center gap-4">

        @csrf
        @method('PUT')

        <select name="status"
                class="border rounded-lg px-4 py-2">

            <option value="pending" {{ $enquiry->status=='pending'?'selected':'' }}>
                Pending
            </option>

            <option value="confirmed" {{ $enquiry->status=='confirmed'?'selected':'' }}>
                Confirmed
            </option>

            <option value="cancelled" {{ $enquiry->status=='cancelled'?'selected':'' }}>
                Cancelled
            </option>

        </select>

        <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2 rounded-lg">
            Update Status
        </button>

    </form>
</div>

</div>
</div>
@endsection