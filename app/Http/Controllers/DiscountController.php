<?php

namespace App\Http\Controllers;

use App\Models\Discount;
use App\Models\Manufacturer;
use Illuminate\Http\Request;


class DiscountController extends Controller
{

    public function index(Request $request)
    {

        $filter = $request->filter;
        if (!empty($filter)) {
            $discounts = Discount::query()
                ->where('discountName', 'like', '%'.$filter.'%')
                ->paginate();
        } else {
            $discounts = Discount::query()->paginate();
        }
        return view('dashboard.discount.index',['discounts' => $discounts,'filter' => $filter ]);
    }


    public function create()
    {
        return view('dashboard.discount.create');
    }

    public function store(Request $request)
    {
        $discount = Discount::query()->create($request->all());
        return redirect()->route('discount.index')->withToastSuccess('Discount created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function edit(Discount $discount)
    {
        return view('dashboard.discount.edit',['discount' => $discount]);
    }

    public function update(Request $request, Discount $discount)
    {
        $discount->updateOrFail($request->all());
        return redirect()->route('discount.index')->withToastSuccess('Discount updated successfully!');
    }


    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('discount.index')->withToastSuccess('Discount deleted successfully!');
    }
}
