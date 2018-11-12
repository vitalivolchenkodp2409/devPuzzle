<?php

use Faker\Generator as Faker;

$factory->define(App\Work::class, function (Faker $faker) {
    return [
        'name' => $faker->text(8),
        'description' => $faker->text(100)        
    ];
});
