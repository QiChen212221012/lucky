<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Comments Management') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6">All Comments</h1>

        <!-- All Comments Section -->
        @if(isset($comments) && $comments->count())
            <table class="w-full bg-white border rounded-lg mb-8">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 text-left">Comment</th>
                        <th class="p-4 text-left">Author</th>
                        <th class="p-4 text-left">Post Title</th>
                        <th class="p-4 text-left">Status</th>
                        <th class="p-4 text-left">Posted At</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comments as $comment)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-4">{{ $comment->content }}</td>
                            <td class="p-4">{{ $comment->user->name ?? 'Unknown' }}</td>
                            <td class="p-4">{{ $comment->post->title ?? 'Unknown Post' }}</td>
                            <td class="p-4">
                                @if($comment->is_reported)
                                    <span class="text-red-500">Reported</span>
                                @else
                                    <span class="text-green-500">Normal</span>
                                @endif
                            </td>
                            <td class="p-4">{{ $comment->created_at->format('M d, Y H:i') }}</td>
                            <td class="p-4 text-center">
                                <!-- Delete Comment -->
                                <form action="{{ route('admin.deleteComment', $comment->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">
                                        <span class="material-icons"></span> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination -->
            {{ $comments->links() }}
        @else
            <p class="text-gray-500">No comments found.</p>
        @endif
    </div>
</x-admin-layout>
