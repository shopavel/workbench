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

		include __DIR__.'/../../routes.php';
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
            $product = new Product;

            return $product;
        });

        $loop = \Loop::create('products', '\Shopavel\Products\Product');

        $loop->addOptionHandler('order', function(Builder $query, $value)
        {
            switch ($value)
            {
                case 'latest':
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;

                case 'bestselling':
                    break;
            }
        });

		$this->app['loops.product'] = $this->app->share(function($app) use ($loop)
        {
            return $loop;
        });
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('products', 'loops.product');
	}

}