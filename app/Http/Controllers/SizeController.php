<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSizeRequest;
use App\Models\Size;
use App\Http\Requests\UpdateSizeRequest;
use App\Services\SizeService;
use Illuminate\Http\Request;

class SizeController extends Controller

{
    private $sizeService;

    public function __construct(SizeService $service)
    {
        $this->sizeService = $service;
    }

    public function index(Request $request)
    {
        $filter = $request->filter;
        $sizes = $this->sizeService->searchItems($request);
        return view('dashboard.size.index', compact('sizes', 'filter'));
    }

    public function create()
    {
        return view('dashboard.size.create');
    }

    public function store(StoreSizeRequest $request)
    {
        $this->sizeService->createSize($request);
        return redirect()->route('size.index')->withToastSuccess('Size created successfully!');
    }

    public function show(Size $size)
    {
        //
    }

    public function edit(Size $size)
    {
        return view('dashboard.size.edit', ['size' => $size]);
    }

    public function update(UpdateSizeRequest $request, Size $size)
    {
        $this->sizeService->updateSize($request, $size);
        return redirect()->route('size.index')->withToastSuccess('Size updated successfully!');
    }

    public function destroy(Size $size)
    {
        $this->sizeService->deleteSize($size);
        return redirect()->route('size.index')->withToastSuccess('Size deleted successfully!');
    }
}
