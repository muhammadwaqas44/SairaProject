<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Transcript;
use Illuminate\Http\Request;
use App\Models\Certification;

class DashboardController extends Controller
{
    //show dashboard of admin with all the basic analytical data and counts
    public function index()
    {

        $certificateCount = Certification::count();
        $studentCount = Student::count();
        $transcriptCount = Transcript::count();

        return view('admin.dashboard', ['certificateCount' => $certificateCount, 'studentCount' => $studentCount, 'transcriptCount' => $transcriptCount]);
    }
}
