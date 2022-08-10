<?php

namespace App\Services;

use App\Models\Country;

class CountryService
{
    public function searchItems($request)
    {
        $filter = $request->filter;
        $language = session('language') ? session('language') : 'en';
        return Country::query()
        ->when($request->filter, function ($query) use ($filter, $language) {
            $query->whereHas('translations', function ($query) use ($filter, $language) {
                $query->where('locale', 'like', $language);
                $query->where('country_name', 'like', '%'.$filter.'%');
            });
        })
        ->paginate();
    }

    public function createCountry($request): void
    {
        Country::query()->create($request->all());
    }

    public function updateCountry($request, $country): void
    {
        $country->updateOrFail($request->all());
    }

    public function deleteCountry($country): void
    {
        $country->delete();
    }
}
