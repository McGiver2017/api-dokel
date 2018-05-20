<?php

use Faker\Generator as Faker;

$factory->define(App\Office::class, function (Faker $faker) {
    $Enterprise = \App\Enterprise::all()->random();
    return [
        'enterprise_id' => $Enterprise->id,
        'direction' => $faker->address,
        'cod_postal' => $faker->countryCode,
        'departament' => $faker->city,
        'province' => $faker->country,
        'district' => $faker->city
    ];
});
