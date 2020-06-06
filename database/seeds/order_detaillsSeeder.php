<?php

use Illuminate\Database\Seeder;

class order_detaillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Model\Order_Detail::class,10)->create();
    }
}
