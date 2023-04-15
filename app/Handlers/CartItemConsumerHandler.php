<?php

namespace App\Handlers;

use App\Models\CartItem;
use Illuminate\Support\Facades\Log;
use Junges\Kafka\Contracts\KafkaConsumerMessage;

class CartItemConsumerHandler
{
    public function __invoke(KafkaConsumerMessage $message)
    {
        $body = $message->getBody();

        $cartItem = [
            'user_id' => $body['user_id'],
            'product_id' => $body['product_id'],
            'quality' => 0,
        ];

        CartItem::create($cartItem);
    }
}
