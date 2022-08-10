<h2>{{ $category->category_name }}</h2>

Products:
<ol>
    @foreach ($products as $product)
        <li>{{ $product->product_name }} (${{ $product->product_price }})</li>
    @endforeach
</ol>
