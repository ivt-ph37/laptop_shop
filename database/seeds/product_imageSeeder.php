<?php

use Illuminate\Database\Seeder;

class product_imageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Model\Product_Image::class,10)->create();
    }
}
