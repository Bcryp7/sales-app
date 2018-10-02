<?php

use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $articles = [

            [
                'category_id' => 1,
                'code' => '12345',
                'name' => 'Article 1',
                'price' => 10.20,
                'stock' => 10,
                'description' => 'Just a description for Article 1.',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => 2,
                'code' => '54321',
                'name' => 'Article 2',
                'price' => 10.20,
                'stock' => 12,
                'description' => 'Just a description for Article 2.',
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => 3,
                'code' => '32154',
                'name' => 'Article 3',
                'price' => 10.20,
                'stock' => 13,
                'description' => 'Just a description for Article 3.',
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'category_id' => 4,
                'code' => '54123',
                'name' => 'Article 4',
                'price' => 10.20,
                'stock' => 14,
                'description' => 'Just a description for Article 4.',
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ]

        ];

        App\Article::insert($articles);

    }
}
