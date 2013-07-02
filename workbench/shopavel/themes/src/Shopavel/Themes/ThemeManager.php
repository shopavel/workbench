<?php namespace Shopavel\Themes;

class ThemeManager {

    /**
     * Determines which theme to load.
     * 
     * @var string
     */
    protected $theme;

    /**
	 * The view environment instance.
	 *
	 * @var \Illuminate\View\Environment
	 */
	protected $views;

    public function __construct($theme, $views)
    {
        $this->theme = $theme;
        $this->views = $views;
    }

    public function registerAssets()
    {
        $me = $this;

        app('basset')->collection('application', function($collection) use ($me)
        {
            // Switch to the stylesheets directory and require the "less" and "sass" directories.
            // These directories both have a filter applied to them so that the built
            // collection will contain valid CSS.
            $directory = $collection->directory($me->directory() . '/assets/stylesheets', function($collection)
            {
                $collection->requireDirectory('less')->apply('Less');
                $collection->requireDirectory('sass')->apply('Sass');
                $collection->requireDirectory();
            });

            $directory->apply('CssMin');
            $directory->apply('UriRewriteFilter');

            // Switch to the javascripts directory and require the "coffeescript" directory. As
            // with the above directories we'll apply the CoffeeScript filter to the directory
            // so the built collection contains valid JS.
            $directory = $collection->directory($me->directory() . '/assets/javascripts', function($collection)
            {
                $collection->requireDirectory('coffeescripts')->apply('CoffeeScript');
                $collection->requireDirectory();
            });

            $directory->apply('JsMin');
        });
    }

    public function directory()
    {
        return '/themes/'. $this->theme;
    }

    public function path()
    {
        return public_path() . $this->directory();
    }

    /**
     * Return the view inside the loaded theme.
     * 
     * @param  string $view
     * @return string
     */
    public function view($view)
    {
        return $this->theme . '/views/' . $view;
    }

    /**
     * Make a view inside the loaded theme.
     * 
     * @param  string $view
     * @return \Illuminate\View\View
     */
    public function make($view)
    {
        return $this->views->make($this->view($view));
    }

}