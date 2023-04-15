<?php

namespace App\Http\Livewire\Products;

use App\Models\Product;
use Livewire\Component;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;
use Illuminate\Support\Facades\Auth;
use Junges\Kafka\Contracts\KafkaConsumerMessage;

class ProductItem extends Component
{
    public $product;

   /*  add to cart button click
    handler */
    public function addToCart()
    {

        if (!Auth::user()) {
            return redirect(route('login'));
        }
        $this->addCartKafkaProducer();
    }

    /* create a message for cart_items
    using kafka when addCart is clicked */
    public function addCartKafkaProducer()
    {
        $message = new Message(

            body: [
                'user_id' => auth()->id(),
                'product_id' => $this->product->id,
            ],
        );
        $producer =  Kafka::publishOn('cart_items')
            ->withConfigOptions([
                'compression.codec' => 'snappy',
            ])
            ->withMessage($message)
            ->withDebugEnabled(true); // Also to disable debug mode;

        $producer->send();


    }

    public function mount($product)
    {
        $this->product = $product;
    }
    public function render()
    {
        return view('livewire.products.product-item');
    }
}
