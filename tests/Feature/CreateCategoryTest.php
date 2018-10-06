<?php

namespace Tests\Feature;

use App\Category;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateCategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_create_category()
    {

        $this->createCategory($this->getCategoryData());

        $this->assertEquals(1, Category::count());

        $this->assertDatabaseHas('categories', $this->getCategoryData());

    }

    /** @test */
    public function name_is_required()
    {
        $this->createCategory(['name' => null])
             ->assertJsonValidationErrors('name');
    }

    /** @test */
    public function name_must_be_string()
    {
        $this->createCategory(['name' => 1])
             ->assertJsonValidationErrors('name');
    }

    /** @test */
    public function name_must_be_unique()
    {
        $category = factory(Category::class)->create();

        $this->createCategory(['name' => $category->name])
             ->assertJsonValidationErrors('name');
    }

    /** @test */
    public function description_is_not_required()
    {
        $this->createCategory()
             ->assertJsonMissingValidationErrors('description');
    }

    /** @test */
    public function description_must_be_string()
    {
        $this->createCategory(['description' => 1])
             ->assertJsonValidationErrors('description');
    }

    /** @test */
    public function description_cannot_be_more_then_255_chars_long()
    {
        $this->createCategory(['description' => str_repeat('a', 256)])
             ->assertJsonValidationErrors('description');
    }

    protected function createCategory($overrides = [])
    {
        return $this->postJson('api/categories', $overrides);
    }
}
