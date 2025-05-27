<?php

namespace Tests\Unit;

use App\Models\Customization;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Session;
use Tests\TestCase;

class CartControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Prueba el método listItems para mostrar los ítems del carrito cuando está vacío.
     *
     * @return void
     */
    public function test_list_items_displays_empty_cart()
    {
        // Asegurarse de que la sesión no tenga ítems en el carrito
        Session::forget('cart_items');

        $response = $this->get(route('cart.list'));

        $response->assertOk();
        $response->assertViewIs('cart.list');
        $response->assertViewHas('viewData.title', 'Your Cart Items');
        $response->assertViewHas('viewData.cartItems', []);
    }

    /**
     * Prueba el método addToCart para agregar un ítem al carrito exitosamente.
     *
     * @return void
     */
    public function test_add_to_cart_adds_item_successfully()
    {
        // Crear un producto y una personalización en la base de datos
        $product = Product::factory()->create([
            'price' => 100.00,
            'name' => 'Sneaker X',
        ]);
        $customization = Customization::factory()->create([
            'color' => 'Black',
            'design' => 'Abstract',
            'pattern' => 'Geometric',
        ]);

        // Asegurarse de que la sesión del carrito esté vacía al inicio del test
        Session::forget('cart_items');

        $response = $this->post(route('cart.add'), [
            'product_id' => $product->getId(),
            'customization_id' => $customization->getId(),
        ]);

        $response->assertRedirect(route('cart.list'));
        $response->assertSessionHas('success', 'Item added to cart successfully.');
        $response->assertSessionHas('selected_color', $customization->getColor());
        $response->assertSessionHas('selected_design', $customization->getDesign());
        $response->assertSessionHas('selected_pattern', $customization->getPattern());

        // Verifica que el ítem se haya agregado a la sesión del carrito
        $cart = Session::get('cart_items');
        $this->assertCount(1, $cart);
        $this->assertEquals($product->getId(), $cart[0]['product_id']);
        $this->assertEquals($customization->getId(), $cart[0]['customization_id']);
        $this->assertEquals($product->getPrice(), $cart[0]['subtotal']);
        $this->assertEquals('Sneaker X', $cart[0]['product_name']);
        $this->assertEquals('Black', $cart[0]['customization']['color']);
    }

    /**
     * Prueba el método removeFromCart para eliminar un ítem del carrito.
     *
     * @return void
     */
    public function test_remove_from_cart_removes_item_successfully()
    {
        // Crear ítems de prueba para el carrito
        $cartItems = [
            [
                'product_id' => 1,
                'product_name' => 'Zapato A',
                'price' => 100,
                'customization_id' => 1,
                'subtotal' => 100,
            ],
            [
                'product_id' => 2,
                'product_name' => 'Zapato B',
                'price' => 150,
                'customization_id' => 2,
                'subtotal' => 150,
            ],
        ];
        Session::put('cart_items', $cartItems);

        // Eliminar el ítem en el índice 0
        $response = $this->delete(route('cart.remove', ['index' => 0]));

        $response->assertRedirect(route('cart.list'));
        $response->assertSessionHas('success', 'Item removed from cart.'); // Corregido el mensaje

        $updatedCart = Session::get('cart_items');
        $this->assertCount(1, $updatedCart);
        $this->assertEquals('Zapato B', $updatedCart[0]['product_name']);
    }
}
