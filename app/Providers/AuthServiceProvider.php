<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        \App\Models\Comment::class => \App\Policies\CommentPolicy::class,
        \App\Models\Post::class => \App\Policies\PostPolicy::class, // 添加 Post 模型与 PostPolicy 的映射
    ];    

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();

        // 定义全局 Gate 示例（可选）
        Gate::define('admin-access', function ($user) {
            return $user->is_admin;
        });
    }
}
