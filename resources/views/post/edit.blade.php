<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Edit Post</h1>

        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <!-- Post Title -->
            <div class="form-group">
                <label for="title" class="block font-medium text-gray-700">Post Title</label>
                <input type="text" id="title" name="title" 
                       class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       value="{{ old('title', $post->title) }}" required>
            </div>

            <!-- Post Content -->
            <div class="form-group">
                <label for="content" class="block font-medium text-gray-700">Post Content</label>
                <textarea id="content" name="content" rows="5" 
                          class="form-control mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                          required>{{ old('content', $post->content) }}</textarea>
            </div>

            <!-- Post Image -->
            <div class="form-group">
                <label for="image" class="block font-medium text-gray-700">Post Image</label>
                <input type="file" id="image" name="image" 
                       class="form-control mt-1 block w-full text-gray-600 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                
                @if ($post->image)
                    <div class="mt-4">
                        <p class="text-sm text-gray-500">Current Image:</p>
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Post Image" class="max-w-xs rounded-md shadow-md">
                    </div>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="submit" 
                        class="px-6 py-2 bg-indigo-600 text-white font-semibold rounded-md shadow-md hover:bg-indigo-700 transition-all">
                    Update Post
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
