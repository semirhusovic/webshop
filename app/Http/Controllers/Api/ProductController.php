<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::query()->with('images')->get();
        return $products;
    }


    public function create()
    {
        return view('dashboard.product.create');
    }

    public function store(StoreProductRequest $request)
    {
//        [
//            'productName' => $request->productName,
//            'productPrice' => $request->productPrice,
//            'productDiscountPrice' => $request->productDiscountPrice,
//            'productDescription' => $request->productDescription,
//            'productMonthsOfWarranty' => $request->productMonthsOfWarranty,
//            'productManufacturingDate' => $request->productManufacturingDate,
//            'country_id' => 1,
//            'manufacturer_id' => 1,
//        ]

        $pr = Product::query()->create($request->except('image'));

        if($request->file('image')){
            foreach ($request->file('image') as $f) {
                $file= $f;
                $filename = date('YmdHi').$f->getClientOriginalName();
                $file-> move(public_path('public/img'), $filename);
                $image = Image::query()->create([
                    'imageable_id' => $pr->id,
                    'imageable_type' => 'App\Models\Product',
                    'fileName' => $filename
                ]);
            }
        }

    }


    public function show(Product $product)
    {
        $id = $product->id;
        return Product::with('images')->findOrFail($id);
    }


    public function edit(Product $product)
    {
        //
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        //
    }


    public function destroy(Product $product)
    {
        $product->delete();
    }
}
