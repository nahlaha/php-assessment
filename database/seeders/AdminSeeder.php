<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'id' => 1,
                'first_name' => 'admin',
                'email' => 'admin@admin.com',
                'password' => '$2y$10$R3t2YvYqeVTC27f9XkVFfeh82QkNXCTNjy7/oLrNXR5REoKgl66FO',
                'role_id' => 1
            ],
        ]);
    }
}
