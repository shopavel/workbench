<?php namespace Shopavel\Support\Loop;

class OptionHandler {

    protected $callbacks = [];

    public function __construct($callback)
    {
        $this->extend($callback);
    }

    public function set($callback)
    {
        $this->callbacks = [$callback];
    }

    public function extend($callback)
    {
        $this->callbacks[] = $callback;
    }

    public function call($objects, $value)
    {
        foreach ($this->callbacks as $callback)
        {
            $callback($objects, $value);
        }
    }

}