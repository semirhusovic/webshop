<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Image;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('dashboard.product.index',['products' => $products]);
    }


    public function create()
    {
        $manufacturers = Manufacturer::all();
        $countries = Country::all();
        return view('dashboard.product.create',['manufacturers' => $manufacturers,'countries' => $countries]);
    }

    public function store(StoreProductRequest $request)
    {
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
        //
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
