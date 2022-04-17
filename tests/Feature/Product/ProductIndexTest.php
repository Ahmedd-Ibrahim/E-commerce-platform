<?php
namespace Tests\Feature\Product;

use Tests\TestCase;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductIndexTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_it_product_index_retern_collection()
    {
        $products = Product::factory(5)->create();

        $response = $this->getJson('/api/products');

        $products->each(function ($product) use ($response) {
            $response->assertJsonFragment([
                'id' => $product->id,
                'name' => $product->name,
                'slug' => $product->slug,
                'description' => $product->description,
            ]);
        });
    }

    public function test_it_has_many_categories()
    {
        $product = Product::factory()->hasCategories(5)->create();

        $this->assertInstanceOf(Collection::class, $product->categories);
    }
}
