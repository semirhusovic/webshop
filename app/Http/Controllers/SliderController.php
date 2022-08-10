<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use App\Services\SliderService;


class SliderController extends Controller
{
    private $sliderService;

    public function __construct(SliderService $service)
    {
        $this->sliderService = $service;
    }

    public function index()
    {
        $sliders = Slider::query()->paginate();
        return view('dashboard.slider.index', ['sliders' => $sliders]);
    }

    public function create()
    {
        return view('dashboard.slider.create');
    }

    public function store(StoreSliderRequest $request)
    {
        $this->sliderService->createSlide($request);
        return redirect()->route('slider.index')->withToastSuccess('Slide created successfully!');
    }

    public function edit(Slider $slider)
    {
        return view('dashboard.slider.edit', ['slider' => $slider]);
    }

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        $this->sliderService->updateSlide($request, $slider);
        return redirect()->route('slider.index')->withToastSuccess('Slide updated successfully!');
    }

    public function destroy(Slider $slider)
    {
        $this->sliderService->deleteSlide($slider);
        return redirect()->route('slider.index')->withToastSuccess('Slide deleted successfully!');
    }
}
