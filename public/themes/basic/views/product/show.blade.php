@extends('basic.views.layout')

@section('content')
    <article class="product">

        <div class="page-header">
            <h1>{{ $product->title }}</h1>

            <ul class="breadcrumb">
                @loop_categories()
                    <li>
                        <a href="{{ $category->url() }}">{{ $category->title }}</a>
                        @if (! $loop->isLast())
                            <span class="divider">|</span>
                        @endif
                    </li>
                @end_loop()
            </ul>
        </div>

        <div class="row">
            <div class="span4">
                <ul class="thumbnails">
                    @foreach ($product->images() as $key => $image)
                        <li class="span2">
                            <a class="thumbnail" href="#">
                                <!-- <img src="{{ $image->src }}"> -->
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="span8">
                <p>description</p>
            </div>
        </div>
    </article>
@stop