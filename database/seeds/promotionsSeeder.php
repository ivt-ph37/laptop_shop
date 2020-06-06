<?php

use Illuminate\Database\Seeder;

class promotionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Model\Promotions::class,10)->create();
    }
}
