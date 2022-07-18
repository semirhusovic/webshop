<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model  implements TranslatableContract
{
    use HasFactory,Translatable;
    protected $guarded = [];
    protected $perPage = 5;
    public $translatedAttributes = ['promotionName'];

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
    public function discounts()
    {
        return $this->morphToMany('App\Models\Discount', 'discountable');
    }

}

