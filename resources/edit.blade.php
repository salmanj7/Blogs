<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Blog: {{ $blog->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('update', ['blog' => $blog->id]) }}" method="post">
                        @csrf
                        @method('PUT')
                        
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Name:</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $blog->name) }}" class="mt-1 p-2 w-full border rounded-md">
                        </div>

                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Content:</label>
                            <textarea name="content" id="content" class="mt-1 p-2 w-full border rounded-md">{{ old('content', $blog->content) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label for="author" class="block text-sm font-medium text-gray-700">Author:</label>
                            <input type="text" name="author" id="author" value="{{ old('author', $blog->author) }}" class="mt-1 p-2 w-full border rounded-md">
                        </div>

                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md">Update Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
