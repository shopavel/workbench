<?php namespace Shopavel\Shopavel;

class ShopavelController extends \BaseController {

    protected $themes;

    public function __construct()
    {
        $this->app = app();
    }

}