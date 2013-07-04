<?php namespace Shopavel\Products;

use Shopavel\Support\Loop\LoopHandler;

class ProductLoopHandler extends LoopHandler {

    public function __construct()
    {
        parent::__construct();
        
        $this->addOptionHandler('order', function($objects, $value)
        {
            switch ($value)
            {
                case 'latest':
                case 'newest':
                    $objects->orderBy('created_at', 'desc');
                    break;

                case 'bestselling':
                    break;
            }
        });

        $this->setObjects(Product::query());
    }

}