<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CountryTranslation extends Model
{
    public $timestamps = false;
    protected $fillable = ['country_name'];
    use HasFactory;
}
