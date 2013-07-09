<article class="product">
    <h3>{{ $product->title }}</h3>
    <p>{{ $product->created_at }}</p>

    <a class="btn" href="{{ $product->url() }}">View Product</a>
</article>