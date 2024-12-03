<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // 可批量赋值的字段
    protected $fillable = ['title', 'content', 'image', 'user_id'];

    /**
     * 定义与用户的关系 (一对多反向关系)
     * 一个帖子属于一个用户
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * 定义与评论的关系 (一对多关系)
     * 一个帖子有多个评论
     */
    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id'); // 指定外键 post_id
    }

    /**
     * 定义与标签的关系 (多对多关系)
     * 通过中间表 post_tag 连接 posts 和 tags
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag', 'post_id', 'tag_id');
    }

    /**
     * Scope: 获取按评论数量排序的热门帖子
     * 用于查询最受欢迎的帖子
     */
    public function scopePopular($query)
    {
        return $query->withCount('comments')->orderBy('comments_count', 'desc');
    }

    /**
     * 添加标签到帖子
     * @param array $tagIds
     */
    public function addTags(array $tagIds)
    {
        $this->tags()->syncWithoutDetaching($tagIds);
    }

    /**
     * 移除帖子关联的标签
     * @param array $tagIds
     */
    public function removeTags(array $tagIds)
    {
        $this->tags()->detach($tagIds);
    }

    /**
     * 检查帖子是否包含指定标签
     * @param int $tagId
     * @return bool
     */
    public function hasTag($tagId)
    {
        return $this->tags()->where('tag_id', $tagId)->exists();
    }

    /**
     * 获取帖子摘要
     * 返回内容的前 100 个字符
     * @return string
     */
    public function getExcerptAttribute()
    {
        return mb_strimwidth($this->content, 0, 100, '...');
    }

    /**
     * 获取与评论计数一起的帖子数据
     * 使用 withCount 加载 comments 的数量
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeWithCommentsCount($query)
    {
        return $query->withCount('comments');
    }

    /**
     * 删除与帖子关联的评论
     * 当帖子被删除时，级联删除评论
     */
    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($post) {
            $post->comments()->delete();
        });
    }

    public function images()
    {
        return $this->hasMany(PostImage::class);
    }

}
