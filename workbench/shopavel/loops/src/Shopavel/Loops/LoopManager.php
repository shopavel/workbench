<?php namespace Shopavel\Loops;

class LoopManager {

    protected $handlers = [];

    public function create($key, $model)
    {
        $handler = new LoopHandler($key, $model);
        $this->addHandler($key, $handler);

        return $handler;
    }

    public function extend($key, $option, $callback)
    {
        $this->handlers[$key]->addOptionHandler($option, $callback);
    }

    public function addHandler($key, LoopHandler $handler)
    {
        $this->handlers[$key] = $handler;
    }

}