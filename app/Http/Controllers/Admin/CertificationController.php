<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.certifications.create', ['title' => 'Certification']);
    }

    public function fetchAdmins(Request $request, CertificationServices $certificationServices)
    {
        $certifications = $certificationServices->fetchAdmins($request);
        return $certifications;
    }
    public function storeCertificate(Request $request, CertificationServices $certificationServices)
    {
        $certifications = $certificationServices->storeCertificate($request);
        return $certifications;
    }
}
