<?php


namespace App\Services;


use App\Models\Certification;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;
use Imagick;
use Spatie\PdfToImage\Pdf as Change;
use \ConvertApi\ConvertApi;


class CertificationServices
{
    public function listCertificates($request)
    {
        $certifications = Certification::orderBy('id', 'DESC');
        $certifications = $certifications->paginate(10);
        return $certifications;
    }

    public function fetchCertification($request)
    {
        if ($request->ajax()) {
            $certifications = Certification::orderBy('id', 'DESC');
            $certifications = $certifications->paginate(10)->appends(request()->query());
            return $certifications;
        }
    }

    public function storeCertificate($request)
    {
        ini_set('max_execution_time', 300);
        $request->validate([
            'student_id' => 'required',
            'total_marks' => 'required|numeric',
            'obtain_marks' => 'required|numeric',
            'cgpa' => 'required|numeric',
        ]);
        $student = Student::find($request->student_id);
        $data = [
            'certification_no' => 'CN/'.$student->student_unique_no,
            'total_marks' => $request->total_marks,
            'obtain_marks' => $request->obtain_marks,
            'cgpa' => $request->cgpa,
            'student_id' => $student->id,
            'admin_id' => Auth::user()->id,
        ];
        DB::beginTransaction();
        $certificate = Certification::create($data);
        if ($certificate) {
            DB::commit();
            $dataPdf = [
                'registration_no' => $student->registration_no,
                'certification_no' => 'CN/'.$student->student_unique_no,
                'candidate_name' => $student->candidate_name,
                'guardian_name' => $student->guardian_name,
                'class_name' => $student->class_name,
                'started_year' => Carbon::parse($student->started_date)->format('Y'),
                'ended_year' => Carbon::parse($student->ended_date)->format('Y'),
                'total_marks' => $request->total_marks,
                'obtain_marks' => $request->obtain_marks,
                'result_notification_no' => $student->result_notification_no,
                'marks_percentage' => round(((int)$request->obtain_marks / (int)$request->total_marks) * 100),
                'cgpq' => $request->cgpa,
                'header_date' => Carbon::now()->format('d F y'),
                'footer_date' => Carbon::now()->format('d/m/Y'),
                'qr_code' => url('/') . '/public/qr_images/' . $student->id . '.png',
            ];
            $pdf = PDF::loadView('pdf.certificate', $dataPdf);
            $pdf->setPaper('A4', 'portrait');
            $path = public_path('pdf/certificates/');
            $fileName = $certificate->id . '.pdf';
            $fileNameImg = $certificate->id . '.png';
            $pdf->save($path . '/' . $fileName);
            $certificate->update([
                'pdf_path' => 'pdf/certificates/' . $certificate->id . '.pdf',
            ]);
            $pathPDF = $path . '/' . $fileName;
            $pathImageSave = public_path('pdf_images/certificates/');
            if( is_dir($pathImageSave) === false )
            {
                mkdir($pathImageSave);
            }
//            $pdf = new Spatie\PdfToImage\Pdf($pathPDF);
//            $pdf = new Change($pathPDF);;
//            $pdf->saveImage($pathImageSave);

//            $imagick = new Imagick();
//
//            $imagick->readImage($pathPDF);
//
//            $imagick->writeImages($pathImageSave.'/'.$fileNameImg, true);

            ConvertApi::setApiSecret('lePkA1ojdD5mSKRd');
            $result = ConvertApi::convert('jpg', [
                'File' => $pathPDF,
            ], 'pdf'
            );
            $result->saveFiles($pathImageSave.$fileNameImg);
            $certificate->update([
                'pdf_image_path' => 'pdf_images/certificates/'. $certificate->id . '.png',
            ]);
            return redirect()->route('listCertificates')->with('success', 'Certificate Created Successfully.');
        } else {
            DB::rollback();
            return redirect()->back->with('error', 'Certificate Not Added.');
        }

    }
}
