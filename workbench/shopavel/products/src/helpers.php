<?php

if ( ! function_exists('shopavel_loop_products'))
{
    function shopavel_loop_products()
    {
        $a = func_get_args();
        
        return Shopavel\Products\Product::all();
    }
}