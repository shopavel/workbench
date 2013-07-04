@extends('basic.views.layout')

@section('content')
    <div class="hero-unit">
        <h1>Shopavel</h1>
        <p>An ecommerce platform for developers built on Laravel 4</p>
    </div>

    <div class="row product-list">
        @loop_products(['order' => 'latest', 'take' => 4])
            <div class="span3">
                @include('basic.views.product.show-list')
            </div>
        @end_loop()
    </div>
@stop