<?php

namespace App\Services;

use App\Models\Stock;

class StockService
{
    public function searchItems($request)
    {
        $filter = $request->filter;
        $language = session('language') ? session('language') : 'en';
        return Stock::query()
        ->when($request->filter, function ($query) use ($filter, $language) {
            $query->whereHas('product.translations', function ($query) use ($filter, $language) {
                $query->where('locale', 'like', $language);
                $query->where('product_name', 'like', '%'.$filter.'%');
            });
        })
        ->paginate();
    }

    public function createStockItem($request): void
    {
        Stock::query()->create($request->all());
    }

    public function updateStockItem($request, $stock): void
    {
        $stock->updateOrFail($request->all());
    }

    public function deleteStockItem($stock): void
    {
        $stock->delete();
    }
}
