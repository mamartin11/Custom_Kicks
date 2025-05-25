<?php

namespace Tests\Unit;

use App\Models\Product;
use Tests\RefreshDatabaseWithoutVacuum;
use Tests\TestCase;
use Illuminate\Http\Request;

class ProductTest extends TestCase
{
    use RefreshDatabaseWithoutVacuum;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    public function test_product_attributes()
    {
        $product = new Product();
        
        // Probar setters y getters
        $product->setName('Nike Air Max');
        $this->assertEquals('Nike Air Max', $product->getName());

        $product->setPrice(99.99);
        $this->assertEquals(99.99, $product->getPrice());

        $product->setDescription('Zapatillas deportivas');
        $this->assertEquals('Zapatillas deportivas', $product->getDescription());

        $product->setBrand('Nike');
        $this->assertEquals('Nike', $product->getBrand());

        $product->setSize(42.5);
        $this->assertEquals(42.5, $product->getSize());

        $product->setQuantity(10);
        $this->assertEquals(10, $product->getQuantity());

        $product->setImage('products/nike-air-max.jpg');
        $this->assertEquals('products/nike-air-max.jpg', $product->getImage());
    }

    public function test_product_validation()
    {
        $request = new Request([
            'name' => 'Nike Air Max',
            'price' => 99.99,
            'description' => 'Zapatillas deportivas',
            'brand' => 'Nike',
            'size' => 42.5,
            'quantity' => 10,
            'image' => null
        ]);

        $this->assertTrue(Product::validate($request));
    }

    public function test_product_validation_fails()
    {
        $request = new Request([
            'name' => '', // Nombre vacío
            'price' => 'no-es-un-numero', // Precio inválido
            'description' => '', // Descripción vacía
            'brand' => '', // Marca vacía
            'size' => 'no-es-un-numero', // Talla inválida
            'quantity' => -1, // Cantidad negativa
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);
        Product::validate($request);
    }
} 