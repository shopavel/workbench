<?php namespace Shopavel\Features;

class Feature extends \Eloquent {

    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'features';

    public function options()
    {
        return $this->hasMany('\Shopavel\Features\Option');
    }

    public function isDisplay()
    {
        return $this->type == 'display';
    }

    public function isChoice()
    {
        return $this->type == 'choice';
    }

}