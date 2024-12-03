<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Popular Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-4">Popular Posts</h1>

        @if ($popularPosts->count())
            <div class="space-y-6">
                @foreach ($popularPosts as $post)
                    <div class="border-b pb-4">
                        <h2 class="text-xl font-semibold text-indigo-600 hover:underline">
                            <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="text-gray-600 text-sm">
                            By {{ $post->user->name ?? 'Unknown Author' }} | {{ $post->created_at->format('M d, Y') }}
                        </p>
                        <p class="text-gray-700 mt-2">
                            {{ Str::limit($post->content, 150) }}
                        </p>
                        <a href="{{ route('post.show', $post->id) }}" class="mt-2 inline-block text-blue-600 hover:underline">
                            Read More
                        </a>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $popularPosts->links('pagination::tailwind') }}
            </div>
        @else
            <p class="text-gray-500 text-center">No popular posts available.</p>
        @endif
    </div>
</x-app-layout>
