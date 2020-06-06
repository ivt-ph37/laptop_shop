<?php

use Illuminate\Database\Seeder;

class suggestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Model\Suggets::class,10)->create();
    }
}
