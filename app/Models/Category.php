<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model implements TranslatableContract
{
    use HasFactory,Translatable;
    public $translatedAttributes = ['categoryName'];


    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function subcategories()
    {
        return $this->hasMany(Category::class)->with(['subcategories' => function($query) {
            $query->withCount('products');
        }]);
    }
}
