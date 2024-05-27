<?php

namespace Tests\Feature\Livewire;

use Tests\TestCase;
use App\Livewire\HomePage;
use Livewire\Livewire;
use App\Models\Brand;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test013PuedeRenderizarLaPaginaDeInicioConDatosCorrectos()
    {
        // Crear datos de prueba
        $brand1 = Brand::factory()->create(['is_active' => 1]);
        $brand2 = Brand::factory()->create(['is_active' => 1]);
        $category1 = Category::factory()->create(['is_active' => 1]);
        $category2 = Category::factory()->create(['is_active' => 1]);

        Livewire::test(HomePage::class)
            ->call('render')
            ->assertViewHas('brands', function($brands) use ($brand1, $brand2) {
                return $brands->contains($brand1) && $brands->contains($brand2);
            })
            ->assertViewHas('categories', function($categories) use ($category1, $category2) {
                return $categories->contains($category1) && $categories->contains($category2);
            });
    }
}
