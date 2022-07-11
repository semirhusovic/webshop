@foreach ($categories as $category)
    <li>{{$category->categoryName }}
        @if ($category->products)
        <ul>
            @foreach ($category->products as $product)
            <li>{{$product->productName}}</li>
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
