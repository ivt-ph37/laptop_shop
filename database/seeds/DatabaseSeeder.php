<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(suggestsSeeder::class);
        $this->call(ordersSeeder::class);
        $this->call(contactsSeeder::class);
        $this->call(suppliersSeeder::class);
        $this->call(categoriesSeeder::class);
        $this->call(productsSeeder::class);
        $this->call(product_imageSeeder::class);
        $this->call(promotionsSeeder::class);
        $this->call(order_detaillsSeeder::class);
    }
}
