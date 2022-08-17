<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model implements TranslatableContract
{
    use HasFactory,Translatable;
    protected $with = ['translations'];
    public $translatedAttributes = ['color_name'];
    protected $guarded = [];
    protected $perPage = 5;

    public function stocks(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Stock::class);
    }
}
