<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use App\Models\Student;
use App\Services\CertificationServices;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function listCertificates(Request $request, CertificationServices $certificationServices)
    {
        $certifications = $certificationServices->listCertificates($request);
        return view('admin.certifications.index', ['title' => 'Certifications', 'certifications' => $certifications]);
    }

    public function submitCertificate()
    {
        $students = Student::all();
        return view('admin.certifications.create', ['title' => 'Certification','students'=>$students]);
    }

    public function storeCertificate(Request $request, CertificationServices $certificationServices)
    {
        $certifications = $certificationServices->storeCertificate($request);
        return $certifications;
    }


    public function fetchCertification(Request $request, CertificationServices $certificationServices)
    {
        $certifications = $certificationServices->fetchCertification($request);
        return $certifications;
    }

    public function checkPdf($id){
        $certificate = Certification::where('id', $id)->firstOrFail();
        if ($certificate->pdf_path) {
            $file = public_path() .'/'. $certificate->pdf_path;
            return response()->download($file);
        } else {
            return 'File Does not Exist';
        }
    }

}
