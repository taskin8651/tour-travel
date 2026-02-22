@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">
            Edit Sub Category
        </h2>

        <form action="{{ route('sub-categories.update',$sub_category->id) }}"
              method="POST"
              class="space-y-5">
            @csrf
            @method('PUT')

            <!-- Category -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Select Category
                </label>
                <select name="category_id"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                        required>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}"
                            {{ $sub_category->category_id == $category->id ? 'selected':'' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Name -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Sub Category Name
                </label>
                <input type="text" name="name"
                       value="{{ $sub_category->name }}"
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
                    <option value="1" {{ $sub_category->status ? 'selected':'' }}>Active</option>
                    <option value="0" {{ !$sub_category->status ? 'selected':'' }}>Inactive</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow">
                    Update Sub Category
                </button>
            </div>

        </form>
    </div>

</div>
@endsection