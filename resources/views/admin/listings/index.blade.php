@extends('layouts.admin')

@section('content')
<div class="p-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-semibold">Listings</h1>

        <a href="{{ route('admin.listings.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
            + Add Listing
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-gray-100 text-xs uppercase text-gray-600">
                <tr>
                    <th class="p-4">Image</th>
                    <th class="p-4">Title</th>
                    <th class="p-4">Category</th>
                    <th class="p-4">Sub Category</th>
                    <th class="p-4">Price</th>
                    <th class="p-4">Status</th>
                    <th class="p-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y">
                @foreach($listings as $listing)
                <tr class="hover:bg-gray-50">

                    <td class="p-4">
                        @if($listing->getFirstMediaUrl('main'))
                            <img src="{{ $listing->getFirstMediaUrl('main') }}"
                                 class="w-14 h-14 object-cover rounded">
                        @endif
                    </td>

                    <td class="p-4 font-medium">{{ $listing->title }}</td>
                    <td class="p-4">{{ $listing->category->name ?? '-' }}</td>
                    <td class="p-4">{{ $listing->subCategory->name ?? '-' }}</td>
                    <td class="p-4">₹{{ $listing->price }}</td>

                    <td class="p-4">
                        @if($listing->status)
                            <span class="px-2 py-1 bg-green-100 text-green-700 text-xs rounded-full">
                                Active
                            </span>
                        @else
                            <span class="px-2 py-1 bg-red-100 text-red-700 text-xs rounded-full">
                                Inactive
                            </span>
                        @endif
                    </td>

                    <td class="p-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.listings.edit',$listing->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-xs">
                            Edit
                        </a>

                        <form action="{{ route('admin.listings.destroy',$listing->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this listing?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
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