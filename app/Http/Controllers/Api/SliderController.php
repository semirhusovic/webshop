<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index()
    {
        return Slider::query()->with('image')->where('isActive', '=', '1')->orderBy('position')->get();
    }
}
