<?php
namespace Tests\Feature\Product;

use App\Models\Product;
use Tests\TestCase;

class ProductShowTest extends TestCase
{
    public function test_it_fails_if_a_product_not_found()
    {
        $response = $this->getJson('api/products/none');

        $response->assertStatus(404);
    }

    public function test_show_product()
    {
        $product = Product::factory()->createOne();

        $response = $this->getJson('api/products/' . $product->id);
        $response->assertJsonFragment([
            'id' => $product->id
        ]);
    }
}
