<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Slider;
use App\Http\Requests\StoreSliderRequest;
use App\Http\Requests\UpdateSliderRequest;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
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
//        dd($request);
        if ($request->validated()['image']) {
            $file= $request->validated()['image'];
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/img'), $filename);
        }
//        $created_slider = Slider::query()->create(collect($validated)->except(['image'])->toArray());
        $created_slider = Slider::query()->create($request->except(['image']));

        $image = Image::query()->create([
            'imageable_id' => $created_slider->id,
            'imageable_type' => 'App\Models\Slider',
            'fileName' => $filename
        ]);

        return redirect()->route('slider.index')->withToastSuccess('Slide created successfully!');
    }

    public function edit(Slider $slider)
    {
        return view('dashboard.slider.edit', ['slider' => $slider]);
    }

    public function update(UpdateSliderRequest $request, Slider $slider)
    {
        if ($request->file('image')) {
            // Brisanje fajla
            if (File::exists('public/img/'. $slider->image->fileName)) {
                File::delete('public/img/'. $slider->image->fileName);
            }
            // Brisanje iz baze
            Image::destroy($slider->image->id);
            $file= $request->file('image');
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file-> move(public_path('public/img'), $filename);
            $image = Image::query()->create([
                'imageable_id' => $slider->id,
                'imageable_type' => 'App\Models\Slider',
                'fileName' => $filename
            ]);
        }
        $slider->updateOrFail($request->except('image'));
        return redirect()->route('slider.index')->withToastSuccess('Slide updated successfully!');
    }

    public function destroy(Slider $slider)
    {
        // Brisanje fajla
        if (File::exists('public/img/'. $slider->image->fileName)) {
            File::delete('public/img/'. $slider->image->fileName);
        }
        // Brisanje iz baze
        Image::destroy($slider->image->id);
        $slider->delete();
        return redirect()->route('slider.index')->withToastSuccess('Slide deleted successfully!');
    }
}
