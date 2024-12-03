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
        // 添加 is_reviewed 列到 posts 表
        Schema::table('posts', function (Blueprint $table) {
            if (!Schema::hasColumn('posts', 'is_reviewed')) {
                $table->boolean('is_reviewed')
                    ->default(false)
                    ->comment('Indicates if the post has been reviewed')
                    ->after('content'); // 可选: 指定列位置
            }
        });

        // 添加 is_reviewed 列到 comments 表
        Schema::table('comments', function (Blueprint $table) {
            if (!Schema::hasColumn('comments', 'is_reviewed')) {
                $table->boolean('is_reviewed')
                    ->default(false)
                    ->comment('Indicates if the comment has been reviewed')
                    ->after('content'); // 可选: 指定列位置
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 从 posts 表中删除 is_reviewed 列
        Schema::table('posts', function (Blueprint $table) {
            if (Schema::hasColumn('posts', 'is_reviewed')) {
                $table->dropColumn('is_reviewed');
            }
        });

        // 从 comments 表中删除 is_reviewed 列
        Schema::table('comments', function (Blueprint $table) {
            if (Schema::hasColumn('comments', 'is_reviewed')) {
                $table->dropColumn('is_reviewed');
            }
        });
    }
};
