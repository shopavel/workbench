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

    public function features()
    {
        return $this->belongsToMany('\Shopavel\Features\Feature');
    }

    public function variations()
    {
        //
    }

    public function url()
    {
        return \URL::route('product.show', ['product' => $this->id]);
    }

    public function images()
    {
        // temp
        return [
            (object) ['src' => 'http://placebear.com/600/400'],
            (object) ['src' => 'http://placebear.com/g/600/400'],
            (object) ['src' => 'http://placekitten.com/600/400'],
            (object) ['src' => 'http://placekitten.com/g/600/400'],
        ];
    }

}