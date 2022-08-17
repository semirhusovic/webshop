<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }

//    public function products()
//    {
//        return $this->hasManyThrough(Product::class, Stock::class, 'product_id', 'id', 'id', 'id');
//    }

    public function stocks()
    {
        return $this->belongsToMany(Stock::class)->withPivot('quantity');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
