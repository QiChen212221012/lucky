<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    // 发布评论
    public function store(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|max:1000', // 评论内容限制为 1000 字
            'post_id' => 'required|exists:posts,id', // 必须存在对应的帖子 ID
        ]);

        // 创建评论
        Comment::create([
            'content' => $validated['content'],
            'post_id' => $validated['post_id'],
            'user_id' => auth()->id(), // 当前用户 ID
        ]);

        return back()->with('success', 'Comment added successfully!');
    }

    // 喜欢评论
    public function like($id)
    {
        $comment = Comment::findOrFail($id);
        $userId = auth()->id();

        // 检查用户是否已经点赞过
        $existingLike = $comment->likes()->where('user_id', $userId)->first();

        if ($existingLike) {
            // 如果已点赞，则取消点赞
            $existingLike->delete();
            $comment->decrement('likes_count'); // 点赞数减 1
            return back()->with('success', 'You unliked the comment.');
        } else {
            // 如果未点赞，则添加点赞
            $comment->likes()->create(['user_id' => $userId]);
            $comment->increment('likes_count'); // 点赞数加 1
            return back()->with('success', 'You liked the comment.');
        }
    }

    // 举报评论
    public function report($id)
    {
        $comment = Comment::findOrFail($id);

        // 如果评论未被举报，则更新为已举报
        if (!$comment->is_reported) {
            $comment->update([
                'is_reported' => true, // 标记为已举报
                'is_reviewed' => false, // 设置为未审核
            ]);

            return back()->with('success', 'Comment reported successfully and will be reviewed by admin.');
        }

        return back()->with('info', 'This comment has already been reported.');
    }

    // 删除评论
    public function destroy($id)
    {
        $comment = Comment::findOrFail($id); // 找到评论
        $this->authorize('delete', $comment); // 权限检查（确保只有管理员或评论所有者可以删除）
    
        $comment->delete(); // 删除评论
    
        return back()->with('success', 'Comment deleted successfully!');
    }
}
