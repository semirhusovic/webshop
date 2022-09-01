<?php

namespace App\Models;

use App\Traits\BelongToUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    use BelongToUser;
    protected $perPage = 5;
    protected $guarded = [];
    protected $with = ['user','status','invoice','stocks'];


    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function stocks()
    {
        return $this->belongsToMany(Stock::class)->withPivot('quantity');
    }

    public function scopeActive($query)
    {
        $query->where('status_id', '!=', 1);
    }
}
