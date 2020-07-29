<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Republic;
use Faker\Generator as Faker;

$factory->define(Republic::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'street' => $faker->streetName,
        'number' => $faker->buildingNumber,
        'district' => $faker->name,
        'city' => $faker->city,
        'state' => $faker->state,
        'cep' => $faker->randomNumber(8, false),
        'price' => $faker->randomNumber(3, false),
    ];
});
