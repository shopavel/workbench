@extends('basic.views.layout')

@section('content')
    <div class="hero-unit">
        <h1>Products</h1>
        <p>A list of all your products</p>
    </div>

    <div class="container">
        @foreach ($products as $product)
            <article>
                <h3>{{ $product->title }}</h3>
            </article>
        @endforeach
    </div>
@stop