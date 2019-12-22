<?php

use \App\Field;
use Illuminate\Database\Seeder;

class FieldsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Field::truncate();

        $faker = \Faker\Factory::create();

        $subscriberIds = \App\Subscriber::all()
            ->pluck('id')
            ->toArray();

        for ($i = 0; $i < 20; $i++) {
            Field::create([
                'title' => $faker->text(20),
                'type' => $faker->randomElement(Field::TYPES),
                'subscriber_id' => $faker->randomElement($subscriberIds),
            ]);
        }
    }
}
