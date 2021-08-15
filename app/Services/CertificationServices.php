<?php


namespace App\Services;


use App\Models\Certification;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;
use Imagick;

class CertificationServices
{
    public function listCertificates($request)
    {
        $certifications = Certification::orderBy('id', 'DESC');
        $certifications = $certifications->paginate(10);
        return $certifications;
    }

    public function fetchAdmins($request)
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
            'registration_no' => 'required|string',
            'certification_no' => 'required|string',
            'candidate_name' => 'required|string|max:150',
            'guardian_name' => 'required|string|max:150',
            'class_name' => 'required|string',
            'started_year' => 'required|string',
            'result_notification_no' => 'required|string',
            'ended_year' => 'required|string',
            'total_marks' => 'required|numeric',
            'obtain_marks' => 'required|numeric',
            'cgpq' => 'required|numeric',
        ]);
        $data = [
            'registration_no' => $request->registration_no,
            'certification_no' => $request->certification_no,
            'candidate_name' => $request->candidate_name,
            'guardian_name' => $request->guardian_name,
            'class_name' => $request->class_name,
            'started_year' => $request->started_year,
            'ended_year' => $request->ended_year,
            'total_marks' => $request->total_marks,
            'obtain_marks' => $request->obtain_marks,
            'result_notification_no' => $request->result_notification_no,
            'cgpq' => $request->cgpq,
            'admin_id' => Auth::user()->id,
        ];
        DB::beginTransaction();
        $certificate = Certification::create($data);
        if ($certificate) {
            DB::commit();
            $bcrptyId = bcrypt($certificate->id);
            $certificate->update([
                'bcrypt_id' => $bcrptyId,
            ]);
            $qrCode = QrCode::size(500)
                ->format('png')
                ->generate($certificate->id, public_path('qr_images/' . $certificate->id . '.png'));
            $certificate->update([
                'qr_code_path' => 'qr_images/' . $certificate->id . '.png',
            ]);
            $dataPdf = [
                'registration_no' => $request->registration_no,
                'certification_no' => $request->certification_no,
                'candidate_name' => $request->candidate_name,
                'guardian_name' => $request->guardian_name,
                'class_name' => $request->class_name,
                'started_year' => $request->started_year,
                'ended_year' => $request->ended_year,
                'total_marks' => $request->total_marks,
                'obtain_marks' => $request->obtain_marks,
                'result_notification_no' => $request->result_notification_no,
                'marks_percentage' => ((int)$request->obtain_marks / (int)$request->total_marks) * 100,
                'cgpq' => $request->cgpq,
                'header_date' => Carbon::now()->format('d F y'),
                'footer_date' => Carbon::now()->format('d/m/Y'),
                'qr_code' => url('/') . '/public/qr_images/' . $certificate->id . '.png',
            ];
            $pdf = PDF::loadView('pdf.certificate', $dataPdf);
            $pdf->setPaper('A4', 'portrait');
            $path = public_path('pdf/');
            $fileName = $certificate->id . '.pdf';
            $pdf->save($path . '/' . $fileName);
            $certificate->update([
                'pdf_path' => 'pdf/' . $certificate->id . '.pdf',
            ]);
//            $imgExt = new Imagick();
//            $imgExt->readImage($path . '/' . $fileName);
//            $imgExt->writeImages($certificate->id . '.png', true);
            $pdfToImagePath = public_path('pdf_images');
            $imgExt = new \Spatie\PdfToImage\Pdf($path . '/' . $fileName);
            $imgExt->saveImage($pdfToImagePath);
            dd($imgExt);
            return redirect()->route('listCertificates')->with('success', 'Certificate Created Successfully.');
        } else {
            DB::rollback();
            return redirect()->back->with('error', 'Certificate Not Added.');
        }

    }
}
