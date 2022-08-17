<?php

namespace App\Http\Controllers;

use App\Models\Color;
use App\Http\Requests\StoreColorRequest;
use App\Http\Requests\UpdateColorRequest;
use App\Services\ColorService;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    private $colorService;
    public function __construct(ColorService $service)
    {
        $this->colorService = $service;
    }
    public function index(Request $request)
    {
        $filter = $request->filter;
        $colors = $this->colorService->searchItems($request);
        return view('dashboard.color.index', ["colors" => $colors,'filter' => $filter]);
    }


    public function create()
    {
        return view('dashboard.color.create');
    }


    public function store(StoreColorRequest $request)
    {
        $this->colorService->createColor($request);
        return redirect()->route('color.index')->withToastSuccess('Color created successfully!');
    }


    public function show(Color $color)
    {
        //
    }


    public function edit(Color $color)
    {
        return view('dashboard.color.edit', compact('color'));
    }


    public function update(UpdateColorRequest $request, Color $color)
    {
        $this->colorService->updateColor($request, $color);
        return redirect()->route('color.index')->withToastSuccess('Color updated successfully!');
    }


    public function destroy(Color $color)
    {
        $this->colorService->deleteColor($color);
        return redirect()->route('color.index')->withToastSuccess('Color deleted successfully!');
    }
}
