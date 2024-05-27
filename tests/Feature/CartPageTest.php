<?php

namespace Tests\Feature\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\CartPage;
use Livewire\Livewire;
use Mockery;
use Tests\TestCase;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartPageTest extends TestCase
{
    use RefreshDatabase;

    protected $cartItems;

    protected function setUp(): void
    {
        parent::setUp();

        // Datos simulados de elementos en el carrito
        $this->cartItems = [
            [
                'product_id' => 1, 
                'name' => 'Producto 1', 
                'price' => 100, 
                'quantity' => 1, 
                'unit_amount' => 100, 
                'total_amount' => 100,
                'image' => 'producto1.jpg'
            ],
            [
                'product_id' => 2, 
                'name' => 'Producto 2', 
                'price' => 200, 
                'quantity' => 2, 
                'unit_amount' => 200, 
                'total_amount' => 400,
                'image' => 'producto2.jpg'
            ],
        ];

        // Mock de CartManagement para simular las funciones
        $cartManagementMock = Mockery::mock('alias:App\Helpers\CartManagement');
        $cartManagementMock->shouldReceive('getCartItemsFromCookie')
            ->andReturn($this->cartItems);
        $cartManagementMock->shouldReceive('calculateGrandTotal')
            ->andReturn(500);
        $cartManagementMock->shouldReceive('removeCartItem')
            ->andReturn(array_slice($this->cartItems, 1));
        $cartManagementMock->shouldReceive('incrementItemQuantity')
            ->andReturn(array_merge($this->cartItems, [['product_id' => 1, 'name' => 'Producto 1', 'price' => 100, 'quantity' => 2, 'unit_amount' => 100, 'total_amount' => 200, 'image' => 'producto1.jpg']]));
        $cartManagementMock->shouldReceive('decrementItemQuantity')
            ->andReturn(array_slice($this->cartItems, 0, 1));
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test 001 - Verifica que se inicializa correctamente el carrito */
    public function test001VerificaInicializacionDelCarrito()
    {
        Livewire::test(CartPage::class)
            ->assertSet('cart_items', $this->cartItems)
            ->assertSet('grand_total', 500);
    }

    /** @test 002 - Verifica que se puede eliminar un elemento del carrito */
    public function test002VerificaEliminacionDeElementoDelCarrito()
    {
        Livewire::test(CartPage::class)
            ->call('removeItem', 1)
            ->assertSet('cart_items', array_slice($this->cartItems, 1))
            ->assertSet('grand_total', 500);
    }

    /** @test 003 - Verifica que se puede incrementar la cantidad de un elemento */
    public function test003VerificaIncrementoDeCantidadDeElemento()
    {
        Livewire::test(CartPage::class)
            ->call('increaseQty', 1)
            ->assertSet('cart_items', array_merge($this->cartItems, [['product_id' => 1, 'name' => 'Producto 1', 'price' => 100, 'quantity' => 2, 'unit_amount' => 100, 'total_amount' => 200, 'image' => 'producto1.jpg']]))
            ->assertSet('grand_total', 500);
    }

    /** @test 004 - Verifica que se puede disminuir la cantidad de un elemento */
    public function test004VerificaDisminucionDeCantidadDeElemento()
    {
        Livewire::test(CartPage::class)
            ->call('decreaseQty', 2)
            ->assertSet('cart_items', array_slice($this->cartItems, 0, 1))
            ->assertSet('grand_total', 500);
    }
}
