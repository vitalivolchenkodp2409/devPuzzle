<?php

use Faker\Generator as Faker;

$factory->define(App\Technology::class, function (Faker $faker) {
    return [        
        'name' => $faker->text(15)        
    ];
});
