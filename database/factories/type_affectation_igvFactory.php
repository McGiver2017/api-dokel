<?php

use Faker\Generator as Faker;

$factory->define(App\type_affectation_igv::class, function (Faker $faker) {
    return [
        'code' => '10',
        'description' => 'Gravado - Operación Onerosa',
    ];
});
$factory->define(App\type_affectation_igv::class, function (Faker $faker) {
    return [
        'code' => '11',
        'description' => 'Gravado – Retiro por premio',
    ];
});
$factory->define(App\type_affectation_igv::class, function (Faker $faker) {
    return [
        'code' => '12',
        'description' => 'Gravado – Retiro por donación',
    ];
});
$factory->define(App\type_affectation_igv::class, function (Faker $faker) {
    return [
        'code' => '13',
        'description' => 'Gravado – Retiro ',
    ];
});
$factory->define(App\type_affectation_igv::class, function (Faker $faker) {
    return [
        'code' => '14',
        'description' => 'Gravado – Retiro por publicidad',
    ];
});

