@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 标签页标题 -->
    <h1 class="page-title">Posts Tagged: "{{ $tag->name }}"</h1>

    <!-- 帖子内容 -->
    @if ($tag->posts->count())
        <div class="post-grid">
            @foreach ($tag->posts as $post)
                <div class="post">
                    <!-- 帖子封面图 -->
                    <img src="{{ $post->image ? asset('storage/' . $post->image) : asset('images/default.jpg') }}" 
                         alt="{{ $post->title }}" 
                         class="post-image">
                         
                    <!-- 帖子标题 -->
                    <h4>{{ $post->title }}</h4>
                    
                    <!-- 帖子作者及时间 -->
                    <p>By {{ $post->user->name }} on {{ $post->created_at->format('M d, Y') }}</p>
                    
                    <!-- 帖子摘要 -->
                    <p>{{ Str::limit($post->content, 150) }}</p>
                    
                    <!-- 阅读更多按钮 -->
                    <a href="{{ route('post.show', $post->id) }}" class="btn read-more-btn">Read More</a>
                </div>
            @endforeach
        </div>
    @else
        <p class="no-posts">No posts found for this tag.</p>
    @endif
</div>
@endsection
