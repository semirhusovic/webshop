<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $with = ['color','product','size'];
    protected $guarded = [];
    protected $perPage = 5;

    protected static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        static::addGlobalScope('quantity', function (Builder $builder) {
            $builder->where('stocks.quantity', '>', 0);
        });
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
