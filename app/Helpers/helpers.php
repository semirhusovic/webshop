<?php

use App\Models\Image;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;

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

function createSignature($method, $body, $contentType, $timestamp, $reqUri, $old=false)
{
    $bodyJson = str_replace("\r", "", $body);
    $hash =  $old ? md5($bodyJson) : hash('sha512', $bodyJson, false) ;
    Log::info('hash: '.$hash);
    Log::info($reqUri);
    $parts = array($method,$hash,$contentType,$timestamp,$reqUri);
    $str = implode("\n", $parts);
    $digest = hash_hmac('sha512', $str, 'Gmi2wSwAv14q3sEo9MBFvoXVpz3ZPK', true);
    return base64_encode($digest);
}
