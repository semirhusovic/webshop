<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    protected $guarded = [];
    use HasFactory;
    const PENDING = 1;
    const ACCEPTED = 2;
    const SHIPPED = 3;
    const DELIVERED = 4;
    const ERROR = 5;
}
