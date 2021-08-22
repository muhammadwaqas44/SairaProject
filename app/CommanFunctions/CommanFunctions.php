<?php

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

function addFile($file, $path)
{
    if ($file) {
        if ($file->getClientOriginalExtension() != 'exe') {
            $type = $file->getClientMimeType();
            if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/bmp') {
                $destination_path = $path;
                if (!file_exists($destination_path)) {
                    mkdir($destination_path, 0777, true);
                }
                $extension = $file->getClientOriginalExtension();
                $fileName = Str::random(15) . '.' . $extension;
                $img = Image::make($file);
                if (($img->filesize() / 1000) > 2000) {
                    Image::make($file)->save('public/' . $destination_path . $fileName, 30);
                    $file_path = $destination_path . $fileName;
                } else {
                    $file->move('public/' . $destination_path, $fileName);
                    $file_path = $destination_path . $fileName;
                }
                return $file_path;
            } else {
                return FALSE;
            }
        } else {
            return FALSE;
        }
    } else {
        return FALSE;
    }
}

if (!function_exists('checkImage')) {

    function checkImage($path)
    {
        if (\File::exists($path)) {
            return asset($path);
        } else {
            $path = explode('/', $path);
            $place_holder = 'public/empty.png';
            if (count($path) > 0) {
                $path = $path[0];
            }
            return asset($place_holder);
        }
    }
}
