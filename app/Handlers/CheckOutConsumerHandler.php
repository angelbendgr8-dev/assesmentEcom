<?php

namespace App\Handlers;

use App\Models\CartItem;
use App\Models\Order;
use Illuminate\Support\Facades\Log;
use Junges\Kafka\Contracts\KafkaConsumerMessage;

class CheckOutConsumerHandler
{
    public function __invoke(KafkaConsumerMessage $message)
    {
        $body = $message->getBody();

        $cartItem = [
            'user_id' => $body['user_id'],
            'products' => $body['products'],

        ];

        Order::create($cartItem);
        CartItem::whereUserId($body['user_id'])->delete();
    }
}
