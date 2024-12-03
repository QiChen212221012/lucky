<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Posts') }}
        </h2>
    </x-slot>

    <div class="container mx-auto mt-8 p-6 bg-white rounded-lg shadow-lg">
        <!-- 新建帖子按钮 -->
        <div class="text-end mb-4">
            <a href="{{ route('post.create') }}" 
               class="btn btn-primary flex items-center justify-center gap-2">
                ✍️ Create New Post
            </a>
        </div>

        <!-- 帖子列表 -->
        <h1 class="text-2xl font-bold mb-4 text-gray-800">All Posts</h1>
        @if ($posts->count())
            <div class="space-y-6">
                @foreach ($posts as $post)
                    <div class="border-b pb-4">
                        <h2 class="text-xl font-semibold 
                            {{ $loop->iteration % 2 == 0 ? 'text-purple-600' : 'text-blue-600' }}
                            hover:underline transition duration-300">
                            <a href="{{ route('post.show', $post->id) }}">{{ $post->title }}</a>
                        </h2>
                        <p class="text-gray-700 mt-2">
                            {{ Str::limit($post->content, 200, '...') }}
                        </p>

                        <!-- 添加图片显示 -->
                        @if ($post->images->count())
                            <div class="post-images flex gap-2 mt-2">
                                @foreach ($post->images as $image)
                                    <img src="{{ asset('storage/' . $image->path) }}" 
                                         alt="Post Image" 
                                         class="rounded-lg object-cover" 
                                         style="width: 120px; height: 120px; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                                @endforeach
                            </div>
                        @endif

                        <p class="text-sm text-gray-500 mt-1">By {{ $post->user->name }} on {{ $post->created_at->format('Y-m-d') }}</p>

                        <!-- Edit 和 Delete 按钮 -->
                        <div class="flex items-center gap-4 mt-4">
                            @can('update', $post)
                                <a href="{{ route('post.edit', $post->id) }}" 
                                   class="btn-edit flex items-center gap-2">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                            @endcan

                            @can('delete', $post)
                                <form action="{{ route('post.destroy', $post->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this post?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete flex items-center gap-2">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            @endcan
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- 分页 -->
            <div class="mt-6">
                {{ $posts->links('pagination::tailwind') }}
            </div>
        @else
            <p class="text-gray-500 text-center">No posts available.</p>
        @endif

        <!-- 热门帖子 -->
        <h3 class="text-xl font-bold mt-8 mb-4 text-gray-800">🔥 Popular Posts</h3>
        @if ($popularPosts->count())
            <ul class="space-y-4">
                @foreach ($popularPosts as $popularPost)
                    <li class="p-4 bg-gray-100 rounded-lg shadow-md hover:shadow-lg transition duration-300">
                        <a href="{{ route('post.show', $popularPost->id) }}" 
                           class="text-indigo-600 font-medium text-lg hover:underline">
                            ⭐ {{ $popularPost->title }}
                        </a>
                        <span class="text-gray-500 text-sm">({{ $popularPost->comments_count }} comments)</span>
                    </li>
                @endforeach
            </ul>
        @else
            <p class="text-gray-500">No popular posts available.</p>
        @endif

        <!-- 标签 -->
        <h3 class="text-xl font-bold mt-8 mb-4 text-gray-800">Tags</h3>
        @if ($tags->count())
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 1rem;">
                @foreach ($tags as $tag)
                    <div style="
                        position: relative;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        padding: 10px;
                        border: 1px solid #d1d5db;
                        background: #f9fafb;
                        border-radius: 12px;
                        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                        transition: transform 0.3s, box-shadow 0.3s;
                    "
                        onmouseover="this.style.boxShadow='0 4px 8px rgba(0, 0, 0, 0.2)'; this.style.transform='scale(1.05)';"
                        onmouseout="this.style.boxShadow='0 2px 4px rgba(0, 0, 0, 0.1)'; this.style.transform='scale(1)';">
                        <span style="
                            font-size: 14px;
                            font-weight: 500;
                            color: #374151;
                            text-align: center;
                        ">
                            {{ $tag->name }}
                        </span>
                        <span style="
                            position: absolute;
                            top: -5px;
                            right: -5px;
                            background: #3b82f6;
                            color: white;
                            font-size: 12px;
                            font-weight: bold;
                            border-radius: 9999px;
                            padding: 4px 8px;
                            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
                        ">
                            {{ $tag->posts_count }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <p class="text-gray-500">No tags available.</p>
        @endif
    </div>

    <!-- 样式部分 -->
    <style>
        .btn-edit {
            background-color: #22c55e; /* Green background */
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-align: center;
            display: inline-block;
            font-size: 0.875rem;
            font-weight: 600;
            transition: background-color 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-edit:hover {
            background-color: #15803d; /* Darker green on hover */
        }

        .btn-delete {
            background-color: #dc3545; /* Red background */
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            text-align: center;
            display: inline-block;
            font-size: 0.875rem;
            font-weight: 600;
            transition: background-color 0.3s ease-in-out;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .btn-delete:hover {
            background-color: #b02a37; /* Darker red on hover */
        }

        .flex.items-center.gap-4 {
            display: flex;
            align-items: center;
            gap: 1rem;
        }
    </style>
</x-app-layout>
