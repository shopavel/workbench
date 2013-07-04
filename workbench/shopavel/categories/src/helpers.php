<?php

if ( ! function_exists('shopavel_loop_categories'))
{
    function shopavel_loop_categories()
    {
        return Shopavel\Categories\Category::all();
    }
}