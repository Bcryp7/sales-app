<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_visit_categories_index() {

        $this->getJson('api/categories')->assertSuccessful();

    }

    /** @test */
    public function can_create_categories() {

        $this->postJson('api/categories', $this->getCategoryData());

        $this->assertEquals(1, Category::count());

        $this->assertDatabaseHas('categories', $this->getCategoryData());

    }

    /** @test */
    public function can_update_a_category() {

        $category = factory(Category::class)->create();

        $this->put("api/categories/$category->id", [ 'name' => 'Category 1 Updated' ]);

        $cat = Category::find(1);

        $this->assertEquals('Category 1 Updated', $cat->name);

        /** This assertion is unnecessary if we have the assertion above
         *  but wanted to show different ways to check if a record exists
         *  or contains a certain value.
         */
        $this->assertDatabaseHas('categories', [ 'name' => 'Category 1 Updated' ]);

    }

    /** @test */
    public function can_toggle_the_status_of_a_category() {

        $category = factory(Category::class)->create( ['status' => 1] );

        $this->put("api/categories/$category->id/toggle-status");

        $cat = Category::find(1);

        $this->assertEquals(0, $cat->status);

        $this->put("api/categories/$category->id/toggle-status");

        $this->assertEquals(1, $category->status);

    }

    /** @test */
    public function can_get_active_categories() {

        factory(Category::class, 5)->create();

        $response = $this->getJson("api/categories/active");

        $response->assertSuccessful();

        foreach ($response->decodeResponseJson() as $key => $data) {

            foreach ($data as $record) {

                $this->assertEquals(1, $record['status']);

            }

        }

    }
}
