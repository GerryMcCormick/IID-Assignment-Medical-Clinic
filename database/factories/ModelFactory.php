<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

// not used, added firstname, lastname, gender
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Address::class, function (Faker\Generator $faker) {
    return [
        'add_line_1' => $faker->buildingNumber . ' ' . $faker->streetName,
        'add_line_2' => $faker->secondaryAddress,
        'town'       => 'Derry',
        'postcode'   => 'BT48' . ' ' . $faker->postcode,
    ];
});