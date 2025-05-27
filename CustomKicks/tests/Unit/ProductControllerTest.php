<?php

namespace Tests\Unit;

use App\Models\Customization;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    public function test_index_displays_products_without_filters()
    {
        Product::factory()->count(5)->create();

        $response = $this->get(route('product.index'));

        $response->assertOk();
        $response->assertViewIs('products.index');
        $response->assertViewHas('viewData.products', function ($products) {
            return $products->count() === 5;
        });
        $response->assertViewHas('viewData.brands');
    }

    public function test_index_filters_products_with_multiple_parameters()
    {
        Product::factory()->create(['brand' => 'Nike', 'price' => 120, 'size' => 8.0]);
        Product::factory()->create(['brand' => 'Adidas', 'price' => 80, 'size' => 7.0]);
        Product::factory()->create(['brand' => 'Nike', 'price' => 150, 'size' => 8.0]);
        Product::factory()->create(['brand' => 'Nike', 'price' => 150, 'size' => 9.0]);

        $response = $this->get(route('product.index', [
            'brand' => 'Nike',
            'min_price' => 140,
            'max_price' => 160,
            'size' => 8.0,
        ]));

        $response->assertOk();
        $response->assertViewIs('products.index');
        $response->assertViewHas('viewData.products', function ($products) {
            return $products->count() === 1 && $products->first()->price === 150.0 && $products->first()->brand === 'Nike' && $products->first()->size === 8.0;
        });
    }

    public function test_show_displays_existing_product()
    {
        $product = Product::factory()->create();
        Customization::factory()->count(3)->create();

        $response = $this->get(route('product.show', ['id' => $product->getId()]));

        $response->assertOk();
        $response->assertViewIs('products.show');
        $response->assertViewHas('viewData.product', function ($viewProduct) use ($product) {
            return $viewProduct->id === $product->id;
        });
        $response->assertViewHas('viewData.customizations', function ($customizations) {
            return $customizations->count() === 3;
        });
    }

    public function test_show_handles_non_existent_product()
    {
        $response = $this->get(route('product.show', ['id' => 99999]));

        $response->assertStatus(404);
    }
}
