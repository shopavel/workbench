<?php namespace Shopavel\Loops;

use Illuminate\Container\Container;
use Illuminate\Support\ServiceProvider;

class LoopsServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('shopavel/loops');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app = $this->shareClasses($this->app);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array('loops');
    }

    /**
     * Shares the Loops classes with the container
     * 
     * @param  Container $app
     * @return Container
     */
    public function shareClasses(Container $app)
    {
        $app['loops.manager'] = $app->share(function($app)
        {
            return new LoopManager($app);
        });

        return $app;
    }

}