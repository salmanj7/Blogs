<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <a href="{{ route('blog.create') }}" class="text-blue-500">Create a Post</a>
        </div>
    </x-slot>
    @foreach ($blogs as $blog)
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg flex justify-between items-center">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('detail', ['blog' => $blog->id]) }}">
                        {{ $blog->name }}
                    </a>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <a href="{{ route('edit', ['blog' => $blog->id]) }}" class="text-blue-500 mr-2">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('destroy', ['blog' => $blog->id]) }}" method="post" onsubmit="return confirm('Are you sure you want to delete this blog?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500">
                            <i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach


  
</x-app-layout>
