<?php

use Faker\Generator as Faker;

$factory->define(App\MedicalRecords::class, function (Faker $faker) {
    return [
        'date_appointment' => $faker->dateTime(),
        'notes' => $faker->text(50),
        'status' => 'O',
    ];
});
