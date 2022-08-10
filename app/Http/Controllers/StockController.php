<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use App\Models\Slider;
use App\Models\Stock;
use App\Http\Requests\StoreStockRequest;
use App\Http\Requests\UpdateStockRequest;
use App\Services\StockService;
use Database\Seeders\ColorSeeder;
use Illuminate\Http\Request;

class StockController extends Controller
{
    private $stockService;

    public function __construct(StockService $service)
    {
        $this->stockService = $service;
    }

    public function index(Request $request)
    {
        $filter = $request->filter;
        $stocks = $this->stockService->searchItems($request);
        return view('dashboard.stock.index', compact('stocks','filter'));
    }

    public function create()
    {
        $products = Product::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('dashboard.stock.create', compact('products', 'sizes', 'colors'));
    }

    public function store(StoreStockRequest $request)
    {
        $this->stockService->createStockItem($request);
        return redirect()->route('stock.index')->withToastSuccess('Item stock created successfully!');
    }

    public function show(Stock $stock)
    {
        //
    }

    public function edit(Stock $stock)
    {
        $products = Product::all();
        $sizes = Size::all();
        $colors = Color::all();
        return view('dashboard.stock.edit', compact('stock', 'products', 'sizes', 'colors'));
    }

    public function update(UpdateStockRequest $request, Stock $stock)
    {
        $this->stockService->updateStockItem($request, $stock);
        return redirect()->route('stock.index')->withToastSuccess('Item stock updated successfully!');
    }

    public function destroy(Stock $stock)
    {
        $this->stockService->deleteStockItem($stock);
        return redirect()->route('stock.index')->withToastSuccess('Item stock deleted successfully!');
    }
}
