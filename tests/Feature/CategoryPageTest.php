<?php

namespace Tests\Feature\Livewire;

use App\Livewire\CategoryPage;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CategoryPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test005SeRenderizaLaPaginaDeCategoriasConCategoriasActivas()
    {
        $category1 = Category::create([
            'name' => 'Champú',
            'is_active' => 1,
        ]);

        $category2 = Category::create([
            'name' => 'Acondicionador',
            'is_active' => 1,
        ]);

        $category3 = Category::create([
            'name' => 'Mascarilla',
            'is_active' => 0,
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Champú',
            'is_active' => 1,
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Acondicionador',
            'is_active' => 1,
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Mascarilla',
            'is_active' => 0,
        ]);

        Livewire::test(CategoryPage::class)
            ->assertSee('Champú')
            ->assertSee('Acondicionador')
            ->assertDontSee('Mascarilla');
    }
}
