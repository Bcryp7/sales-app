<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $categories = [

            [
                'name' => 'Category 1',
                'description' => 'Just a description for Category 1.',
                'status' => 1
            ],
            [
                'name' => 'Category 2',
                'description' => 'Just a description for Category 2.',
                'status' => 1
            ],
            [
                'name' => 'Category 3',
                'description' => 'Just a description for Category 3.',
                'status' => 0
            ],
            [
                'name' => 'Category 4',
                'description' => 'Just a description for Category 4.',
                'status' => 0
            ]

        ];

        App\Category::insert($categories);

    }
}
