@extends('basic.views.layout')

@section('content')
    <div class="hero-unit">
        <h1>Categories</h1>
        <p>A list of all your categories</p>
    </div>

    <div class="container">
        @loop_categories()
            <article>
                <h3>ID #{{ $category->id }} {{ $category->title }}</h3>
            </article>
        @end_loop()
    </div>
@stop