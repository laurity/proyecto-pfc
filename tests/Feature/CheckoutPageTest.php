<?php

namespace Tests\Feature\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\CheckoutPage;
use Livewire\Livewire;
use Mockery;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;
use App\Models\Order;
use App\Models\Address;
use phpmock\phpunit\PHPMock;

class CheckoutPageTest extends TestCase
{
    use RefreshDatabase;
    use PHPMock;

    protected $cartItems;
    protected $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();

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
        $cartManagementMock->shouldReceive('clearCartItemsFromCookie')
            ->andReturnNull();

        // Crear un usuario simulado
        $this->user = User::factory()->create();
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    /** @test 006 - Verifica que se redirige a productos si el carrito está vacío */
    public function test006VerificaQueSeRedirigeAProductosSiElCarritoEstaVacio()
    {
        $getCartItemsFromCookie = $this->getFunctionMock('App\Helpers', 'getCartItemsFromCookie');
        $getCartItemsFromCookie->expects($this->once())->willReturn([]);

        $clearCartItemsFromCookie = $this->getFunctionMock('App\Helpers', 'clearCartItemsFromCookie');
        $clearCartItemsFromCookie->expects($this->once())->willReturn(null);

        Livewire::actingAs($this->user)
            ->test(CheckoutPage::class)
            ->assertStatus(200);
    }

    /** @test 007 - Verifica que se puede realizar un pedido con datos válidos y método de pago 'stripe' */
    public function test007VerificaQueSePuedeRealizarUnPedidoConDatosValidosYMetodoDePagoStripe()
    {
        Livewire::actingAs($this->user)
            ->test(CheckoutPage::class)
            ->set('first_name', 'John')
            ->set('last_name', 'Doe')
            ->set('phone', '123456789')
            ->set('street_address', '123 Main St')
            ->set('city', 'Anytown')
            ->set('province', 'Anystate')
            ->set('postal_code', '12345')
            ->set('payment_method', 'stripe')
            ->call('placeOrder')
            ->assertRedirect('success');

        $this->assertDatabaseHas('orders', [
            'payment_method' => 'stripe',
            'payment_status' => 'paid',
        ]);
    }

    /** @test 008 - Verifica que se puede realizar un pedido con datos válidos y método de pago 'cod' */
    public function test008VerificaQueSePuedeRealizarUnPedidoConDatosValidosYMetodoDePagoCod()
    {
        Livewire::actingAs($this->user)
            ->test(CheckoutPage::class)
            ->set('first_name', 'John')
            ->set('last_name', 'Doe')
            ->set('phone', '123456789')
            ->set('street_address', '123 Main St')
            ->set('city', 'Anytown')
            ->set('province', 'Anystate')
            ->set('postal_code', '12345')
            ->set('payment_method', 'cod')
            ->call('placeOrder')
            ->assertRedirect('success');

        $this->assertDatabaseHas('orders', [
            'payment_method' => 'cod',
            'payment_status' => 'paid',
        ]);
    }

    /** @test 009 - Verifica que la validación falla si falta un campo requerido */
    public function test009VerificaQueLaValidacionFallaSiFaltaUnCampoRequerido()
    {
        Livewire::actingAs($this->user)
            ->test(CheckoutPage::class)
            ->set('first_name', 'John')
            ->set('last_name', 'Doe')
            ->set('phone', '123456789')
            ->set('street_address', '123 Main St')
            ->set('city', 'Anytown')
            ->set('province', 'Anystate')
            ->set('postal_code', '12345')
            ->call('placeOrder')
            ->assertHasErrors(['payment_method' => 'required']);
    }
}
