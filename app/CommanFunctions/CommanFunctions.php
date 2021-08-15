<?php

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

function sendApiSuccess($message, $data) {
    return Response::json(['status' => true, 'message' => $message, 'data' => $data], 200);
}

function sendApiError($message, $data) {
    return Response::json(['status' => false, 'message' => $message, 'data' => $data], 200);
}

function sendSuccess($message, $data = '') {
    return Response::json(array('status' => true, 'message' => $message, 'successData' => $data), 200, []);
}

function sendError($error_message, $code = '') {
    return Response::json(array('status' => false, 'message' => $error_message), 400);
}

function addFile($file, $path) {
    if ($file) {
        if ($file->getClientOriginalExtension() != 'exe') {
            $type = $file->getClientMimeType();
            if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/bmp') {
                $destination_path = $path;
                $extension = $file->getClientOriginalExtension();
                $fileName =  Str::random(15) . '.' . $extension;
                $img=Image::make($file);
                if(($img->filesize()/ 1000) > 2000){
                    Image::make($file)->save('public/'.$destination_path. $fileName, 30);
                    $file_path = $destination_path . $fileName;
                }else{
                    $file->move('public/' . $destination_path, $fileName);
                    $file_path = $destination_path . $fileName;}
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
function addFileName($file, $path,$name) {
    if ($file) {
        if ($file->getClientOriginalExtension() != 'exe') {
            $type = $file->getClientMimeType();
            if ($type == 'image/jpg' || $type == 'image/jpeg' || $type == 'image/png' || $type == 'image/bmp') {
                $destination_path = $path;
                $extension = $file->getClientOriginalExtension();
                $fileName =  $name .rand(1000, 9999) . '.' . $extension;
                $img=Image::make($file);
                if(($img->filesize()/ 1000) > 2000){
                    Image::make($file)->save('public/'.$destination_path. $fileName, 30);
                    $file_path = $destination_path . $fileName;
                }else{
                    $file->move('public/' . $destination_path, $fileName);
                    $file_path = $destination_path . $fileName;}
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
