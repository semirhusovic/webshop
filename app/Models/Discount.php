<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Discount extends Model
{
    protected $guarded = [];
    protected $perPage = 5;
    public function promotions()
    {
        return $this->morphedByMany('App\Models\Promotion', 'discountable')->withTimestamps();
    }

    public function products()
    {
        return $this->morphedByMany('App\Models\Product', 'discountable')->withTimestamps();
    }
    /**
     * Check whether this discount is expired.
     *
     * return bool
     */
    public function expired()
    {
        // I assume that expired_at is also a Carbon instance.
        log::warning('---------'.Carbon::now());
        return Carbon::parse($this->expired_at) < Carbon::now();
    }

    /**
     * Return the discount amount for each product.
     *
     * @return double
     */
    public function apply(Product $product)
    {
        if ($this->type === 'numeric') {
            return $this->value;
        }

        if ($this->type === 'percentage') {
            return $product->productPrice * ($this->value / 100);
        }

        return 0;
    }
}
