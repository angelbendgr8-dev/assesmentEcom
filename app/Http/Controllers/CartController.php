<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Junges\Kafka\Facades\Kafka;

class CartController extends Controller
{
    public function __invoke()
    {
        Kafka::publishOn('cart-items')

            ->withBodyKey('foo', 'bar')
            ->withHeaders([
                'foo-header' => 'foo-value'
            ])
            ->send();

        return response()->json('Message published!');
    }
}
