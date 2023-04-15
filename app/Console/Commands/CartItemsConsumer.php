<?php

namespace App\Console\Commands;

use App\Handlers\CartItemConsumerHandler;
use Illuminate\Console\Command;
use Junges\Kafka\Facades\Kafka;

class CartItemsConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafka:cart-consume';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $consumer = Kafka::createConsumer()
            ->subscribe('cart_items')
            ->withHandler(new CartItemConsumerHandler)
            ->withAutoCommit()
            ->withConsumerGroupId('test_consumer')
            ->build();

        $consumer->consume();
    }
}
