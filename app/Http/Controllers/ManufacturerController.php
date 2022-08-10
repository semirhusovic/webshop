<?php

namespace App\Http\Controllers;

use App\Models\Manufacturer;
use App\Http\Requests\StoreManufacturerRequest;
use App\Http\Requests\UpdateManufacturerRequest;
use App\Services\ManufacturerService;
use Illuminate\Http\Request;

class ManufacturerController extends Controller
{
    private $manufacturerService;

    public function __construct(ManufacturerService $service)
    {
        $this->manufacturerService = $service;
    }

    public function index(Request $request)
    {
        $filter = $request->filter;
        $manufacturers = $this->manufacturerService->searchItems($request);
        return view('dashboard.manufacturer.index', compact('manufacturers', 'filter'));
    }

    public function create()
    {
        return view('dashboard.manufacturer.create');
    }

    public function store(StoreManufacturerRequest $request)
    {
        $this->manufacturerService->createManufacturer($request);
        return redirect()->route('manufacturer.index')->withToastSuccess('Manufacturer created successfully!');
    }
    public function show(Manufacturer $manufacturer)
    {
        //
    }

    public function edit(Manufacturer $manufacturer)
    {
        return view('dashboard.manufacturer.edit', ['manufacturer' => $manufacturer]);
    }

    public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
    {
        $this->manufacturerService->updateManufacturer($request, $manufacturer);
        return redirect()->route('manufacturer.index')->withToastSuccess('Manufacturer updated successfully!');
    }

    public function destroy(Manufacturer $manufacturer)
    {
        $this->manufacturerService->deleteManufacturer($manufacturer);
        return redirect()->route('manufacturer.index')->withToastSuccess('Manufacturer deleted successfully!');
    }
}
