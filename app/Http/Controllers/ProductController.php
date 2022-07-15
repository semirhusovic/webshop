<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Image;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Support\Facades\File;

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
        $categories = Category::all();
        return view('dashboard.product.create',['manufacturers' => $manufacturers,'countries' => $countries,'categories' => $categories]);
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::query()->create($request->except('image','category'));
        $product->categories()->attach($request->category);
        if($request->file('image')){
            foreach ($request->file('image') as $f) {
                $file= $f;
                $filename = date('YmdHi').$f->getClientOriginalName();
                $file-> move(public_path('public/img'), $filename);
                $image = Image::query()->create([
                    'imageable_id' => $product->id,
                    'imageable_type' => 'App\Models\Product',
                    'fileName' => $filename
                ]);
            }
        }
        return redirect()->route('product.index');
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
        return view('dashboard.product.edit',[
            'product' => $product,
            'manufacturers' => $manufacturers,
            'countries' => $countries,
            'categories' => $categories
        ]);
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
//        dd($request);
        $product->categories()->detach();
        if($request->file('image')){
            // Brisanje fajla
            foreach($product->images as $img) {
                if(File::exists('public/img/'. $img->fileName)){
                    File::delete('public/img/'. $img->fileName);
                }
                // Brisanje iz baze
                Image::destroy($img->id);
            }
                foreach ($request->file('image') as $f) {
                    $file= $f;
                    $filename = date('YmdHi').$f->getClientOriginalName();
                    $file-> move(public_path('public/img'), $filename);
                    $image = Image::query()->create([
                        'imageable_id' => $product->id,
                        'imageable_type' => 'App\Models\Product',
                        'fileName' => $filename
                    ]);
                }
            }

        $product->updateOrFail($request->except('image','category'));
        $product->categories()->attach($request->category);
        return redirect()->route('product.index');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index');
    }
}
