<?php

namespace App\Policies;

use App\Models\Post;
use App\Models\User;

class PostPolicy
{
    /**
     * 判断用户是否有权限删除帖子。
     */
    public function delete(User $user, Post $post)
    {
        // 允许用户删除自己的帖子或管理员删除帖子
        return $user->id === $post->user_id || $user->is_admin;
    }
}
