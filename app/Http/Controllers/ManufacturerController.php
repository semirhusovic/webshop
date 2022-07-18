<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\Manufacturer;
use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;

class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::query()->paginate();
        return view('dashboard.manufacturer.index',["manufacturers" => $manufacturers]);
    }

    public function create()
    {
        return view('dashboard.manufacturer.create');
    }

    public function store(StoreManufacturerRequest $request)
    {
        $newCountry = Manufacturer::query()->create($request->all());
        return redirect()->route('manufacturer.index');
    }
    public function show(Manufacturer $manufacturer)
    {
        //
    }

    public function edit(Manufacturer $manufacturer)
    {
        return view('dashboard.manufacturer.edit',['manufacturer' => $manufacturer]);
    }

    public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $manufacturer->updateOrFail($request->all());
        return redirect()->route('manufacturer.index');

    }

    public function destroy(Manufacturer $manufacturer)
    {
        $manufacturer->delete();
        return redirect()->route('manufacturer.index');
    }
}
