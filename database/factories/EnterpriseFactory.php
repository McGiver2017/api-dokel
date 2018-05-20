<?php

use Faker\Generator as Faker;

$factory->define(App\Enterprise::class, function (Faker $faker) {
    $identification = \App\Identification::all()->random();
    return [
        'identification_id' => $identification->id,
        'ruc' => '20123456'.$faker->numberBetween(789,900),
        'comertial_name' => $faker->name,
        'razon_social' => $faker->name
    ];
});
