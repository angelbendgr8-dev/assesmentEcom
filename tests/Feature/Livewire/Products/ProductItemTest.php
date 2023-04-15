<?php

namespace Tests\Feature\Livewire\Products;

use Tests\TestCase;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Product;
use App\Models\CartItem;
use Junges\Kafka\Facades\Kafka;
use Junges\Kafka\Message\Message;
use Junges\Kafka\Message\ConsumedMessage;
use App\Http\Livewire\Products\ProductItem;
use Illuminate\Foundation\Testing\WithFaker;
use Junges\Kafka\Contracts\KafkaConsumerMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductItemTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $product = Product::factory()->make();
        $component = Livewire::test(ProductItem::class, ['product', $product]);

        $component->assertStatus(200);
    }

    /** @test  */

    public function test_add_to_cart_button_pressed_by_unauthenticated_user()
    {
        $product = Product::factory()->make();
        $component = Livewire::test(ProductItem::class, ['product', $product])->call('addToCart');
        $component->assertRedirect('/login');
    }
    /** @test  */

    public function test_add_to_cart_button_pressed_by_auhenticated_user()
    {
        $this->actingAs(User::factory()->create());
        Product::factory()->create();
        $product = Product::first();

        $component = Livewire::test(ProductItem::class, [$product]);
        Kafka::fake();

        $message = new Message(

            body: [
                'user_id' => auth()->id(),
                'product_id' => $product->id,
            ],
        );

        $producer = Kafka::publishOn('cart_items')
            ->withHeaders(['key' => 'value'])
            ->withMessage($message)
            ->withBodyKey('foo', 'bar');

        $producer->send();

        Kafka::assertPublished();
    }
    public function test_add_kafka_consumer_consumes()
    {
        $this->actingAs(User::factory()->create());
        Product::factory()->create();
        $product = Product::first();

        $component = Livewire::test(ProductItem::class, [$product]);
        Kafka::fake();

        $message = new Message(

            body: [
                'user_id' => 1,
                'product_id' => 1,
            ],
        );

        $producer = Kafka::publishOn('cart_items')
            ->withHeaders(['key' => 'value'])
            ->withMessage($message)
            ->withBodyKey('foo', 'bar');

        $producer->send();

        Kafka::shouldReceiveMessages([
            new ConsumedMessage(
                topicName: 'cart_items',
                partition: 0,
                headers: [],
                body: [
                    'user_id' => 1,
                    'product_id' => 1,
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


                $cartItem = [
                    'user_id' => $body['user_id'],
                    'product_id' => $body['product_id'],
                    'quality' => 0,
                ];

                CartItem::create($cartItem);
            })->build();

        $consumer->consume();

        $responseCart = CartItem::whereUserId(1);
        $this->assertNotNull($responseCart);
    }
}
