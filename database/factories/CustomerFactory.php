<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'customer_name' => $faker->name,
        'contact_name' => $faker->name,
        'address' => $faker->address,
        'city' => $faker->city,
        'postal_code' => $faker->postcode,
        'country' => $faker->country,
    ];
});
