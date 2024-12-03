<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Latest Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Latest Posts</h1>

        @if ($posts->count())
            <div class="space-y-6">
                @foreach ($posts as $post)
                    <div class="border-b pb-4">
                        <h2 class="text-xl font-semibold text-indigo-600 hover:underline">
                            <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="text-gray-700 mt-2">
                            {{ Str::limit($post->content, 150) }}
                        </p>
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @else
            <p class="text-gray-500 text-center">No posts available.</p>
        @endif
    </div>
</x-app-layout>