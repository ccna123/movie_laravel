<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table("users")->insert([
            'name' => "admin",
            'email' => "admin@abc.com",
            'role' => "admin",
            'email_verified_at' => now(),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
