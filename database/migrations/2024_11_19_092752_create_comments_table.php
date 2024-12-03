<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 创建 comments 表
        Schema::create('comments', function (Blueprint $table) {
            $table->id(); // 主键
            $table->text('content'); // 评论内容
            
            // 外键关联 posts 表
            $table->foreignId('post_id')
                ->constrained('posts') // 指定关联表
                ->onDelete('cascade'); // 如果关联帖子被删除，评论也级联删除
            
            // 外键关联 users 表
            $table->foreignId('user_id')
                ->constrained('users') // 指定关联表
                ->onDelete('cascade'); // 如果关联用户被删除，评论也级联删除
            
            $table->boolean('is_reviewed')->default(false); // 是否已审核，默认为未审核
            $table->integer('likes_count')->default(0); // 点赞次数，默认为 0
            $table->timestamps(); // 创建和更新时间
        });

        // 添加必要的索引以优化查询性能
        Schema::table('comments', function (Blueprint $table) {
            $table->index('post_id'); // 为 post_id 添加索引
            $table->index('user_id'); // 为 user_id 添加索引
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 删除表及索引
        Schema::dropIfExists('comments');
    }
};
