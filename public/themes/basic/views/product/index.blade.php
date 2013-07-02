@extends('basic.views.layout')

@section('content')
    <div class="hero-unit">
        <h1>Products</h1>
        <p>A list of all your products</p>
    </div>

    <div class="container">
        @loop_products()
            <article>
                <h3>ID #{{ $product->id }} {{ $product->title }}</h3>
            </article>
        @end_loop()
    </div>
@stop