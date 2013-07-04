<?php namespace Shopavel\Products;

use Illuminate\Support\ServiceProvider;

class ProductsServiceProvider extends ServiceProvider {

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
		$this->package('shopavel/products');

		$this->registerBladeExtensions();

		include __DIR__.'/../../routes.php';
	}

	/**
     * Register the Blade extensions with the compiler.
     * 
     * @return void
     */
    protected function registerBladeExtensions()
    {
        $blade = $this->app['view']->getEngineResolver()->resolve('blade')->getCompiler();

        $blade->extend(function($value, $compiler)
        {
            $matcher = $compiler->createMatcher('loop_products');
            
            return preg_replace($matcher, '$1<?php foreach(shopavel_loop_products$2 as $product) { ?>', $value);
        });
    }

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['products'] = $this->app->share(function($app)
        {
            $manager = new ProductManager;

            return $manager;
        });
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