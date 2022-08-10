@foreach ($categories as $category)
    <li>{{$category->category_name }}
        @if ($category->products)
        <ul>
            @foreach ($category->products as $product)
            <li>{{$product->product_name}}</li>
            @endforeach
        </ul>
        @endif
    </li>
    @if ($category->subcategories)
        <ul>
            @include('categories.subcategories', ['categories' => $category->subcategories])
        </ul>
    @endif
@endforeach
