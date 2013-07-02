<?php namespace Shopavel\Products;

class Product extends \Eloquent {

    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'products';

    public function categories()
    {
        return $this->belongsToMany('\Shopavel\Categories\Category');
    }

}