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

        for ($i = 0; $i < 10; $i++) {
            factory(Subscriber::class)->create();
        }
    }
}
