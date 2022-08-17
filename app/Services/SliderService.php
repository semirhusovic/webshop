<?php

namespace App\Services;

use App\Models\Image;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SliderService
{
    public function createSlide(Request $request): void
    {
        DB::transaction(function () use ($request) {
            $created_slider = Slider::query()->create($request->except(['image']));
            uploadImages($request, 'App\Models\Slider', $created_slider->id);
        });
    }

    public function updateSlide(Request $request, Slider $slider): void
    {
        DB::transaction(function () use ($request, $slider) {
            if ($request->file('image')) {
                deleteImages($slider->image);
                uploadImages($request, 'App\Models\Slider', $slider->id);
            }
                $slider->updateOrFail($request->except('image'));
        });
    }

    public function deleteSlide($slider): void
    {
        DB::transaction(function () use ($slider) {
            $slider->delete();
            deleteImages($slider->image);
        });
    }
}
