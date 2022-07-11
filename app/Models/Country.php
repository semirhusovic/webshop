<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends Model implements TranslatableContract
{
    use HasFactory,Translatable;
    public $timestamps = false;
    public $translatedAttributes = ['countryName'];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
