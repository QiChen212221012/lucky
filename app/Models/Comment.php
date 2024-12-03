<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    // 可填充字段
    protected $fillable = [
        'content', 
        'post_id', 
        'user_id', 
        'is_reviewed', // 是否已审核
        'is_reported', // 是否被举报
        'likes_count'
    ];

    /**
     * 关联帖子
     * 每条评论属于一个帖子
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * 关联用户
     * 每条评论由一个用户创建
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 举报评论功能
     * 标记评论为需审核和已举报
     */
    public function report()
    {
        $this->update([
            'is_reviewed' => false, // 标记为需审核
            'is_reported' => true,  // 标记为已举报
        ]);
    }

    /**
     * 标记评论为已审核
     * 同时清除举报状态
     */
    public function markAsReviewed()
    {
        $this->update([
            'is_reviewed' => true,  // 标记为已审核
            'is_reported' => false, // 清除举报状态
        ]);
    }

    /**
     * 获取创建时间的格式化字符串
     * 用于在前端友好显示
     * 
     * @return string
     */
    public function getFormattedCreatedAtAttribute()
    {
        return $this->created_at->format('M d, Y H:i');
    }

    /**
     * 获取评论摘要
     * 返回内容的前 50 个字符
     * 
     * @return string
     */
    public function getExcerptAttribute()
    {
        return mb_strimwidth($this->content, 0, 50, '...');
    }

    /**
     * 检查用户是否是评论的所有者
     * 
     * @param int $userId 用户 ID
     * @return bool
     */
    public function isOwnedBy($userId)
    {
        return $this->user_id === $userId;
    }

    /**
     * 删除评论的前置操作
     * 可用于处理与删除评论相关的任务（例如日志记录或通知）
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($comment) {
            // 可扩展的删除逻辑，例如记录日志或通知管理员
        });
    }

    /**
     * 关联点赞记录
     * 一条评论可以有多个点赞
     */
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    /**
     * 检查评论是否被举报
     * 
     * @return bool
     */
    public function isReported()
    {
        return $this->is_reported;
    }

    /**
     * 检查评论是否已审核
     * 
     * @return bool
     */
    public function isReviewed()
    {
        return $this->is_reviewed;
    }

    /**
     * 增加点赞数
     */
    public function addLike()
    {
        $this->increment('likes_count');
    }

    /**
     * 减少点赞数
     */
    public function removeLike()
    {
        $this->decrement('likes_count');
    }
}
