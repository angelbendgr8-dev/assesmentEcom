<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Junges\Kafka\Facades\Kafka;
use App\Handlers\CartItemConsumerHandler;
use App\Handlers\CheckOutConsumerHandler;

class CheckOutConsumer extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kafka:checkout-consumer';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $consumer = Kafka::createConsumer()
            ->subscribe('checkout')
            ->withHandler(new CheckOutConsumerHandler)
            ->withAutoCommit()
            ->withConsumerGroupId('test_consumer')
            ->build();

        $consumer->consume();
    }
}
