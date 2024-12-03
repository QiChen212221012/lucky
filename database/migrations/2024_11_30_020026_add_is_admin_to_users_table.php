<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 在 users 表中添加 is_admin 字段，用于标识用户是否为管理员。
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // 添加 is_admin 字段，类型为布尔值，默认值为 false，放置在 password 字段后面
            $table->boolean('is_admin')
                ->default(false)
                ->after('password')
                ->comment('标识用户是否为管理员');
        });
    }

    /**
     * Reverse the migrations.
     * 删除 is_admin 字段。
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('is_admin'); // 回滚时删除 is_admin 字段
        });
    }
};
