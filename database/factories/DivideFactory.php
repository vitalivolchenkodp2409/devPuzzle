<?php

use Faker\Generator as Faker;

$factory->define(App\Divide::class, function (Faker $faker) {
    return [
        'name' => $faker->text(50)
    ];
});
