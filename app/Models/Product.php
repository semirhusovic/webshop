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
    public $translatedAttributes = ['product_name', 'product_description'];
    protected $appends = array('total_price');
    protected $with = ['images','categories','promotions','discounts','manufacturer','translation'];
    public $sortable = ['product_manufacturing_date','product_price','total_price','created_at','manufacturer_id'];

    public function categories(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function carts(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Cart::class);
    }

    public function images(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function stock(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Stock::class);
    }

    public function manufacturer(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Manufacturer::class);
    }


    public function promotions(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
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

    public function getTotalPriceAttribute(): string
    {
        return Number_format($this->product_price - $this->total_discount, 2);
    }

    public function nameSortable($query, $direction)
    {
        $language = session('language') ? session('language') : 'en';
        return $query->join('product_translations', 'products.id', '=', 'product_translations.product_id')
            ->where('locale', '=', $language)
            ->orderBy('product_name', $direction)
            ->select('products.*');
    }

    public function manufacturerSortable($query, $direction)
    {
        return $query->join('manufacturers', 'products.manufacturer_id', '=', 'manufacturers.id')
            ->orderBy('manufacturer_name', $direction)
            ->select('products.*');
    }

}
