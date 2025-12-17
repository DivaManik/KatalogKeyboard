<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Keyboard;
use Faker\Generator as Faker;

$factory->define(Keyboard::class, function (Faker $faker) {
    $name = $faker->randomElement([
        'Aurora',
        'Nebula',
        'Luminous',
        'Zenith',
        'Velvet',
        'Nimbus',
    ]) . ' ' . $faker->randomElement(['65', '75', 'TKL', 'Full']);

    return [
        'name'          => $name . ' Keyboard',
        'brand'         => $faker->randomElement(['Keychron', 'Akko', 'GMK', 'Logitech', 'Razer', 'Ducky']),
        'switch_type'   => $faker->randomElement(['Gateron Blue', 'Gateron Brown', 'Kailh Box White', 'Cherry MX Red', 'Holy Panda']),
        'layout'        => $faker->randomElement(['60%', '65%', '75%', 'TKL', 'Fullsize']),
        'connection'    => $faker->randomElement(['wired', 'wireless', 'hybrid']),
        'hot_swappable' => $faker->boolean,
        'price'         => $faker->numberBetween(800000, 3500000),
        'stock'         => $faker->numberBetween(0, 50), // Stock 0-50 units
        'release_date'  => $faker->date(),
        'description'   => $faker->paragraph(3),
        'image_url'     => $faker->imageUrl(640, 480, 'technics', true, 'Keyboard'),
        'buy_link'      => $faker->url,
    ];
});
