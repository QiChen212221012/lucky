<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class RehashUserPasswords extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:rehash-passwords';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Rehash all user passwords in the database using bcrypt';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // 从 users 表中获取所有用户
        $users = DB::table('users')->get();

        foreach ($users as $user) {
            // 检查密码是否已经加密
            if (!Hash::needsRehash($user->password)) {
                $this->info("User ID {$user->id} password does not need rehashing.");
                continue;
            }

            // 对密码重新加密并更新数据库
            DB::table('users')
                ->where('id', $user->id)
                ->update(['password' => Hash::make($user->password)]);

            $this->info("Rehashed password for User ID {$user->id}.");
        }

        $this->info('All passwords have been rehashed successfully.');
    }
}
