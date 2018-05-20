<?php

use Faker\Generator as Faker;

$factory->define(App\Serie::class, function (Faker $faker) {
    return [
        'serie' => $serie = $faker->randomElement(['B001', 'F001']),
        'code_type_document' => ($serie == 'B001') ? '03' :  '01',
        'type_document' => ($serie == 'B001') ? 'boleta' :  'factura',
        'first' => '0'
    ];
});
