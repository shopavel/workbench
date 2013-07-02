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

    /**
     * Return the view inside the loaded theme.
     * 
     * @param  string $view
     * @return string
     */
    public function view($view)
    {
        return $this->theme . '/' . $view;
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