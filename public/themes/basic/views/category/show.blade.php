@extends('basic.views.layout')

@section('content')
    <div class="hero-unit">
        <h1>{{ $category->title }}</h1>
        <p>Contains {{ $category->products()->count() }} products</p>
    </div>

    <div class="container">
        <div class="row product-list">
            @loop_products(['order' => 'latest'])
                <div class="span3">
                    @include('basic.views.product.show-list')
                </div>

                @if ($key == 3)
                    </div><div class="row product-list">
                @endif
            @end_loop()
        </div>
    </div>
@stop