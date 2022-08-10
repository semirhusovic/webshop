<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Http\Requests\StoreCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Services\CountryService;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private $countryService;
    public function __construct(CountryService $service)
    {
        $this->countryService = $service;
    }


    public function index(Request $request)
    {
        $filter = $request->filter;
        $countries = $this->countryService->searchItems($request);
        return view('dashboard.country.index', ["countries" => $countries,'filter' => $filter]);
    }

    public function create()
    {
        return view('dashboard.country.create');
    }

    public function store(StoreCountryRequest $request)
    {
        $this->countryService->createCountry($request);
        return redirect()->route('country.index')->withToastSuccess('Country created successfully!');
    }

    public function edit(Country $country)
    {
        return view('dashboard.country.edit', compact('country'));
    }

    public function update(UpdateCountryRequest $request, Country $country)
    {
        $this->countryService->updateCountry($request, $country);
        return redirect()->route('country.index')->withToastSuccess('Country updated successfully!');
    }

    public function destroy(Country $country)
    {
        $this->countryService->deleteCountry($country);
        return redirect()->route('country.index')->withToastSuccess('Country deleted successfully!');
    }
}
