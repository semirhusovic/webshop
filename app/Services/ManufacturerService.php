<?php

namespace App\Services;

use App\Models\Manufacturer;

class ManufacturerService
{
    public function searchItems($request)
    {
        $filter = $request->filter;
        return Manufacturer::query()
        ->when($request->filter, function ($query) use ($filter) {
            $query->where('manufacturer_name', 'like', '%'.$filter.'%');
        })
        ->paginate();
    }

    public function createManufacturer($request): void
    {
        Manufacturer::query()->create($request->all());
    }

    public function updateManufacturer($request, $manufacturer): void
    {
        $manufacturer->updateOrFail($request->all());
    }

    public function deleteManufacturer($manufacturer): void
    {
        $manufacturer->delete();
    }
}
