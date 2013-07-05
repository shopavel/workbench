<?php namespace Shopavel\Loops;

use Illuminate\Container\Container;

class LoopManager {

    protected $handlers = [];

    public function __construct(Container $app)
    {
        $this->app = $app;
    }

    public function create($key, $model)
    {
        $handler = new LoopHandler($this->app, $key, $model);
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

    public function getHandlers()
    {
        return $this->handlers;
    }

    public function getHandler($key)
    {
        if (! isset($this->handlers[$key])) {
            throw new \Exception("Handler '" . $key . "' does not exist on loop manager");
        }

        return $this->handlers[$key];
    }

}