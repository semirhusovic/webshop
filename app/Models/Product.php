<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Log;
use Kyslik\ColumnSortable\Sortable;

class Product extends Model implements TranslatableContract
{
    use HasFactory,Translatable,Sortable;

    protected $guarded = [];
    protected $perPage = 5;
    public $translatedAttributes = ['productName', 'productDescription'];
    protected $appends = array('total_price');
    protected $with = ['images','categories','promotions','discounts','manufacturer'];
//    public $sortable = ['productName', 'total_price','created_at','manufacturer_id'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function carts()
    {
        return $this->belongsToMany(Cart::class);
    }

    public function images()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function stock()
    {
        return $this->hasMany(Stock::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function promotions()
    {
        return $this->belongsToMany(Promotion::class);
    }

    public function discounts(): \Illuminate\Database\Eloquent\Relations\MorphToMany
    {
        return $this->morphToMany('App\Models\Discount', 'discountable');
    }
//    public function allDiscounts()
//    {
//        return $this->discounts
//            ->merge($this->promotions->first()->discounts)
//            ->unique();
//    }

    public function allDiscounts()
    {
        $promos = $this->promotions;
        $data = $this->discounts;
        foreach ($promos as $promo) {
            $data = $data
                ->merge($promo->discounts)
                ->unique();
        }
        return $data;
    }



    public function getTotalDiscountAttribute()
    {
        return $this->allDiscounts()
        ->reject
        ->expired()
        ->map
        ->apply($this)
        ->sum();
    }

    public function getTotalPriceAttribute()
    {
        return Number_format($this->productPrice - $this->total_discount, 2);
    }
}
