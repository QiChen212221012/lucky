<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    // 可批量赋值的字段
    protected $fillable = [
        'name',
        'email',
        'password',
        'is_admin',
    ];

    // 隐藏的字段
    protected $hidden = [
        'password',
        'remember_token',
    ];

    // 自动转换的字段类型
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * 定义与帖子的关系 (一对多关系)
     * 一个用户有多个帖子
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * 定义与评论的关系 (一对多关系)
     * 一个用户有多个评论
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * 检查用户是否为管理员
     * @return bool
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * 获取用户最新的帖子
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function latestPosts($limit = 5)
    {
        return $this->posts()->latest()->take($limit)->get();
    }

    /**
     * 获取用户收到的评论 (通过帖子)
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function receivedComments()
    {
        return Comment::whereIn('post_id', $this->posts()->pluck('id'))->get();
    }

    /**
     * 获取用户的角色描述
     * @return string
     */
    public function getRoleDescriptionAttribute()
    {
        return $this->isAdmin() ? 'admin' : 'Ordinary user';
    }

    /**
     * 设置密码时自动加密
     * @param string $password
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    public function likes()
{
    return $this->hasMany(Like::class);
}

}
