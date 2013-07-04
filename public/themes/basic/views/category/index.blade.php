@extends('basic.views.layout')

@section('content')
    <div class="hero-unit">
        <h1>Categories</h1>
        <p>A list of all your categories</p>
    </div>

    <div class="container">
        @loop_categories()
            <article class="category">
                <header>
                    <h3>{{ $category->title }}</h3>
                </header>

                <section class="products">
                    @loop_products()
                        <article class="product">
                            <h4>{{ $product->title }}</h4>
                        </article>
                    @end_loop()
                </section>
            </article>
        @end_loop()
    </div>
@stop