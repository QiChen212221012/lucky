<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class AdminController extends Controller
{
    /**
     * 显示被举报的评论.
     *
     * @return \Illuminate\View\View
     */
    public function showReports()
    {
        // 获取所有未审核且已举报的评论，并预加载关联的帖子和用户信息
        $reportedComments = Comment::where('is_reviewed', false)
            ->where('is_reported', true)
            ->with(['post', 'user']) // 预加载帖子和用户信息
            ->get();

        // 将数据传递到视图
        return view('admin.reports', compact('reportedComments'));
    }

    /**
     * 标记评论为已审核.
     *
     * @param int $id 评论ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reviewComment($id)
    {
        // 查找指定评论
        $comment = Comment::findOrFail($id);

        // 更新状态
        $comment->is_reviewed = true; // 标记为已审核
        $comment->is_reported = false; // 清除举报状态
        $comment->save();

        // 返回带有成功消息的响应
        return back()->with('success', 'Comment reviewed successfully!');
    }

    /**
     * 删除评论.
     *
     * @param int $id 评论ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteComment($id)
    {
        // 查找指定评论
        $comment = Comment::findOrFail($id);

        // 删除评论
        $comment->delete();

        // 返回带有成功消息的响应
        return back()->with('success', 'Comment deleted successfully!');
    }

    /**
     * 管理仪表盘.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // 统计评论总数和被举报的评论数
        $commentCount = Comment::count(); // 获取评论总数
        $reportedCommentCount = Comment::where('is_reported', true)->count(); // 获取被举报的评论总数

        // 返回仪表盘视图
        return view('admin.dashboard', compact('commentCount', 'reportedCommentCount'));
    }

    /**
     * 管理评论.
     *
     * @return \Illuminate\View\View
     */
    public function manageComments()
    {
        // 分页加载所有评论，预加载用户和帖子信息
        $comments = Comment::with(['post', 'user']) // 预加载帖子和用户信息
            ->paginate(10); // 分页获取所有评论

        // 返回评论管理视图
        return view('admin.comments', compact('comments'));
    }

    /**
     * 举报评论.
     *
     * @param int $id 评论ID
     * @return \Illuminate\Http\RedirectResponse
     */
    public function reportComment($id)
    {
        // 查找指定评论
        $comment = Comment::findOrFail($id);

        // 更新状态为已举报
        $comment->is_reported = true; // 设置为已举报
        $comment->is_reviewed = false; // 设置为未审核
        $comment->save();

        // 返回带有成功消息的响应
        return back()->with('success', 'Comment reported successfully!');
    }
}
