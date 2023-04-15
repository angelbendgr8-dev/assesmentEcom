# Laravel Eccommerce Kafka Assessment

- Clone this repository
- Run `composer install`
- Run `php artisan serve`
- Run `php artisan migrate --seed`
- Run `yarn `

to use laravel vite
- Run `yarn dev`

This project uses laravel breeze for authentication
this project also uses TALL STACK to implement the core functionalities required in the assessment

- Tailwind Css
- alphine js
- livewire js



To run this project locally a kafka server is required to run locally so as to allow consumer and producer
to be served by the server;

To set up kafka server locally follow the tutorial in the docs (http://cloudurable.com/blog/kafka-tutorial-kafka-from-command-line/index.html)

The kafka consumer and producer was implemented using [Laravel Kafka] (https://junges.dev/documentation/laravel-kafka/v1.13/1-introduction).


To start listening for cart_items messages, you can run the following command:

```bash
php artisan kafka:carts_consume
```
To start listening for checkout messages, you can run the following command:

```bash
php artisan kafka:checkout_consume
```
