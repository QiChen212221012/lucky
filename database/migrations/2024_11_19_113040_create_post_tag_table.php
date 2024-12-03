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
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id(); // 主键
            $table->foreignId('post_id') // 外键关联 posts 表
                ->constrained('posts')
                ->onDelete('cascade'); // 级联删除
            $table->foreignId('tag_id') // 外键关联 tags 表
                ->constrained('tags')
                ->onDelete('cascade'); // 级联删除
            $table->timestamps(); // 创建和更新时间
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag'); // 删除表
    }
};
