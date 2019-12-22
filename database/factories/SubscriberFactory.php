<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Subscriber;
use Faker\Generator as Faker;

$factory->define(Subscriber::class, function (Faker $faker) {
    return [
        'email' => $faker->email,
        'name' => $faker->name,
        'state' => $faker->randomElement(Subscriber::STATES),
    ];
});
