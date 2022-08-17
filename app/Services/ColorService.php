<?php

namespace App\Services;

use App\Models\Color;
use App\Models\Country;

class ColorService
{
    public function searchItems($request)
    {
        $filter = $request->filter;
        $language = session('language') ? session('language') : 'en';
        return Color::query()
            ->when($request->filter, function ($query) use ($filter, $language) {
                $query->whereHas('translations', function ($query) use ($filter, $language) {
                    $query->where('locale', 'like', $language);
                    $query->where('color_name', 'like', '%'.$filter.'%');
                });
            })
            ->paginate();
    }

    public function createColor($request): void
    {
        Color::query()->create($request->all());
    }

    public function updateColor($request, $color): void
    {
        $color->updateOrFail($request->all());
    }

    public function deleteColor($color): void
    {
        $color->delete();
    }
}
