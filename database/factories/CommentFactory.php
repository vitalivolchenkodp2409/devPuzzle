<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'name' => $faker->text(8),
        'position' => $faker->text(10),
        'firma' => $faker->text(15),
        'comment' => $faker->text(200),
    ];
});
