<?php

namespace App\Http\Controllers;

use App\Models\Tag;

class TagController extends Controller
{
    /**
     * 显示标签云页面
     * 按关联的帖子数量排序，降序排列
     */
    public function index()
    {
        // 查询标签并附带 posts_count，用于动态字体大小
        $tags = Tag::withCount('posts')
            ->orderBy('posts_count', 'desc')
            ->get();

        return view('tags.index', compact('tags'));
    }

    /**
     * 显示特定标签下的帖子
     * @param int $id
     */
    public function show($id)
    {
        // 查询标签和其关联的帖子
        $tag = Tag::with('posts.user')->findOrFail($id);

        return view('tags.show', compact('tag'));
    }
}
