<?php

use Faker\Generator as Faker;

$factory->define(App\note::class, function (Faker $faker) {
    $invoice = \App\Invoice::all()->random();
    $motive = \App\motive_note::all()->random();
    $serie = \App\Serie::all()->random();
    return [
        'invoice_id' => $invoice->id,
        'motive_note_id' => $motive->id,
        'serie_id' => $serie->id,
        'date_issue' => $faker->dateTime,
    ];
});
