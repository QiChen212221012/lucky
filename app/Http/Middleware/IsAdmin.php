<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 检查用户是否已登录
        if (!auth()->check()) {
            // 如果用户未登录，重定向到登录页面
            return redirect()->route('login')->with('error', 'You must log in to access this page.');
        }

        // 检查登录用户是否是管理员
        if (auth()->user()->is_admin) {
            // 如果是管理员，允许继续访问
            return $next($request);
        }

        // 如果不是管理员，显示访问被拒绝的信息并重定向
        return redirect('/')
            ->with('error', 'Access denied. Only administrators can access this page.');
    }
}
