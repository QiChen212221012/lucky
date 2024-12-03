<x-admin-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Reported Comments Management') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
        <h1 class="text-2xl font-bold mb-6">Reported Comments</h1>

        <!-- Reported Comments Section -->
        @if(isset($reportedComments) && $reportedComments->count())
            <table class="w-full bg-white border rounded-lg mb-8">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-4 text-left">Comment</th>
                        <th class="p-4 text-left">Author</th>
                        <th class="p-4 text-left">Post Title</th>
                        <th class="p-4 text-left">Posted At</th>
                        <th class="p-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportedComments as $comment)
                        <tr class="border-t hover:bg-gray-50">
                            <td class="p-4">{{ $comment->content }}</td>
                            <td class="p-4">{{ $comment->user->name ?? 'Unknown' }}</td>
                            <td class="p-4">{{ $comment->post->title ?? 'Unknown Post' }}</td>
                            <td class="p-4">{{ $comment->created_at->format('M d, Y H:i') }}</td>
                            <td class="p-4 text-center">
                                <!-- Mark as Reviewed -->
                                <form action="{{ route('admin.reviewComment', $comment->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    <button class="px-4 py-2 bg-green-500 text-white rounded-lg hover:bg-green-600 transition duration-200">
                                        <span class="material-icons">Mark as Reviewed</span>
                                    </button>
                                </form>
                                <!-- Delete Comment -->
                                <form action="{{ route('admin.deleteComment', $comment->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600 transition duration-200">
                                        <span class="material-icons">Delete</span>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-gray-500">No reported comments found.</p>
        @endif
    </div>
</x-admin-layout>
