<?php

if ( ! function_exists('shopavel_loop_products'))
{
    function shopavel_loop_products($options = null)
    {
        if ($options !== null)
        {
            Product::setOptionValues($options);
        }
        return Product::getObjects();
    }
}