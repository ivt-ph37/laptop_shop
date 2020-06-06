<?php

use Illuminate\Database\Seeder;

class suppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Model\Suppliers::class,10)->create();
    }
}
