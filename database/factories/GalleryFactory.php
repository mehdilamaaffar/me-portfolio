<?php

use Faker\Generator as Faker;

$factory->define(App\Gallery::class, function (Faker $faker) {
    static $i = 0;

    $names = ['sunset', 'flower', 'portrait', 'Cats'];

    return [
        'name' => $names[$i],
        'name_slug' => str_slug($names[$i]),
        'user_id' => 1,
        'published' => 1,
    ];

    $i++;
});

$factory->state(App\Gallery::class, 'testing', function (Faker $faker) {
    return [
        'name' => $faker->name,
        'name_slug' => str_slug($faker->name),
        'user_id' => 1,
        'published' => 1,
    ];
});
