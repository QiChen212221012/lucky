@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 页面标题 -->
    <h1 class="page-title">Tag Cloud</h1>

    <!-- 标签云显示区域 -->
    <div class="tag-cloud">
        @foreach ($tags as $tag)
            <a href="{{ route('tags.show', $tag->id) }}" 
               class="tag" 
               style="font-size: {{ 12 + $tag->posts_count * 2 }}px;">
                {{ $tag->name }}
            </a>
        @endforeach
    </div>

    <!-- 可选：显示没有标签的提示 -->
    @if ($tags->isEmpty())
        <p class="no-tags">No tags available at the moment.</p>
    @endif
</div>
@endsection
