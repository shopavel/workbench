<?php namespace Shopavel\Products;

class FeatureOption extends \Eloquent {

    /**
     * The database table used by the model.
     * 
     * @var string
     */
    protected $table = 'feature_options';

    public function feature()
    {
        return $this->belongsTo('\Shopavel\Features\Feature');
    }

}