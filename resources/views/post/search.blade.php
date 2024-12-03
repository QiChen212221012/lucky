<x-app-layout>
    <div style="background: linear-gradient(to bottom, #ffffff, #e0f7fa); min-height: 100vh; padding: 20px;">
        <div class="container my-5">
            <!-- Search Bar -->
            <div class="text-center mb-4">
                <!-- 搜索框 -->
                <form action="{{ route('post.search') }}" method="GET" style="display: flex; justify-content: center; gap: 10px;">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Enter keywords to search..." 
                           style="width: 60%; padding: 10px 15px; font-size: 16px; border: 1px solid #ccc; border-radius: 30px; box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);">
                    <button type="submit" 
                            style="padding: 10px 20px; font-size: 16px; font-weight: bold; 
                                   color: #fff; background: linear-gradient(to right, #28a745, #218838); 
                                   border: none; border-radius: 30px; cursor: pointer; transition: all 0.3s ease;">
                        Search
                    </button>
                </form>
            </div>

            <!-- Back to Home Button -->
            <div class="text-center mb-4">
                <!-- 返回主页按钮 -->
                <a href="{{ route('post.manage') }}" 
                   style="display: inline-block; padding: 12px 25px; font-size: 16px; font-weight: bold; 
                          color: #fff; background: linear-gradient(to right, #28a745, #218838); 
                          border-radius: 30px; text-decoration: none; transition: all 0.3s ease; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
                   <i class="fas fa-home" style="margin-right: 8px;"></i> Back to Explore
                </a>
            </div>

            <!-- Search Results Title -->
            <h1 class="text-center mb-5" style="font-size: 2.5rem; color: #00695c;">
                @if(!empty($searchQuery))
                    <!-- 如果有关键词 -->
                    Results for "<span style="color: #28a745;">{{ $searchQuery }}</span>"
                @else
                    <!-- 如果没有关键词 -->
                    Showing all results
                @endif
            </h1>

            @if($posts->count())
            <!-- Blog Post Cards -->
            <div class="row g-4">
                @foreach($posts as $post)
                <div class="col-md-6 col-lg-4">
                    <div style="border-radius: 10px; overflow: hidden; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); background: #ffffff; height: 100%; transition: transform 0.3s ease;">
                        @if($post->image)
                        <!-- 博客图片 -->
                        <img src="{{ asset('storage/' . $post->image) }}" 
                             style="width: 100%; height: auto; display: block;" 
                             alt="{{ $post->title }}">
                        @endif
                        <div style="padding: 20px; display: flex; flex-direction: column; height: 100%;">
                            <h5 style="font-size: 1.25rem; color: #333; margin-bottom: 10px;">
                                <a href="{{ route('post.show', $post->id) }}" style="text-decoration: none; color: inherit;">
                                    <!-- 高亮关键词 -->
                                    {!! str_ireplace($searchQuery, "<span style='color: #28a745;'>$searchQuery</span>", $post->title) !!}
                                </a>
                            </h5>
                            <p style="flex-grow: 1; color: #555; margin-bottom: 15px;">
                                <!-- 预览内容 -->
                                {!! str_ireplace($searchQuery, "<span style='color: #28a745;'>$searchQuery</span>", \Illuminate\Support\Str::words($post->content, 20, '...')) !!}
                                <a href="{{ route('post.show', $post->id) }}" style="color: #28a745; text-decoration: underline;">Read more</a>
                            </p>
                            <small style="color: #777;">
                                By {{ $post->user->name ?? 'Unknown' }} | {{ $post->created_at->format('M d, Y') }}
                            </small>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $posts->links('pagination::bootstrap-4') }}
            </div>
            @else
            <!-- No Results Found -->
            <div style="background: #f8d7da; color: #842029; padding: 20px; border-radius: 10px; text-align: center; border: 1px solid #f5c2c7;">
                <h4 style="margin-bottom: 10px;">No results found for "<span style="color: #842029;">{{ $searchQuery }}</span>"</h4>
                <p>Try searching with different keywords or explore our <a href="{{ route('home') }}" style="color: #842029; text-decoration: underline;">home page</a>.</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>
