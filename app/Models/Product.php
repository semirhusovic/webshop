<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;

class Product extends Model implements TranslatableContract
{
    use HasFactory,Translatable;

    protected $guarded = [];
    public $timestamps = false;
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
}
