<?php

namespace App\Services;

use App\Models\Discount;

class DiscountService
{
    public function searchItems($request)
    {
        $filter = $request->filter;
        return Discount::query()
        ->when($request->filter, function ($query) use ($filter) {
            $query->where('discount_name', 'like', '%'.$filter.'%');
        })
        ->paginate();
    }

    public function createDiscount($request): void
    {
        Discount::query()->create($request->all());
    }

    public function updateDiscount($request, $discount): void
    {
        $discount->updateOrFail($request->all());
    }

    public function deleteDiscount($discount): void
    {
        $discount->delete();
    }
}
