<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Stock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    //test
    public function show($id)
    {
        $st = Stock::query()
                    ->where('product_id', '=', $id)
                    ->get();
        return $st;
    }
}
