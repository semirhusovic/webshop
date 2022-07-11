<h2>{{ $category->categoryName }}</h2>

Products:
<ol>
    @foreach ($products as $product)
        <li>{{ $product->productName }} (${{ $product->productPrice }})</li>
    @endforeach
</ol>
