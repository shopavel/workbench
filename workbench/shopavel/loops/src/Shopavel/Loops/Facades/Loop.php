<?php namespace Shopavel\Loops\Facades;

use Illuminate\Support\Facades\Facade;

class Loop extends Facade {

    /**
     * Get the registered name of the component.
     *
     * @return  string
     */
    protected static function getFacadeAccessor() { return 'loops'; }

}