<?php

namespace Tests\Feature\Livewire\Carts;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Product;
use App\Models\CartItem;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Carts\CartList;
use App\Models\Order;
use Junges\Kafka\Message\ConsumedMessage;
use Illuminate\Foundation\Testing\WithFaker;
use Junges\Kafka\Contracts\KafkaConsumerMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CartListTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $this->actingAs(User::factory()->create());
        $component = Livewire::test(CartList::class);

        $component->assertStatus(200);
    }
    /** @test */
    public function test_component_has_cart_list_items()
    {
        $this->actingAs(User::factory()->create());
        Product::factory(8)->create();
        $cartItems = CartItem::factory(3)->create();
        // dd($cartItems);
        $items = User::find(Auth::id())->carts()->with('product')->get()->toArray();
        $component = Livewire::test(CartList::class,['items'=>$items]);
        // dd($items);
        $component->assertPayloadSet('items',$items);
    }
    /** @test */
    public function test_component_user_checkout_calls_producer()
    {
        $this->actingAs(User::factory()->create());
        Product::factory(8)->create();
        $cartItems = CartItem::factory(3)->create();
        // dd($cartItems);
        $items = User::find(Auth::id())->carts()->with('product')->get()->toArray();
        $component = Livewire::test(CartList::class,['items'=>$items]);

        $products = array_map(function($item) {
            return $item['id'];
         },$items);
        Kafka::fake();

        $message = new Message(

            body: [
                'user_id' => auth()->id(),
                'product_id' => $products,
            ],
        );

        $producer = Kafka::publishOn('checkout')
            ->withHeaders(['assesment' => 'assesmentTest'])
            ->withMessage($message)
            ->withBodyKey('assessment','assementTest');

        $producer->send();

        Kafka::assertPublished();
    }
    /** @test */
    public function test_component_user_checkout_consumer_consumes_message()
    {
        $this->actingAs(User::factory()->create());
        Product::factory(8)->create();
        $cartItems = CartItem::factory(3)->create();
        // dd($cartItems);
        $items = User::find(Auth::id())->carts()->with('product')->get()->toArray();
        $component = Livewire::test(CartList::class,['items'=>$items]);

        $products = array_map(function($item) {
            return $item['id'];
         },$items);
        Kafka::fake();

        $message = new Message(

            body: [
                'user_id' => auth()->id(),
                'product_id' => $products,
            ],
        );

        $producer = Kafka::publishOn('checkout')
            ->withHeaders(['assesment' => 'assesmentTest'])
            ->withMessage($message)
            ->withBodyKey('assessment','assementTest');

        $producer->send();

        Kafka::shouldReceiveMessages([
            new ConsumedMessage(
                topicName: 'cart_items',
                partition: 0,
                headers: [],
                body: [
                    'user_id' => auth()->id(),
                    'products' => $products,
                ],
                key: null,
                offset: 0,
                timestamp: 0
            ),
        ]);

        // Now, instantiate your consumer and start consuming messages. It will consume only the messages
        // specified in `shouldReceiveMessages` method:
        $consumer = Kafka::createConsumer(['cart_items'])
            ->withHandler(function (KafkaConsumerMessage $message)  {

                $body = $message->getBody();


                $order = [
                    'user_id' => $body['user_id'],
                    'products' => $body['products'],

                ];

                Order::create($order);
            })->build();

        $consumer->consume();

        $responseOrder = Order::whereUserId(auth()->id());
        $this->assertNotNull($responseOrder);
    }
}
