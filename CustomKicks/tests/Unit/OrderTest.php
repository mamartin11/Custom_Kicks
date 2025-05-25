<?php

namespace Tests\Unit;

use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use App\Models\Product;
use App\Models\Customization;
use Tests\RefreshDatabaseWithoutVacuum;
use Tests\TestCase;
use Illuminate\Http\Request;

class OrderTest extends TestCase
{
    use RefreshDatabaseWithoutVacuum;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('migrate:fresh');
    }

    public function test_order_attributes()
    {
        $order = new Order();
        
        // Probar setters y getters básicos
        $order->setTotal(150000);
        $this->assertEquals(150000, $order->getTotal());

        $order->setOrderDate('2024-03-20');
        $this->assertEquals('2024-03-20', $order->getOrderDate());

        // Probar detalles del pedido
        $details = [
            'shipping_address' => 'Calle Principal 123',
            'payment_method' => 'credit_card'
        ];
        $order->setDetails($details);
        $this->assertEquals($details, $order->getDetails());

        // Probar estado del pedido
        $order->setStatus('processing');
        $this->assertEquals('processing', $order->getStatus());
    }

    public function test_order_validation()
    {
        $request = new Request([
            'total' => 150000,
            'order_date' => '2024-03-20',
            'user_id' => 1
        ]);

        $this->assertTrue(Order::validate($request));
    }

    public function test_order_validation_fails()
    {
        $request = new Request([
            'total' => 'no-es-un-numero',
            'order_date' => 'fecha-invalida',
            'user_id' => 'no-es-un-numero'
        ]);

        $this->expectException(\Illuminate\Validation\ValidationException::class);
        Order::validate($request);
    }

    public function test_order_relationships()
    {
        // Crear usuario
        $user = User::factory()->create();
        
        // Crear producto de prueba
        $product = Product::create([
            'name' => 'Test Product',
            'price' => 75000,
            'description' => 'Test Description',
            'brand' => 'Test Brand',
            'size' => 42.5,
            'quantity' => 10,
            'image' => 'test-image.jpg'
        ]);

        // Crear customización de prueba
        $customization = Customization::create([
            'color' => 'Red',
            'design' => 'Abstract',
            'pattern' => 'Geometric',
            'image' => 'customization-image.jpg'
        ]);
        
        // Verificar que el producto se haya creado correctamente
        echo "Product ID: " . $product->id . "\n";
        $this->assertDatabaseHas('products', ['id' => $product->id]);
        $this->assertNotNull($product->id, 'El producto no se creó correctamente.');
        
        // Crear orden
        $order = Order::create([
            'total' => 150000,
            'order_date' => '2024-03-20',
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        // Verificar relación con usuario
        $this->assertInstanceOf(User::class, $order->user);
        $this->assertEquals($user->id, $order->user->id);

        // Crear items para la orden
        $item = Item::create([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'customization_id' => $customization->id,
            'quantity' => 2,
            'price' => 75000,
            'subtotal' => 150000
        ]);

        // Verificar relación con items
        $this->assertInstanceOf(Item::class, $order->items->first());
        $this->assertEquals($item->id, $order->items->first()->id);
    }

    public function test_mark_as_completed()
    {
        // Crear usuario
        $user = User::factory()->create();

        $order = Order::create([
            'total' => 150000,
            'order_date' => '2024-03-20',
            'user_id' => $user->id,
            'status' => 'pending'
        ]);

        $order->markAsCompleted();
        $this->assertEquals('completed', $order->getStatus());
    }
} 