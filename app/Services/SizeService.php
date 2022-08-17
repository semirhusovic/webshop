<?php

namespace App\Services;

use App\Models\Size;

class SizeService
{
    public function searchItems($request)
    {
        $filter = $request->filter;
        return Size::query()
        ->when($request->filter, function ($query) use ($filter) {
            $query->where('size_name', 'like', '%'.$filter.'%');
        })
        ->paginate();
    }

    public function createSize($request): void
    {
        Size::query()->create($request->all());
    }

    public function updateSize($request, $size): void
    {
        $size->updateOrFail($request->all());
    }

    public function deleteSize($size): void
    {
        $size->delete();
    }
}
