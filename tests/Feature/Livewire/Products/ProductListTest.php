<?php

namespace Tests\Feature\Livewire\Products;

use Tests\TestCase;
use Livewire\Livewire;
use App\Models\Product;
use App\Http\Livewire\Products\ProductList;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductListTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $products =  Product::factory(8)->make();

        $component = Livewire::test(ProductList::class,['products',$products]);

        $component->assertStatus(200);
    }
}
