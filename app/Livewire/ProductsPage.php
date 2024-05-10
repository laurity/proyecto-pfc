<?php

namespace App\Livewire;

use App\Helpers\CartManagement;
use App\Livewire\Partials\Navbar;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;


#[Title('Tienda - Alonso del rey')]
class ProductsPage extends Component
{
    use LivewireAlert; //Este trait es el que se encarga de mostrar las alertas
    use WithPagination; //Este trait es el que se encarga de la paginación

    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_brands = [];

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;

    #[Url]
    public $price_range = 800;

    #[Url]
    public $sort = 'lastest';

    public function addToCart($product_id)
    {
        $total_count = CartManagement::addItemToCartWithQty($product_id);

        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class); //Esta linea es la que se encarga de enviar el evento al componente Navbar

        $this->alert('success', 'Producto añadido al carrito', [
            'position' => 'bottom-end',
            'timer' => 3000,
            'toast' => true,
           ]);
    }


    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }
        if (!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }
        if ($this->featured) {
            $productQuery->where('is_featured', 1);
        }
        if ($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }

        if ($this->price_range) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }

        if ($this->sort == 'lastest') {
            $productQuery->latest();
        }

        if ($this->sort == 'price') {
            $productQuery->orderBy('price');
        }


        return view('livewire.products-page', [
            'products' => $productQuery->paginate(9), //Esta linea es la que se encarga de paginar los productos
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug'])
        ]);
    }
}