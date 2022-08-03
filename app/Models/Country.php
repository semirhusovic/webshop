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
    protected $with = ['translations'];
    protected $guarded = [];
    protected $perPage = 5;
    public $translatedAttributes = ['countryName'];

    public function products(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Product::class);
    }
}
