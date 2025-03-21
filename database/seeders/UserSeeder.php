<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::Create([
            "name"=> "user1",
            "email"=> "user1@gmail.com",
            "password"=> bcrypt("123123123"),
        ]);
        User::Create([
            "name"=> "user2",
            "email"=> "user2@gmail.com",
            "password"=> bcrypt("123123123"),
        ]);
        User::Create([
            "name"=> "user3",
            "email"=> "user3@gmail.com",
            "password"=> bcrypt("123123123"),
        ]);
    }
}
