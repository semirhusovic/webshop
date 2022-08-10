<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model implements TranslatableContract
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['title'];
    protected $with = ['translations','image'];
    protected $guarded = [];
    protected $perPage = 5;

    public function image()
    {
        return $this->morphMany('App\Models\Image', 'imageable');
    }
}
