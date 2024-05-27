<?php 
namespace Tests\Feature\Livewire;

use App\Helpers\CartManagement;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class ProductsPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test019VerificarFiltradoYCategorias()
    {
        $user = User::factory()->create();
        $category = Category::factory()->create(['is_active' => 1]);
        $product = Product::factory()->create(['category_id' => $category->id, 'is_active' => 1]);

        $this->actingAs($user);

        Livewire::test('App\Livewire\ProductsPage')
            ->set('selected_categories', [$category->id])
            ->assertSee($product->name)
            ->assertSee(number_format($product->price, 2, ',', '') . ' €');
    }

    /** @test */
    public function test020VerificarFiltradoPorMarca()
    {
        $user = User::factory()->create();
        $brand = Brand::factory()->create(['is_active' => 1]);
        $product = Product::factory()->create(['brand_id' => $brand->id, 'is_active' => 1]);

        $this->actingAs($user);

        Livewire::test('App\Livewire\ProductsPage')
            ->set('selected_brands', [$brand->id])
            ->assertSee($product->name)
            ->assertSee(number_format($product->price, 2, ',', '') . ' €');
    }

    /** @test */
    public function test021VerificarPaginacion()
    {
        $user = User::factory()->create();
        Product::factory()->count(20)->create(['is_active' => 1]);

        $this->actingAs($user);

        Livewire::test('App\Livewire\ProductsPage')
            ->assertSee('Añadir al carrito')
            ->assertDontSee('Página anterior');
    }

    /** @test */
    public function test022AgregarProductoAlCarrito()
    {
        $user = User::factory()->create();
        $product = Product::factory()->create(['is_active' => 1]);

        $this->actingAs($user);

        Livewire::test('App\Livewire\ProductsPage')
            ->call('addToCart', $product->id)
            ->assertDispatched('update-cart-count')
            ->assertSee('Producto añadido al carrito');
    }
}
