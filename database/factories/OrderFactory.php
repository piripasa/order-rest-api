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



$factory->define(App\Models\Order::class, function ($faker) use ($factory)  {
    return [
        'origin_lat' => $faker->latitude,
        'origin_lng' => $faker->longitude,
        'destination_lat' => $faker->latitude,
        'destination_lng' => $faker->longitude,
        'distance' => rand(1000, 10000),
        'status' => "UNASSIGNED",
    ];
});

$factory->state(App\Models\Order::class, 'taken', function ($faker) {
    return [
        'status' => "TAKEN",
    ];
});
