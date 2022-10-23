<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupportStatus;

class SupportStatusTableSeeder extends Seeder
{
    public function run()
    {
        $statuses = [
            [
                'name'  => 'Open',
                'status'  => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'  => 'Pending',
                'status'  => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'  => 'Resolved',
                'status'  => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'  => 'Closed',
                'status'  => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        SupportStatus::insert( $statuses );
    }
}
