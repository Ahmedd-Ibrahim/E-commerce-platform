<?php
namespace Tests\Unit\Models\Categories;

use App\Models\Category;
use Illuminate\Support\Collection;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    public function test_create_category()
    {
        $category = Category::factory()->createOne();

        $this->assertInstanceOf(Category::class, $category);
    }

    public function test_it_has_many_children()
    {
        $category = Category::factory()->hasChildren(5)->create();

        $this->assertInstanceOf(Collection::class, $category->children);
    }
}
