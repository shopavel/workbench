<?php

use Illuminate\Container\Container;

abstract class LoopTestCase extends PHPUnit_Framework_TestCase {

    /**
     * The IoC container
     * 
     * @var Container
     */
    protected $app;

    public function setUp()
    {
        // Create the container
        $this->app = new Container;

        // Get the mockery instances
        $view = $this->getView();

        // Laravel classes
        $this->app->singleton('view', function() use ($view)
        {
            return $view;
        });

        // Loop classes
        $provider = new Shopavel\Loops\LoopsServiceProvider($this->app);
        $this->app = $provider->shareClasses($this->app);
    }

    public function tearDown()
    {
        Mockery::close();
    }

    public function getView()
    {
        $view = Mockery::mock('Illuminate\View\View');
        $view->shouldReceive('getEngineResolver')->andReturn(Mockery::self());
        $view->shouldReceive('resolve')->andReturn(Mockery::self());
        $view->shouldReceive('getCompiler')->andReturn(Mockery::self());
        $view->shouldReceive('extend')->andReturn(null);
        return $view;
    }

}