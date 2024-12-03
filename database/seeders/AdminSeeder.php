<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 's26850814@gmail.com',
            'password' => bcrypt('admin123'),
            'is_admin' => true,
        ]);
    }
}
