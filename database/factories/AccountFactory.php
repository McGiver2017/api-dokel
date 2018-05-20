<?php

use Faker\Generator as Faker;
use App\User;
use App\Enterprise;
$factory->define(App\Account::class, function (Faker $faker) {
    $user = User::all()->random();
    $enterprise = Enterprise::all()->random();
    return [
        'user_id' => $user->id,
        'enterprise_id' => $enterprise->id
    ];
});
