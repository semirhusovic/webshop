<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Support\Facades\Log;

class Product extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    protected $guarded = [];
    public $timestamps = false;
    protected $perPage = 5;
    public $translatedAttributes = ['productName', 'productDescription'];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function images(){
        return $this->morphMany('App\Models\Image','imageable');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class);
    }

    public function users(){
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
        return $this->productPrice - $this->total_discount;
    }
}
