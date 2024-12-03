<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// 主页路由
Route::get('/', [PostController::class, 'index'])->name('home');

// 仪表板路由
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// 用户资料管理路由
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 帖子管理页面路由
// 新增统一管理帖子页面，整合了帖子列表、热门帖子和标签。
Route::middleware('auth')->group(function () {
    Route::get('/post/manage', [PostController::class, 'manage'])->name('post.manage'); 
});

Route::middleware('auth')->group(function () {
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
});

// 帖子相关路由
Route::middleware('auth')->group(function () {
    Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');
    Route::post('/post', [PostController::class, 'store'])->name('post.store');
    Route::get('/post/create', [PostController::class, 'create'])->name('post.create');
    Route::get('/post/{id}/edit', [PostController::class, 'edit'])->name('post.edit');
    Route::put('/post/{id}', [PostController::class, 'update'])->name('post.update');
    Route::delete('/post/{id}', [PostController::class, 'destroy'])->name('post.destroy');
});

// 热门帖子路由
Route::get('/popular-posts', [PostController::class, 'popular'])->name('posts.popular');

// 评论相关路由
Route::middleware('auth')->group(function () {
    Route::post('/comment', [CommentController::class, 'store'])->name('comment.store');
    Route::post('/comment/{id}/like', [CommentController::class, 'like'])->name('comment.like');
    Route::post('/comment/{id}/report', [CommentController::class, 'report'])->name('comment.report');
    Route::delete('/comment/{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
});

// 标签相关路由
Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
Route::get('/tags/{id}', [TagController::class, 'show'])->name('tags.show');

// 搜索功能路由
Route::get('/search', [PostController::class, 'search'])->name('post.search');

// 管理员路由（受 'auth' 和 'isAdmin' 中间件保护）
Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/comments', [AdminController::class, 'manageComments'])->name('admin.comments');
    Route::get('/admin/reports', [AdminController::class, 'showReports'])->name('admin.reports');
    Route::post('/admin/reports/comments/{id}/review', [AdminController::class, 'reviewComment'])->name('admin.reviewComment');
    Route::delete('/admin/reports/comments/{id}', [AdminController::class, 'deleteComment'])->name('admin.deleteComment');
});

// 关于我们路由
Route::get('/about', function () {
    return view('about');
})->name('about');

// 认证路由
require __DIR__.'/auth.php';
