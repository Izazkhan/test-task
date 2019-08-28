<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'customer_id' => rand(1,51),
        'order_date' => $faker->date($format = 'Y-m-d', $max = 'now')
    ];
});
