<?php

use Faker\Generator as Faker;

$factory->define(App\detail_invoice::class, function (Faker $faker) {
    $invoice = \App\Invoice::all()->random();
    $typeAfecctation = \App\type_affectation_igv::all()->random();
    return [
        'invoice_id' => $invoice->id,
        'code_product' => $faker->postcode,
        'unity' => $faker->numberBetween(1, 100),
        'quantity' => $faker->numberBetween(1,20),
        'description' => $faker->paragraph(1),
        'type_affectation_igv_id' => $typeAfecctation,
        'igv' => $faker->numberBetween(1, 100),
        'AmountValueSale' => $faker->numberBetween(1, 100),
        'amountValueUnit' => $faker->numberBetween(1, 100),
        'AmountPriceUnit' => $faker->numberBetween(1, 100)
    ];
});
