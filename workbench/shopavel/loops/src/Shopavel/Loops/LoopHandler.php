<?php namespace Shopavel\Loops;

// use DB;
use Illuminate\Container\Container;
use Illuminate\Database\Eloquent\Builder;

class LoopHandler {

    /**
     * Name of the loop handler
     * 
     * @var string
     */
    protected $name;

    /**
     * Eloquent model this handler returns.
     * 
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $model;

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
    public function __construct(Container $app, $name, $model)
    {
        $this->app = $app;
        $this->blade = $app['view']->getEngineResolver()->resolve('blade')->getCompiler();
        $this->name = $name;
        $this->model = $model;

        $this->registerBladeExtensions();
        $this->addDefaultOptionHandlers();
    }

    /**
     * Add the default option handlers for the loop
     *
     * @return void
     */
    protected function addDefaultOptionHandlers()
    {
        $this->addOptionHandler('order', function(Builder $query, $value)
        {
            switch ($value)
            {
                case 'id':
                    $query->orderBy('id', 'asc');
                    break;

                case 'random':
                    $query->orderBy($this->app['db']->raw('RAND()'));
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
     * Register the Blade extensions with the compiler.
     * 
     * @return void
     */
    protected function registerBladeExtensions()
    {
        $me = $this;

        $this->blade->extend(function($value, $compiler) use ($me)
        {
            $matcher = $compiler->createMatcher('loop_' . $me->name);

            $object = strtolower(class_basename($me->model));
            
            $value = preg_replace($matcher, '$1<?php foreach(shopavel_loop("'.$me->name.'", $2) as $key => $'.$object.') { ?>', $value);
            $value = str_replace(', ())', ')', $value);
            return $value;
        });
    }

    /**
     * Reset the query.
     * 
     * @return void
     */
    public function reset()
    {
        $model = $this->model;
        $this->query = $model::query();
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

    public function getQuery()
    {
        return $this->query;
    }

    /**
     * Add an option handler to the loop.
     * 
     * @param  string    $key
     * @param  \Closure  $callback
     * @return void
     */
    public function addOptionHandler($key, \Closure $callback)
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

    public function getOptionHandlers()
    {
        return $this->option_handlers;
    }

    /**
     * Set the options and values to be applied to the loop.
     * 
     * @param  array  $options
     * @return void
     */
    public function setOptionValues($options)
    {
        if ($this->query == null)
        {
            $this->reset();
        }
        
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
        if ($this->query == null)
        {
            $this->reset();
        }
        
        return $this->query->get();
    }

}