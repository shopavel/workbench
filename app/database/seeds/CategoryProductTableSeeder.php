<?php

class CategoryProductTableSeeder extends Seeder {

    public function run()
    {
        DB::table('category_product')->delete();

        $products = Shopavel\Products\Product::all();

        $categories = Shopavel\Categories\Category::orderBy('id', 'asc')->get();
        $id_min = $categories[0]->id;
        $id_max = $categories[count($categories)-1]->id;

        foreach ($products as $product) {
            $count = rand(1, 3);
            $sync = array();
            for ($i=0; $i<$count; $i++) {
                $sync[] = rand($id_min, $id_max);
            }
            $product->categories()->sync($sync);
        }
    }

}