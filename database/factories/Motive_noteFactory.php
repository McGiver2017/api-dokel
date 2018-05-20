<?php

use Faker\Generator as Faker;

$factory->define(App\motive_note::class, function (Faker $faker) {
    return [
        'type_note' => $serie = $faker->randomElement(['credito', 'debito']),
        'code' => ($serie == 'credito') ? '01' :  '01',
        'description' => ($serie == 'credito') ? 'Anulación de la operación' :  'Intereses por mora'
    ];
});
