<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    // 指定可批量赋值的字段
    protected $fillable = ['name'];

    // 如果表名不同于模型默认的复数形式，需要明确指定
    protected $table = 'tags';

    /**
     * 定义与帖子的多对多关系
     * 一个标签可以关联多个帖子
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id')
                    ->withTimestamps();
    }

    /**
     * 获取标签的文章数量（用于标签云显示）
     * 添加动态属性 post_count
     * 
     * @return int
     */
    public function getPostCountAttribute()
    {
        return $this->posts()->count();
    }

    /**
     * 用于根据帖子筛选标签
     * 查询与指定帖子的关联标签
     * 
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param int $postId
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeForPost($query, $postId)
    {
        return $query->whereHas('posts', function ($query) use ($postId) {
            $query->where('post_id', $postId);
        });
    }
}
