<?php

if ( ! function_exists('shopavel_loop'))
{
    function shopavel_loop($key, $options = null)
    {
        $looper = app('loops.'.$key);

        if ($options !== null)
        {
            $looper->setOptionValues($options);
        }

        $collection = $looper->getLoopCollection();

        $looper->reset();

        return $collection;
    }
}