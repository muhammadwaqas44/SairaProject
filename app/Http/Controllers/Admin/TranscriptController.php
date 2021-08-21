<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.certifications.create', ['title' => 'Certification']);
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
}
