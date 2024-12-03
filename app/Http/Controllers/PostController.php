<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\PostImage;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // 显示主页帖子列表
    public function index(Request $request)
    {
        // 获取所有帖子并支持搜索功能
        $query = Post::with('user', 'tags', 'images'); // 加载关联图片
        if ($request->has('search')) {
            $query->where('title', 'like', "%{$request->search}%")
                  ->orWhere('content', 'like', "%{$request->search}%");
        }

        // 分页显示帖子列表
        $posts = $query->paginate(10);

        // 获取热门帖子
        $popularPosts = Post::withCount('comments')
                            ->orderBy('comments_count', 'desc')
                            ->take(5)
                            ->get();

        // 获取标签数据
        $tags = Tag::withCount('posts')
                   ->orderBy('posts_count', 'desc')
                   ->get();

        return view('home', compact('posts', 'popularPosts', 'tags'));
    }

    // 显示创建新帖子的表单页面
    public function create()
    {
        // 获取所有标签用于创建帖子时的选择
        $tags = Tag::orderBy('name', 'asc')->get();

        // 返回创建页面并传递标签数据
        return view('post.create', compact('tags'));
    }

    // 存储新帖子
    public function store(Request $request)
    {
        // 验证输入数据
        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'tags' => 'nullable|string', // tags是逗号分隔的字符串
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // 支持多图片上传
        ]);

        // 创建新帖子
        $post = Post::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => auth()->id(),
        ]);

        // 处理标签
        if ($request->filled('tags')) {
            $tagIds = explode(',', $validated['tags']); // 将隐藏字段解析成标签ID数组
            $post->tags()->sync($tagIds); // 使用sync将标签关联到帖子
        }

        // 处理图片上传
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads', 'public'); // 存储图片到 public/uploads 文件夹
                // 将图片信息保存到数据库
                $post->images()->create(['path' => $path]); // 保存路径到数据库
            }
        }

        // 返回成功响应
        return redirect()->route('post.manage')->with('success', 'Post created successfully!');
    }

    // 编辑帖子
    public function edit($id)
    {
        $post = Post::with('images')->findOrFail($id);

        // 确保当前用户有权限编辑帖子
        if (auth()->id() !== $post->user_id && auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Unauthorized access!');
        }

        return view('post.edit', compact('post'));
    }

    // 更新帖子
    public function update(Request $request, $id)
    {
        $post = Post::with('images')->findOrFail($id);

        // 确保当前用户有权限更新帖子
        if (auth()->id() !== $post->user_id && auth()->user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Unauthorized access!');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 更新帖子数据
        $post->update([
            'title' => $validated['title'],
            'content' => $validated['content'],
        ]);

        // 处理图片上传
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $path = $image->store('uploads', 'public');
                $post->images()->create(['path' => $path]);
            }
        }

        return redirect()->route('post.show', $id)->with('success', 'Post updated successfully!');
    }

 // 删除帖子
 public function destroy($id)
 {
     $post = Post::findOrFail($id);

     // 确保当前用户有权限删除帖子
     if (auth()->id() !== $post->user_id) {
         return redirect()->route('home')->with('error', 'Unauthorized access!');
     }

     // 删除关联图片
     foreach ($post->images as $image) {
         Storage::disk('public')->delete($image->path); // 删除图片文件
         $image->delete(); // 删除数据库记录
     }

     // 删除帖子
     $post->delete();

     return redirect()->route('post.manage')->with('success', 'Post deleted successfully!');
 }

    // 获取热门帖子
    public function popular()
    {
        $popularPosts = Post::withCount('comments')
                            ->orderBy('comments_count', 'desc')
                            ->paginate(10);

        return view('post.popular', compact('popularPosts'));
    }

    // 搜索帖子
    public function search(Request $request)
    {
        // Retrieve the search query from the input
        $searchQuery = $request->input('search');
    
        // Create a query builder for Post
        $query = Post::query();
        if (!empty($searchQuery)) {
            // Search in title or content for the query
            $query->where('title', 'LIKE', "%{$searchQuery}%")
                  ->orWhere('content', 'LIKE', "%{$searchQuery}%");
        }
    
        // Paginate the results
        $posts = $query->paginate(10);
    
        // Pass the search query and posts to the view
        return view('post.search', compact('posts', 'searchQuery'));
    }    

    // 显示单个帖子详情
    public function show($id)
    {
        // 查找指定的帖子及相关数据
        $post = Post::with(['user', 'tags', 'comments.user', 'images'])->findOrFail($id);

        // 获取热门帖子以便在详情页显示侧边栏或其他用途
        $popularPosts = Post::withCount('comments')
                            ->orderBy('comments_count', 'desc')
                            ->take(5)
                            ->get();

        // 返回视图，传递帖子及热门数据
        return view('post.show', compact('post', 'popularPosts'));
    }

    // 帖子管理页面
    public function manage(Request $request)
    {
        // 获取所有帖子并支持搜索功能
        $query = Post::with('user', 'tags', 'images'); // 加载关联图片
        if ($request->has('search')) {
            $query->where('title', 'like', "%{$request->search}%")
                  ->orWhere('content', 'like', "%{$request->search}%");
        }

        // 分页显示帖子列表
        $posts = $query->paginate(10);

        // 获取热门帖子
        $popularPosts = Post::withCount('comments')
                            ->orderBy('comments_count', 'desc')
                            ->take(5)
                            ->get();

        // 获取标签数据
        $tags = Tag::withCount('posts')
                   ->orderBy('posts_count', 'desc')
                   ->get();

        return view('post.manage', compact('posts', 'popularPosts', 'tags'));
    }

    // PostController
public function report($id)
{
    // 查找被举报的帖子
    $post = Post::findOrFail($id);

    // 标记为需审核
    $post->is_reviewed = true;

    // 保存更改
    $post->save();

    // 返回成功提示
    return back()->with('success', 'Post reported successfully and is now under review!');
}

}
