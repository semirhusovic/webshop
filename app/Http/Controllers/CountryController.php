<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Models\Product;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $language = session('language') ? session('language') : 'en';
        $filter = $request->filter;
        if (!empty($filter)) {
            $countries = Country::query()
                ->whereHas('translations', function ($query) use ($filter, $language) {
                    $query->where('locale', '=', $language);
                    $query->where('countryName', 'like', '%'.$filter.'%');
                })
                ->paginate();
        } else {
            $countries = Country::query()->paginate();
        }



        return view('dashboard.country.index', ["countries" => $countries,'filter' => $filter]);
    }

    public function create()
    {
        return view('dashboard.country.create');
    }

    public function store(StoreCountryRequest $request)
    {
        Country::query()->create($request->all());
        return redirect()->route('country.index')->withToastSuccess('Country created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    public function edit(Country $country)
    {
        return view('dashboard.country.edit', ['country' => $country]);
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->updateOrFail($request->all());
        return redirect()->route('country.index')->withToastSuccess('Country updated successfully!');
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('country.index')->withToastSuccess('Country deleted successfully!');
    }
}
