<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Transcript;
use App\Services\TranscriptServices;
use Illuminate\Http\Request;

class TranscriptController extends Controller
{
    public function listTranscripts(Request $request, TranscriptServices $transcriptServices)
    {
        $transcripts = $transcriptServices->listTranscripts($request);
        return view('admin.transcripts.index', ['title' => 'Transcripts', 'transcripts' => $transcripts]);
    }

    public function submitTranscript()
    {
        $students = Student::all();

        return view('admin.transcripts.create', ['title' => 'Transcript','students'=>$students]);
    }

    public function fetchTranscripts(Request $request,  TranscriptServices $transcriptServices)
    {
        $transcripts = $transcriptServices->fetchTranscripts($request);
        return $transcripts;
    }
    public function storeTranscript(Request $request,  TranscriptServices $transcriptServices)
    {
        $transcripts = $transcriptServices->storeTranscript($request);
        return $transcripts;
    }
    public function checkPdf($id){
        $transcript = Transcript::where('id', $id)->firstOrFail();
        if ($transcript->pdf_path) {
            $file = public_path() .'/'. $transcript->pdf_path;
            return response()->download($file);
        } else {
            return 'File Does not Exist';
        }
    }

}
