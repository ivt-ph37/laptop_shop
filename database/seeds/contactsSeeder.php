<?php

use Illuminate\Database\Seeder;

class contactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Model\Contacts::class,10)->create();
    }
}
