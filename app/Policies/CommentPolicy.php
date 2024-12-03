<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\User;

class CommentPolicy
{
    /**
     * 判断用户是否可以删除评论
     */
    public function delete(User $user, Comment $comment)
    {
        // 允许管理员或评论的创建者删除评论
        return $user->is_admin || $user->id === $comment->user_id;
    }
}
