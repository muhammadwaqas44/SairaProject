<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        return view('pdf.certificate');
    }

    public function pdf(){
        ini_set('max_execution_time', 300); //300 seconds = 5 minutes
        $data =['hello'];
        $pdf = PDF::loadView('pdf.transcript', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('transcript.pdf');
    }
}
