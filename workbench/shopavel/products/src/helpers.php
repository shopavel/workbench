<?php

if ( ! function_exists('shopavel_loop_products'))
{
    function shopavel_loop_products()
    {     
        return Product::getLoopProducts();
    }
}