<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupportPriority;

class SupportPriorityTableSeeder extends Seeder
{
    public function run()
    {
        $priorities = [
            [
                'name'  => 'Low',
                'status'  => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'  => 'Normal',
                'status'  => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'  => 'High',
                'status'  => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'  => 'Critical',
                'status'  => 1,
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ];

        SupportPriority::insert( $priorities );
    }
}
