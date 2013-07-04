<?php namespace Shopavel\Support\Loop;

class OptionHandler {

    /**
     * List of callbacks to apply to the query
     * 
     * @var array
     */
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

    public function call($query, $value)
    {
        foreach ($this->callbacks as $callback)
        {
            $callback($query, $value);
        }
    }

}