<?php

use Faker\Generator as Faker;

$factory->define(App\Identification::class, function (Faker $faker) {
    return [
        'codigo' => '0',
        'name' => 'DOC.TRIB.NO.DOM.SIN.RUC',
    ];
});
$factory->define(App\Identification::class, function (Faker $faker) {
    return [
        'codigo' => '1',
        'name' => 'DOC. NACIONAL DE IDENTIDAD ',
    ];
});
$factory->define(App\Identification::class, function (Faker $faker) {
    return [
        'codigo' => '4',
        'name' => 'CARNET DE EXTRANJERIA',
    ];
});
$factory->define(App\Identification::class, function (Faker $faker) {
    return [
        'codigo' => '7',
        'name' => 'PASAPORTE',
    ];
});
$factory->define(App\Identification::class, function (Faker $faker) {
    return [
        'codigo' => 'A',
        'name' => 'CED. DIPLOMATICA DE IDENTIDAD',
    ];
});
$factory->define(App\Identification::class, function (Faker $faker) {
    return [
        'codigo' => '6',
        'name' => 'REG. UNICO DE CONTRIBUYENTES ',
    ];
});