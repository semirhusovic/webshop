<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Discount;
use App\Models\Image;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->filter;
        if (!empty($filter)) {
            $products = Product::query()
                ->join('product_translations','products.id','=','product_id')
                ->where('productName', 'like', '%'.$filter.'%')
                ->where('locale','=',session('language'))
                ->paginate();
        } else {
            $products = Product::query()->paginate();
        }

//        $products = Product::query()->paginate();
        return view('dashboard.product.index',['products' => $products,'filter' => $filter]);
    }


    public function create()
    {
        $manufacturers = Manufacturer::all();
        $countries = Country::all();
        $categories = Category::all();
        $discounts = Discount::all();
        return view('dashboard.product.create',
            [
                'manufacturers' => $manufacturers,
                'countries' => $countries,
                'categories' => $categories,
                'discounts' => $discounts
            ]);
    }

    public function store(StoreProductRequest $request)
    {
        $product = Product::query()->create($request->except('image','category','discount'));
        $product->categories()->attach($request->category);
        if($request->has('discount')) {
        $product->discounts()->attach($request->discount);
        }
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
        return view('dashboard.product.edit',[
            'product' => $product,
            'manufacturers' => $manufacturers,
            'countries' => $countries,
            'categories' => $categories,
            'discounts' => $discounts
        ]);
    }


    public function update(UpdateProductRequest $request, Product $product)
    {
        $product->categories()->detach();
        $product->discounts()->detach($request->discount);
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

        $product->updateOrFail($request->except('image','category','discount'));
        $product->categories()->attach($request->category);
        if($request->has('discount')) {
            $product->discounts()->attach($request->discount);
        }
        return redirect()->route('product.index')->withToastSuccess('Product updated successfully!');
    }


    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->withToastSuccess('Product deleted successfully!');
    }
}
