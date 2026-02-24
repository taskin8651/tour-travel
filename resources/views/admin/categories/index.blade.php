@extends('layouts.admin')

@section('content')
<div class="p-6">

    <!-- Header -->
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-semibold text-gray-800">Categories</h1>

        <a href="{{ route('admin.categories.create') }}"
           class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow transition">
            + Add Category
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="mb-4 bg-green-100 text-green-700 px-4 py-3 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    <!-- Table Card -->
    <div class="bg-white shadow rounded-xl overflow-hidden">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-600 uppercase text-xs">
                <tr>
                    <th class="px-6 py-4">#</th>
                    <th class="px-6 py-4">Name</th>
                    <th class="px-6 py-4">Slug</th>
                    <th class="px-6 py-4">Status</th>
                    <th class="px-6 py-4 text-right">Action</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach($categories as $key => $category)
                <tr class="hover:bg-gray-50 transition">
                    <td class="px-6 py-4">{{ $key+1 }}</td>
                    <td class="px-6 py-4 font-medium text-gray-800">
                        {{ $category->name }}
                    </td>
                    <td class="px-6 py-4 text-gray-500">
                        {{ $category->slug }}
                    </td>
                    <td class="px-6 py-4">
                        @if($category->status)
                            <span class="px-3 py-1 text-xs rounded-full bg-green-100 text-green-700">
                                Active
                            </span>
                        @else
                            <span class="px-3 py-1 text-xs rounded-full bg-red-100 text-red-700">
                                Inactive
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right flex justify-end gap-2">
                        <a href="{{ route('admin.categories.edit',$category->id) }}"
                           class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded-lg text-xs">
                            Edit
                        </a>

                        <form action="{{ route('admin.categories.destroy',$category->id) }}"
                              method="POST">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Delete this category?')"
                                    class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-xs">
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