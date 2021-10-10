<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\Student;
use App\Services\CheckStudentServices;
use ConvertApi\ConvertApi;
use Illuminate\Http\Request;

class CheckStudentController extends Controller
{
    public function checkQrCode(Request $request, CheckStudentServices $checkStudentServices)
    {
        $checkData = $checkStudentServices->checkQrCode($request);
        return $checkData;
    }

    public function afterQrCode($id)
    {
        $student = Student::where('id', $id)->first();
        return view('front.studentDetails', compact('student'));
    }

    public function checkImageDetail(Request $request, CheckStudentServices $checkStudentServices)
    {
        $checkData = $checkStudentServices->checkImageDetail($request);
        return $checkData;
    }

//    public function pdftoimage()
//    {
//
//        $certificates = Certification::all();
//        foreach ($certificates as $certificate) {
//            $pathPDF = 'public/' . $certificate->pdf_path;
//            ConvertApi::setApiSecret('lePkA1ojdD5mSKRd');
//            $result = ConvertApi::convert('jpg', [
//                'File' => $pathPDF,
//            ], 'pdf'
//            );
//            $fileNameImg = $certificate->id . '.png';
//            $pathImageSave = public_path('pdf_images/certificates/');
//            $result->saveFiles($pathImageSave.$fileNameImg);
//            $certificate->update([
//                'pdf_image_path' => 'pdf_images/certificates/' . $certificate->id . '.jpg',
//            ]);
//        }
//        return true;
//    }
}
