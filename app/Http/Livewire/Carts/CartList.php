<?php

namespace App\Http\Livewire\Carts;

use App\Models\User;
use Livewire\Component;
use App\Models\CartItem;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;
use Illuminate\Support\Facades\Auth;

class CartList extends Component
{
    public $items;

    public function mount()
    {
        $this->items = User::find(Auth::id())->carts()->with('product')->get();
    }

    public function CheckOut()
    {
        $items = CartItem::whereUserId(Auth::id())->select('id')->get()->toArray();

        $products = array_map(function($item) {
           return $item['id'];
        },$items);

        $message = new Message(

            body: [
                'user_id' => auth()->id(),
                'products' => $products,
            ],
        );
        $producer =  Kafka::publishOn('checkout')
            ->withConfigOptions([
                'compression.codec' => 'snappy',
            ])
            ->withMessage($message)
            ->withDebugEnabled(true); // Also to disable debug mode;

        $producer->send();

        return redirect(request()->header('Referer'));
    }
    public function render()
    {
        return view('livewire.carts.cart-list');
    }
}
