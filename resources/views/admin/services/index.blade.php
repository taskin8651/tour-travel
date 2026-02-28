@extends('layouts.admin')

@section('content')
<div class="p-6 bg-white rounded shadow">

    <div class="flex justify-between items-center mb-6">
        <h2 class="text-xl font-semibold">Services</h2>

        <a href="{{ route('admin.services.create') }}"
           class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
            + Add Service
        </a>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border-collapse">
            <thead>
                <tr class="bg-gray-100 text-left">
                    <th class="p-3 border">Image</th>
                    <th class="p-3 border">Title</th>
                    <th class="p-3 border">Status</th>
                    <th class="p-3 border text-center">Action</th>
                </tr>
            </thead>

            <tbody>
                @forelse($services as $service)
                <tr class="border-t hover:bg-gray-50">

                    {{-- Featured Image --}}
                    <td class="p-3 border">
                        @if($service->getFirstMediaUrl('featured_image'))
                            <img src="{{ $service->getFirstMediaUrl('featured_image') }}"
                                 class="w-16 h-16 object-cover rounded shadow">
                        @else
                            <span class="text-gray-400 text-sm">No Image</span>
                        @endif
                    </td>

                    {{-- Title --}}
                    <td class="p-3 border font-medium">
                        {{ $service->title }}
                    </td>

                    {{-- Status --}}
                    <td class="p-3 border">
                        @if($service->status)
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">
                                Active
                            </span>
                        @else
                            <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs">
                                Inactive
                            </span>
                        @endif
                    </td>

                    {{-- Actions --}}
                    <td class="p-3 border text-center">
                        <div class="flex justify-center gap-3">

                            <a href="{{ route('admin.services.edit', $service->id) }}"
                               class="text-blue-600 hover:underline">
                                Edit
                            </a>

                            <form action="{{ route('admin.services.destroy', $service->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button class="text-red-600 hover:underline">
                                    Delete
                                </button>
                            </form>

                        </div>
                    </td>

                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-6 text-gray-500">
                        No Services Found
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $services->links() }}
    </div>

</div>
@endsection