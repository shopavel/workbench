<?php

class ProductTableSeeder extends Seeder {

    public function run()
    {
        DB::table('products')->delete();

        for ($i=0; $i<100; $i++)
        {
            Shopavel\Products\Product::create(array('title' => 'Product ' . $i));
        }
    }

}