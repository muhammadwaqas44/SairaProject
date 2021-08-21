<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\StudentServices;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function listStudents(Request $request,  StudentServices $studentServices)
    {
        $students = $studentServices->listStudents($request);
        return view('admin.students.index', ['title' => 'Students', 'students' => $students]);
    }

    public function submitStudent()
    {
        return view('admin.students.create', ['title' => 'Student']);
    }

    public function fetchStudents(Request $request, StudentServices $studentServices)
    {
        $students = $studentServices->fetchStudents($request);
        return $students;
    }
    public function storeStudent(Request $request, StudentServices $studentServices)
    {
        $students = $studentServices->storeStudent($request);
        return $students;
    }
}
