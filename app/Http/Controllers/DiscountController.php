<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDiscountRequest;
use App\Http\Requests\UpdateDiscountRequest;
use App\Models\Discount;
use App\Services\DiscountService;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    private $discountService;

    public function __construct(DiscountService $service)
    {
        $this->discountService = $service;
    }

    public function index(Request $request)
    {
        $filter = $request->filter;
        $discounts = $this->discountService->searchItems($request);
        return view('dashboard.discount.index', compact('discounts','filter'));
    }

    public function create()
    {
        return view('dashboard.discount.create');
    }

    public function store(StoreDiscountRequest $request)
    {
        $this->discountService->createDiscount($request);
        return redirect()->route('discount.index')->withToastSuccess('Discount created successfully!');
    }

    public function edit(Discount $discount)
    {
        return view('dashboard.discount.edit', ['discount' => $discount]);
    }

    public function update(UpdateDiscountRequest $request, Discount $discount)
    {
        $this->discountService->updateDiscount($request, $discount);
        return redirect()->route('discount.index')->withToastSuccess('Discount updated successfully!');
    }

    public function destroy(Discount $discount)
    {
        $this->discountService->deleteDiscount($discount);
        return redirect()->route('discount.index')->withToastSuccess('Discount deleted successfully!');
    }
}
