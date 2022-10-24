<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\SupportCategory;

class SupportCategoryTableSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name'      => 'Loss of Signal',
                'status'    => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
            [
                'name'      => 'Technical Support',
                'status'    => 1,
                'created_at'    => now(),
                'updated_at'    => now(),
            ],
        ];

        SupportCategory::insert( $categories );
    }
}
