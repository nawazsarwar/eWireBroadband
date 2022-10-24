<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'username'       => 'administrator',
                'name'           => 'Administrator',
                'email'          => 'intelsharp@gmail.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id'             => 2,
                'username'       => 'sultan',
                'name'           => 'Sultan',
                'email'          => 'sultan@intelsharp.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'id'             => 3,
                'username'       => 'anjali',
                'name'           => 'Anjali Gautam',
                'email'          => 'anjali@intelsharp.com',
                'password'       => bcrypt('password'),
                'remember_token' => null,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];

        User::insert($users);
    }
}
