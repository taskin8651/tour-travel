@extends('layouts.admin')

@section('content')
<div class="p-6 max-w-xl mx-auto">

    <div class="bg-white shadow rounded-xl p-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-6">
            Edit Category
        </h2>

        <form action="{{ route('categories.update',$category->id) }}"
              method="POST"
              class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Category Name
                </label>
                <input type="text" name="name"
                       value="{{ $category->name }}"
                       class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500"
                       required>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Status
                </label>
                <select name="status"
                        class="w-full border-gray-300 rounded-lg shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                    <option value="1" {{ $category->status ? 'selected':'' }}>Active</option>
                    <option value="0" {{ !$category->status ? 'selected':'' }}>Inactive</option>
                </select>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg shadow">
                    Update Category
                </button>
            </div>

        </form>
    </div>

</div>
@endsection