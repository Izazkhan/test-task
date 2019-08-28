<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\OrderDetail;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'order_id' => rand(1,170),
        'product_id' => rand(1,30),
        'quantity' => rand(1,5)
    ];
});
