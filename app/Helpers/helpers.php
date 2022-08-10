<?php

use App\Models\Image;
use Illuminate\Support\Facades\File;

function uploadImages($request, $imageable_type, $imageable_id): void
{
    if ($request->file('image')) {
        foreach ($request->file('image') as $file) {
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('public/img'), $filename);
            Image::query()->create([
                'imageable_id' => $imageable_id,
                'imageable_type' => $imageable_type,
                'file_name' => $filename
            ]);
        }
    }
}

function deleteImages($images):void
{
    foreach ($images as $img) {
        // Brisanje iz baze
        Image::destroy($img->id);
        // Brisanje fajla
        if (File::exists('public/img/'. $img->file_name)) {
            File::delete('public/img/'. $img->file_name);
        }
    }
}
