<?php
namespace Tests\Feature\Categories;

use App\Models\Category;
use Tests\TestCase;

class CategoryIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_return_collection_of_categories()
    {
        $categories = Category::factory(5)->create();
        $response = $this->getJson('api/categories');
        $categories->each(function ($category) use ($response) {
            $response->assertJsonFragment([
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug
            ]);
        });
    }

    public function test_it_return_only_parent_categories()
    {
        $categories = Category::factory(5)->create();
        $response = $this->getJson('api/categories');
        $categories->each(function ($category) use ($response) {
            $response->assertJsonFragment([
                'id' => $category->id,
                'name' => $category->name,
                'slug' => $category->slug,
                'parent_id' => $category->parent_id
            ]);
        });
    }
}
