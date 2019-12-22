<?php

use \App\Subscriber;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubscriberTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subscribers')->delete();

        $faker = \Faker\Factory::create();

        for ($i = 0; $i < 10; $i++) {
            Subscriber::create([
                'email' => $faker->email,
                'name' => $faker->name,
                'state' => $faker->randomElement(Subscriber::STATES)
            ]);
        }
    }
}
