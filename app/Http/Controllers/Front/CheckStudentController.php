<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Services\CheckStudentServices;
use Illuminate\Http\Request;

class CheckStudentController extends Controller
{
    public function checkQrCode(Request $request, CheckStudentServices $checkStudentServices)
    {
        $checkData = $checkStudentServices->checkQrCode($request);
        return $checkData;
    }
    public function afterQrCode($id){
        return view('front.studentDetails');
    }

    public function checkImageDetail(Request $request, CheckStudentServices $checkStudentServices)
    {
        $checkData = $checkStudentServices->checkImageDetail($request);
        return $checkData;
    }
}
