<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Certification;

class DashboardController extends Controller
{
    //show dashboard of admin with all the basic analytical data and counts
    public function index()
    {

        $certificateCount = Certification::count();

        return view('admin.dashboard', ['certificateCount' => $certificateCount]);
    }
}
