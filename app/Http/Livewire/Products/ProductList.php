<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;

class ProductList extends Component
{
    public $products;

    /* on components initial render
    get all Products */
    public function mount()
    {
        $this->products = Product::all();
    }
    public function render()
    {
        return view('livewire.products.product-list');
    }
}
