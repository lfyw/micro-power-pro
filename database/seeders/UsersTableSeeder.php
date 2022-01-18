<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'admin',
            'nickname' => '超级管理员',
            'password' => bcrypt('K1ny020ft!'),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
