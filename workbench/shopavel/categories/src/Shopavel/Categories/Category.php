<?php namespace Shopavel\Categories;

class Category extends \Eloquent {

    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'categories';

    public function products()
    {
        return $this->belongsToMany('\Shopavel\Products\Product');
    }

    public function url()
    {
        return \URL::route('category.show', ['category' => $this->id]);
    }

}