@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">
            Create Sub Category
        </h2>

        <form action="{{ route('sub-categories.store') }}" 
              method="POST" 
              class="space-y-5">
            @csrf

            <!-- Category Dropdown -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Select Category
                </label>
                <select name="category_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    <option value="">-- Select Category --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Sub Category Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Sub Category Name
                </label>
                <input type="text" name="name"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                       required>
            </div>

            <!-- Status -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Status
                </label>
                <select name="status"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>

            <!-- Button -->
            <div class="flex justify-end">
                <button type="submit"
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow">
                    Save Sub Category
                </button>
            </div>

        </form>
    </div>

</div>
@endsection