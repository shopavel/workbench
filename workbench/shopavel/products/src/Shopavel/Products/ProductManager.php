<?php namespace Shopavel\Products;

class ProductManager {

    protected $loop_products;

    public function setLoopProducts($products)
    {
        $this->loop_products = $products;
    }

    public function getLoopProducts()
    {
        return $this->loop_products;
    }

}