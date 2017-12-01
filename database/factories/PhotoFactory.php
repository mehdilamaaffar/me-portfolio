<?php

use Faker\Generator as Faker;

$factory->define(App\Photo::class, function (Faker $faker) {
    $name = 'rkgtgjtr23m23kl423';
    $ext = 'jpeg';

    return [
        'file_name' => $name,
        'file_size' => $faker->fileExtension,
        'file_mime' => $ext,
        'file_path' => public_path(config('portfolio.photos_path') . $name . '.' . $ext),
        'thumbnail_path' => public_path(config('portfolio.thumbnails_path') . $name . '.' . $ext),
        'gallery_id' => factory('App\Gallery')->create(),
        'user_id' => 1,
    ];
});
