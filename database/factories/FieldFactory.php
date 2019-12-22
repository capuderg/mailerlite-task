<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Field;
use Faker\Generator as Faker;


$factory->define(Field::class, function (Faker $faker) {
    $subscriberIds = \App\Subscriber::all()
        ->pluck('id')
        ->toArray();

    return [
        'title' => $faker->text(20),
        'type' => $faker->randomElement(Field::TYPES),
        'subscriber_id' => $faker->randomElement($subscriberIds),
    ];
});
