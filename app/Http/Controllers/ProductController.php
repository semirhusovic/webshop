<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Discount;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $productService;

    public function __construct(ProductService $service)
    {
        $this->productService = $service;
    }

    public function index(Request $request)
    {
        $filter = $request->filter;
        $products = $this->productService->filterItems($request);
        return view('dashboard.product.index', ['products' => $products,'filter' => $filter]);
    }


    public function create()
    {
        $manufacturers = Manufacturer::all();
        $countries = Country::all();
        $categories = Category::all();
        $discounts = Discount::all();
        return view(
            'dashboard.product.create',
            compact('manufacturers', 'countries', 'categories', 'discounts')
        );
    }

    public function store(StoreProductRequest $request)
    {
        $this->productService->createProduct($request);
        return redirect()->route('product.index')->withToastSuccess('Product created successfully!');
    }


    public function show(Product $product)
    {
        //
    }


    public function edit(Product $product)
    {
        $manufacturers = Manufacturer::all();
        $countries = Country::all();
        $categories = Category::all();
        $discounts = Discount::all();
        return view('dashboard.product.edit', compact('product', 'manufacturers', 'countries', 'categories', 'discounts'));
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $this->productService->updateProduct($request, $product);
        return redirect()->route('product.index')->withToastSuccess('Product updated successfully!');
    }


    public function destroy(Product $product)
    {
        $this->productService->deleteProduct($product);
        return redirect()->route('product.index')->withToastSuccess('Product deleted successfully!');
    }

    public function productsByCategory(Request $request){
        return $this->productService->getProductsByCategory($request);
    }
}
