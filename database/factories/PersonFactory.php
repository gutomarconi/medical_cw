<?php

use Faker\Generator as Faker;

$factory->define(App\People::class, function (Faker $faker) {
    return array(
        'name' => $faker->name,
        'email' => $faker->email,
        'date_of_birth' => $faker->dateTime(),
        'height' => $faker->numberBetween(50,120),
        'weight' => $faker->numberBetween(120,200),
        'phone_number' => $faker->phoneNumber,
    );
});
