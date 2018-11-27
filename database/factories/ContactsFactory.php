<?php

use Faker\Generator as Faker;

$factory->define(App\Contacts::class, function (Faker $faker) {
    return [
        'name' => $faker->text(10),
        'email' => $faker->text(20),
        'message' => $faker->text(200)       
    ];
});
