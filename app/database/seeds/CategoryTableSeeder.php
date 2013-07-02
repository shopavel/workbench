<?php

class CategoryTableSeeder extends Seeder {

    public function run()
    {
        DB::table('categories')->delete();

        for ($i=0; $i<8; $i++)
        {
            Shopavel\Categories\Category::create(array('title' => 'Category ' . $i));
        }
    }

}