<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post Details') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
        <!-- Post Header -->
        <div class="post-header mb-6">
            <h1 class="text-3xl font-bold mb-2">{{ $post->title }}</h1>
            <p class="text-gray-600">
                By <strong>{{ $post->user->name }}</strong> on {{ $post->created_at->format('M d, Y') }}
            </p>
        </div>

<!-- Post Content -->
<div class="post-content mb-6 bg-gray-50 p-6 rounded-lg shadow-lg">
    <p class="text-gray-700 leading-relaxed text-lg" style="line-height: 1.8; word-spacing: 0.1rem;">
        {{ $post->content }}
    </p>
</div>

<!-- 添加图片显示 -->
            @if ($post->images->count())
                <div class="post-images flex justify-center gap-4 mt-4 flex-wrap">
                    @foreach ($post->images as $image)
                        <img src="{{ asset('storage/' . $image->path) }}" 
                             alt="Post Image" 
                             class="rounded-lg object-cover" 
                             style="max-width: 300px; height: auto; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);">
                    @endforeach
                </div>
            @endif
        </div>
        
<!-- Post Tags -->
@if ($post->tags->count())
    <div class="tags mb-6">
        <h4 class="text-lg font-semibold text-gray-800 mb-4">Tags:</h4>
        <div class="flex flex-wrap gap-3">
            @foreach ($post->tags as $tag)
                <a href="{{ route('tags.show', $tag->id) }}" 
                   class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-4 py-2 rounded-full text-sm font-medium shadow-lg hover:from-purple-500 hover:to-blue-500 transition-transform transform hover:scale-105">
                    {{ $tag->name }}
                </a>
            @endforeach
        </div>
    </div>
@endif

        <!-- Comments Section -->
        <div class="comments-section mt-6">
            <h3 class="text-2xl font-bold text-gray-800 mb-4">Comments ({{ $post->comments->count() }})</h3>
            <hr class="mb-6 border-gray-300">
            
            @if ($post->comments->count())
                <div class="space-y-6">
                    @foreach ($post->comments as $comment)
                        <!-- Single Comment -->
                        <div style="background-color: white; padding: 16px; border-radius: 8px; box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb;">
                            <div style="display: flex; justify-content: space-between; align-items: center;">
                                <!-- Comment Author and Timestamp -->
                                <div>
                                    <p style="font-weight: bold; color: #374151; margin: 0;">{{ $comment->user->name }}</p>
                                    <span style="font-size: 14px; color: #6b7280;">{{ $comment->created_at->format('M d, Y H:i') }}</span>
                                </div>
                            </div>
                            <!-- Comment Content -->
                            <p style="margin-top: 12px; color: #374151;">{{ $comment->content }}</p>
                            <!-- Actions: Report, Like, and Delete -->
                            <div style="display: flex; justify-content: flex-end; gap: 12px; margin-top: 8px;">
                                <!-- Like Button -->
                                <form action="{{ route('comment.like', $comment->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @if ($comment->likes->contains('user_id', auth()->id()))
                                        <button type="submit" style="padding: 6px 16px; font-size: 14px; font-weight: 500; color: white; background-color: #d9534f; border: none; border-radius: 6px; cursor: pointer; transition: all 0.3s;">
                                            👎 Unlike ({{ $comment->likes_count }})
                                        </button>
                                    @else
                                        <button type="submit" style="padding: 6px 16px; font-size: 14px; font-weight: 500; color: white; background-color: #22c55e; border: none; border-radius: 6px; cursor: pointer; transition: all 0.3s;">
                                            👍 Like ({{ $comment->likes_count }})
                                        </button>
                                    @endif
                                </form>

<!-- Report Button -->
@if (!$comment->is_reported)
    <form action="{{ route('comment.report', $comment->id) }}" method="POST" style="display: inline;">
        @csrf
        <button type="submit" style="padding: 6px 16px; font-size: 14px; font-weight: 500; color: white; background-color: #f87171; border: none; border-radius: 6px; cursor: pointer; transition: all 0.3s;">
            🚩 Report
        </button>
    </form>
@else
    <span style="color: #9ca3af; font-size: 14px;">Reported and under review</span>
@endif

                                <!-- Delete Button -->
                                @can('delete', $comment)
                                    <form action="{{ route('comment.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this comment?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="padding: 6px 16px; font-size: 14px; font-weight: 500; color: white; background-color: #d9534f; border: none; border-radius: 6px; cursor: pointer; transition: all 0.3s;">
                                            🗑️ Delete
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <!-- No Comments -->
                <p style="text-align: center; color: #6b7280;">No comments yet. Be the first to comment!</p>
            @endif

            <!-- Add Comment Section -->
            @auth
                <div style="margin-top: 24px; padding: 24px; background-color: #f9fafb; border-radius: 8px; border: 1px solid #e5e7eb;">
                    <h4 style="font-size: 18px; font-weight: bold; color: #374151; margin-bottom: 16px;">Leave a Comment</h4>
                    <form action="{{ route('comment.store') }}" method="POST">
                        @csrf
                        <div>
                            <!-- Comment Textarea -->
                            <textarea name="content" rows="4" style="width: 100%; padding: 12px; border: 1px solid #d1d5db; border-radius: 8px; font-size: 14px; resize: none; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);"></textarea>
                            <input type="hidden" name="post_id" value="{{ $post->id }}">
                        </div>
                        <!-- Submit Button -->
                        <button type="submit" style="margin-top: 16px; padding: 12px 24px; font-size: 16px; font-weight: bold; color: white; background-color: #22c55e; border-radius: 8px; border: none; cursor: pointer; transition: background-color 0.3s;">
                            Post Comment
                        </button>
                    </form>
                </div>
            @else
                <!-- Message for Unauthenticated Users -->
                <p style="margin-top: 24px; text-align: center; color: #6b7280;">
                    Please <a href="{{ route('login') }}" style="color: #22c55e; text-decoration: underline;">log in</a> to leave a comment.
                </p>
            @endauth
        </div>
    </div>
</x-app-layout>
