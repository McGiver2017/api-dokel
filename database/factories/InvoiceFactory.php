<?php

use Faker\Generator as Faker;
$factory->define(App\Invoice::class, function (Faker $faker) {
    $user = \App\User::all()->random();
    $office_transmitter = \App\Office::all()->random();
    $serie = \App\Serie::all()->random();
    $office_receiber = \App\Office::all()->except($office_transmitter->id)->random();
    $cantidad = count(\App\Invoice::all());
    $venta_igv = $faker->numberBetween(100,1000);
    $venta_opExonerados = $faker->numberBetween(100,1000);
    $venta_descuentoOpGravadas = $faker->numberBetween(100,1000);
    $venta_opGravadas = $faker->numberBetween(100,1000);
    $venta_opNoOnerosas = $faker->numberBetween(100,1000);
    $venta_valorDescuento = $faker->numberBetween(100,1000);
    return [
        'user_id' => $user->id,
        'office_transmitter_id' => $office_transmitter->id,
        'serie_id' => $serie->id,
        'office_receiver_id' => $office_receiber->id,
        'documento_tipoDoc' => '01',
        'documento_tipoDoc_literal' => $serie->type_document,
        'documento_correlativo' => $faker->numberBetween(1,1000),
        'documento_fechaEmision' => $faker->dateTime,
        'venta_igv' => $venta_igv,
        'venta_opExonerados' => $venta_opExonerados,
        'venta_descuentoOpGravadas' => $venta_descuentoOpGravadas,
        'venta_opGravadas' => $venta_opGravadas,
        'venta_opNoOnerosas' => $venta_opNoOnerosas,
        'venta_valorDescuento' => $venta_valorDescuento,
        'venta_tipoDeMoneda' => 'PEN',
        'venta_precioVenta' => $venta_igv + $venta_opExonerados + $venta_descuentoOpGravadas + $venta_opGravadas
        + $venta_opNoOnerosas + $venta_valorDescuento,
        'venta_leyenda' => $faker->domainName
    ];
});
