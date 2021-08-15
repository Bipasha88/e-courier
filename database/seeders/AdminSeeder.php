<?php

namespace Database\Seeders;

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
            "name" => "Admin",
            "email" => "admin@gmail.com",
            "password" => bcrypt("123456"),
            "address" => "Dhaka",
            "city" => "Dhaka",
            "zone" => "Dhaka",
            "phone" => " ",
            "role" => "1",
            "status" => "1",
        ]);
    }
}
