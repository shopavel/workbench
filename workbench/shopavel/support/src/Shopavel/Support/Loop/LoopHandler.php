<?php namespace Shopavel\Support\Loop;

abstract class LoopHandler {

    protected $objects;

    protected $option_handlers;

    public function __construct()
    {
        $this->addOptionHandler('order', function($objects, $value)
        {
            switch ($value)
            {
                case 'id':
                    $objects->orderBy('id', 'asc');
                    break;

                case 'created':
                default:
                    $objects->orderBy('created_at', 'asc');
                    break;
            }
        });

        $this->addOptionHandler('take', function($objects, $value)
        {
            $objects->take($value);
        });
    }

    public function setObjects($objects)
    {
        $this->objects = $objects;
    }

    public function addOptionHandler($key, $callback)
    {
        if (! isset($this->option_handlers[$key]))
        {
            $this->option_handlers[$key] = new OptionHandler($callback);
        }
        else
        {
            $this->option_handlers[$key]->extend($callback);
        }
    }

    public function setOptionValues($options)
    {
        foreach ($options as $key => $value)
        {
            $this->applyOptionHandler($this->option_handlers[$key], $value);
        }
    }

    public function applyOptionHandler(OptionHandler $handler, $value)
    {
        $handler->call($this->objects, $value);
    }

    public function getObjects()
    {
        return $this->objects->get();
    }

}