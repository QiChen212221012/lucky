<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // 计划任务：每天凌晨 1 点运行用户密码重加密命令
        $schedule->command('users:rehash-passwords')->dailyAt('01:00');
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        // 加载 Artisan 命令
        $this->load(__DIR__.'/Commands');

        // 包含自定义的 Artisan 路由文件
        require base_path('routes/console.php');
    }
}
