<?php namespace Shopavel\Products;

use Illuminate\Database\Eloquent\Builder;
use Shopavel\Loops\LoopHandler;

class ProductLoopHandler extends LoopHandler {

    protected $name = 'products';
    
    protected $model = 'Product';

    public function __construct()
    {
        parent::__construct();

        $this->addOptionHandler('order', function(Builder $query, $value)
        {
            switch ($value)
            {
                case 'latest':
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;

                case 'bestselling':
                    break;
            }
        });
    }

    public function reset()
    {
        $this->setQuery(Product::query());
    }

}