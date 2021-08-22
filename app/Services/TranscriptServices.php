<?php


namespace App\Services;


use App\Models\Student;
use App\Models\Transcript;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use ConvertApi\ConvertApi;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TranscriptServices
{
    public function listTranscripts($request)
    {
        $transcripts = Transcript::orderBy('id', 'DESC');
        $transcripts = $transcripts->paginate(10);
        return $transcripts;
    }

    public function fetchTranscripts($request)
    {
        if ($request->ajax()) {
            $transcripts = Transcript::orderBy('id', 'DESC');
            $transcripts = $transcripts->paginate(10)->appends(request()->query());
            return $transcripts;
        }
    }

    public function storeTranscript($request)
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
            'total_marks' => $request->total_marks,
            'obtain_marks' => $request->obtain_marks,
            'cgpa' => $request->cgpa,
            'student_id' => $student->id,
            'admin_id' => Auth::user()->id,
        ];
        DB::beginTransaction();
        $transcript = Transcript::create($data);
        if ($transcript) {
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
            $path = public_path('pdf/transcript/');
            $fileName = $transcript->id . '.pdf';
            $pdf->save($path . '/' . $fileName);
            $transcript->update([
                'pdf_path' => 'pdf/transcript/' . $transcript->id . '.pdf',
            ]);
            $pathPDF = $path . '/' . $fileName;
            $pathImageSave = public_path('pdf_images/transcript/');
            ConvertApi::setApiSecret('lePkA1ojdD5mSKRd');
            $result = ConvertApi::convert('jpg', [
                'File' => $pathPDF,
            ], 'pdf'
            );
            $result->saveFiles($pathImageSave);
            $transcript->update([
                'pdf_image_path' => 'pdf_images/transcript/'. $transcript->id . '.jpg',
            ]);
            return redirect()->route('listCertificates')->with('success', 'Transcript Created Successfully.');
        } else {
            DB::rollback();
            return redirect()->back->with('error', 'Transcript Not Added.');
        }

    }
}
