<?php
namespace Tests\Feature\Livewire;

use App\Helpers\CartManagement;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductDetailPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test015VerificarDetalleProducto()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['slug' => 'producto-ejemplo', 'price' => 99.99]);

        $this->actingAs($user);

        Livewire::test('App\Livewire\ProductDetailPage', ['slug' => $product->slug])
            ->assertSee($product->name)
            ->assertSee(number_format($product->price, 2, ',', '') . ' €')
            ->assertSee($product->description);
    }

    /** @test */
    public function test016IncrementarCantidad()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['slug' => 'producto-ejemplo']);

        $this->actingAs($user);

        Livewire::test('App\Livewire\ProductDetailPage', ['slug' => $product->slug])
            ->set('quantity', 1)
            ->call('increaseQty')
            ->assertSet('quantity', 2);
    }

    /** @test */
    public function test017DisminuirCantidad()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['slug' => 'producto-ejemplo']);

        $this->actingAs($user);

        Livewire::test('App\Livewire\ProductDetailPage', ['slug' => $product->slug])
            ->set('quantity', 2)
            ->call('decreaseQty')
            ->assertSet('quantity', 1);
    }

    /** @test */
    public function test018AgregarAlCarrito()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['slug' => 'producto-ejemplo']);

        $this->actingAs($user);

        Livewire::test('App\Livewire\ProductDetailPage', ['slug' => $product->slug])
            ->set('quantity', 1)
            ->call('addToCart', $product->id)
            ->assertDispatched('update-cart-count')
            ->assertSee('Producto añadido al carrito');
    }
}
