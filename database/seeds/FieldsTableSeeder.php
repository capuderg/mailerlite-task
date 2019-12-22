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

        for ($i = 0; $i < 20; $i++) {
            factory(Field::class)->create();
        }
    }
}
