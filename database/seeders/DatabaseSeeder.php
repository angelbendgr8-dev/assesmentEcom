<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $products = [
            '0' => [
                'name' => 'Product 1',
                'price' => 99,
                'quantity' => 20,
                'image' => 'https://images.unsplash.com/photo-1555982105-d25af4182e4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80'
            ],
            '1' => [
                'name' => 'Product 2',
                'price' => 80,
                'quantity' => 15,
                'image' => 'https://images.unsplash.com/photo-1508423134147-addf71308178?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80'
            ],
            '2' => [
                'name' => 'Product 3',
                'price' => 100,
                'quantity' => 25,
                'image' => 'https://images.unsplash.com/photo-1449247709967-d4461a6a6103?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80'
            ],
            '3' => [
                'name' => 'Product 4',
                'price' => 100,
                'quantity' => 25,
                'image' => 'https://images.unsplash.com/reserve/LJIZlzHgQ7WPSh5KVTCB_Typewriter.jpg?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80'
            ],
            '4' => [
                'name' => 'Product 5',
                'price' => 105,
                'quantity' => 25,
                'image' => 'https://images.unsplash.com/photo-1467949576168-6ce8e2df4e13?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80'
            ],
            '5' => [
                'name' => 'Product 6',
                'price' => 75,
                'quantity' => 25,
                'image' => 'https://images.unsplash.com/photo-1544787219-7f47ccb76574?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80'
            ],
            '6' => [
                'name' => 'Product 7',
                'price' => 75,
                'quantity' => 25,
                'image' => 'https://images.unsplash.com/photo-1550837368-6594235de85c?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=400&h=400&q=80'
            ],
            '7' => [
                'name' => 'Product 8',
                'price' => 205,
                'quantity' => 25,
                'image' => 'https://images.unsplash.com/photo-1551431009-a802eeec77b1?ixlib=rb-1.2.1&auto=format&fit=crop&w=400&h=400&q=80'
            ],
        ];

        \App\Models\Product::insert($products);
    }
}
