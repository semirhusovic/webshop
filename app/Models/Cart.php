<?php

namespace App\Models;

use App\Traits\BelongToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    use BelongToUser;

    protected $guarded = [];

    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('quantity');
    }


    public function stocks()
    {
        return $this->belongsToMany(Stock::class)->withPivot('quantity');
    }

}
