<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;

class CountryController extends Controller
{

    public function index()
    {
        $countries = Country::query()->paginate();
        return view('dashboard.country.index',["countries" => $countries]);
    }

    public function create()
    {
        return view('dashboard.country.create');
    }

    public function store(StoreCountryRequest $request)
    {
        $newCountry = Country::query()->create($request->all());
        return redirect()->route('country.index');
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
        return view('dashboard.country.edit',['country' => $country]);
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $country->updateOrFail($request->all());
    }

    public function destroy(Country $country)
    {
        $country->delete();
        return redirect()->route('country.index');
    }
}
