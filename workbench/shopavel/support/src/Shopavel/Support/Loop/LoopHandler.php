<?php namespace Shopavel\Support\Loop;

use DB;
use Illuminate\Database\Eloquent\Builder;

abstract class LoopHandler {

    /**
     * Query to be modified by option handlers.
     * 
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $query;

    /**
     * Option handlers.
     * 
     * @var array
     */
    protected $option_handlers = [];

    /**
     * Create a new LoopHandler.
     *
     * @return void
     */
    public function __construct()
    {
        $this->reset();

        $this->addOptionHandler('order', function(Builder $query, $value)
        {
            switch ($value)
            {
                case 'id':
                    $query->orderBy('id', 'asc');
                    break;

                case 'random':
                    $query->orderBy(DB::raw('RAND()'));
                    break;

                case 'created':
                    $query->orderBy('created_at', 'asc');
                    break;
            }
        });

        $this->addOptionHandler('take', function(Builder $query, $value)
        {
            $query->take($value);
        });
    }

    /**
     * Reset the query, should be overloaded by child classes.
     * 
     * @return void
     */
    public function reset()
    {
        //
    }

    /**
     * Set the query to be modified.
     * 
     * @param  Builder  $query
     * @return void
     */
    public function setQuery(Builder $query)
    {
        $this->query = $query;
    }

    /**
     * Add an option handler to the loop.
     * 
     * @param  string    $key
     * @param  \Closure  $callback
     * @return void
     */
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

    /**
     * Set the options and values to be applied to the loop.
     * 
     * @param  array  $options
     * @return void
     */
    public function setOptionValues($options)
    {
        foreach ($options as $key => $value)
        {
            $this->applyOptionHandler($this->option_handlers[$key], $value);
        }
    }

    /**
     * Apply an option handler to the query.
     * 
     * @param  OptionHandler $handler
     * @param  mixed         $value
     * @return void
     */
    public function applyOptionHandler(OptionHandler $handler, $value)
    {
        $handler->call($this->query, $value);
    }

    /**
     * Get the loop collection.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getLoopCollection()
    {
        return $this->query->get();
    }

}