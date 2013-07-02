<?php

if ( ! function_exists('shopavel_loop_categories'))
{
    function shopavel_loop_categories()
    {
        $a = func_get_args();
        
        return Shopavel\Categories\Category::all();
    }
}