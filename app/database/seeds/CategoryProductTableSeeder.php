<?php

class CategoryProductTableSeeder extends Seeder {

    public function run()
    {
        DB::table('category_product')->delete();

        $products = Shopavel\Products\Product::all();

        foreach ($products as $product) {
            $count = rand(1, 3);
            $sync = array();
            for ($i=0; $i<$count; $i++) {
                $sync[] = rand(1, 8);
            }
            $product->categories()->sync($sync);
        }
    }

}