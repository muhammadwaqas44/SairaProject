<?php


namespace App\Services;


use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class StudentServices
{
    public function listStudents($request)
    {
        $students = Student::orderBy('id', 'DESC');
        $students = $students->paginate(10);
        return $students;
    }

    public function fetchStudents($request)
    {
        if ($request->ajax()) {
            $students = Student::orderBy('id', 'DESC');
            $students = $students->paginate(10)->appends(request()->query());
            return $students;
        }
    }

    public function storeStudent($request)
    {
        ini_set('max_execution_time', 300);
        $request->validate([
            'email' => "required|unique:users,email,",
            'candidate_name' => 'required|string|max:150',
            'guardian_name' => 'required|string|max:150',
            'class_name' => 'required|string',
            'department_name' => 'required|string',
            'started_year' => 'required|string',
            'ended_year' => 'required|string',
            'phone' => 'required',
            'address' => 'required',
            'profile_image' => 'mimes:jpeg,jpg,png|required|max:2000',
            'cnic' => 'required',
            'date_of_birth' => 'required',
            'name_campus' => 'required',
            'batch_no' => 'required',
            'registration_no' => 'required',
        ]);
        $data = [
            'email' => $request->email,
            'password' => Hash::make('123456'),
            'candidate_name' => $request->candidate_name,
            'guardian_name' => $request->guardian_name,
            'class_name' => $request->class_name,
            'department_name' => $request->department_name,
            'started_date' => $request->started_year,
            'ended_date' => $request->ended_year,
            'phone' => $request->phone,
            'address' => $request->address,
            'profile_image' => addFile($request->profile_image, 'students/images/'),
            'cnic' => $request->cnic,
            'date_of_birth' => $request->date_of_birth,
            'name_campus' => $request->name_campus,
            'batch_no' => $request->batch_no,
            'registration_no' => $request->registration_no,
            'admin_id' => Auth::user()->id,
        ];
        DB::beginTransaction();
        $student = Student::create($data);
        if ($student) {
            DB::commit();
            $bcrptyId = bcrypt($student->id);
            $student->update([
                'bcrypt_id' => $bcrptyId,
            ]);
            $qrCode = QrCode::size(500)
                ->format('png')
                ->generate($student->bcrypt_id, public_path('qr_images/' . $student->id . '.png'));
            $student->update([
                'qr_code_path' => 'qr_images/' . $student->id . '.png',
            ]);
            $studentFinal = Student::find($student->id);

            $student->result_notification_no = 'RNN/' . $studentFinal->student_unique_no;
            $student->save();
            return redirect()->route('listStudents')->with('success', 'Student Created Successfully.');
        } else {
            DB::rollback();
            return redirect()->back->with('error', 'Student Not Added.');
        }

    }
}
