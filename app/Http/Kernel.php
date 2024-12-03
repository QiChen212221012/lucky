<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // 处理可信主机
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class, // 处理代理服务器请求
        \Illuminate\Http\Middleware\HandleCors::class, // 处理跨域请求
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class, // 维护模式检查
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class, // 验证 POST 请求大小
        \App\Http\Middleware\TrimStrings::class, // 清理空格
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class, // 将空字符串转换为 NULL
    ];

    /**
     * The application's route middleware groups.
     *
     * 中间件分组，方便管理和应用。
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class, // 加密 Cookies
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class, // 添加队列 Cookies
            \Illuminate\Session\Middleware\StartSession::class, // 开启 Session
            \Illuminate\View\Middleware\ShareErrorsFromSession::class, // 共享 Session 错误
            \App\Http\Middleware\VerifyCsrfToken::class, // 验证 CSRF Token
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // 替代路由绑定
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \Illuminate\Routing\Middleware\ThrottleRequests::class . ':api', // 限流
            \Illuminate\Routing\Middleware\SubstituteBindings::class, // 替代路由绑定
        ],
    ];

    /**
     * The application's middleware aliases.
     *
     * Aliases may be used instead of class names to conveniently assign middleware to routes and groups.
     * 别名用于简化中间件的调用和配置。
     *
     * @var array<string, class-string|string>
     */
    protected $middlewareAliases = [
        'auth' => \App\Http\Middleware\Authenticate::class, // 身份验证
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class, // 基本身份验证
        'auth.session' => \Illuminate\Session\Middleware\AuthenticateSession::class, // 会话身份验证
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class, // 设置缓存头
        'can' => \Illuminate\Auth\Middleware\Authorize::class, // 授权检查
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class, // 已登录用户重定向
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class, // 密码确认
        'precognitive' => \Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests::class, // 预感性请求处理
        'signed' => \App\Http\Middleware\ValidateSignature::class, // 签名验证
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class, // 请求限流
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class, // 确保电子邮件已验证
        'isAdmin' => \App\Http\Middleware\IsAdmin::class, // 自定义管理员权限验证中间件
    ];
}
