<?php namespace Shopavel\Shopavel;

use Illuminate\Support\ServiceProvider;

class ShopavelServiceProvider extends ServiceProvider {

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
		$this->package('shopavel/shopavel');

		$this->registerBladeExtensions();
	}

	/**
     * Register the Blade extensions with the compiler.
     * 
     * @return void
     */
	public function registerBladeExtensions()
	{
		$blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

		$blade->extend(function($value, $compiler)
        {
            $matcher = $compiler->createMatcher('end_loop');

            return preg_replace($matcher, '$1<?php } ?>', $value);
        });
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array();
	}

}