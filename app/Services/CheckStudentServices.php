<?php


namespace App\Services;

use App\Models\Certification;
use App\Models\Student;
use App\Models\Transcript;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class CheckStudentServices
{
    public function checkQrCode($request)
    {
        $checkData = $request->qrcode_value;
        $student = Student::where('bcrypt_id',$checkData)->first();
//        if ($checkData == 'a3a284c7-18ed-4b1f-abb3-26b954114d4e') {
        if ($student) {
            return response()->json(['result' => 'success', 'message' => 'Document is not forged.','data'=>$student]);
        } else {
            return response()->json(['result' => 'error', 'message' => 'Document is forged.']);
        }
    }

    public function checkImageDetail($request)
    {
        ini_set('max_execution_time', 300);
        $checkData = $request->id;
        $student = Student::where('id',$checkData)->first();
        if ($request->type == 'certificate'){
            $record = Certification::where('student_id',$student->id)->first();
        }else{
            $record = Transcript::where('student_id',$student->id)->first();
        }
        if (!$record) {
            return response()->json(['result' => 'error', 'message' => 'Document is forged. No Record Found']);
        }
        $data1 = 'public/'. $record->pdf_image_path;
        $check_image = $request->check_image;
        $imageName = time().'.'.$check_image->extension();
        $check_image->move(public_path('checks'), $imageName);
        $data2 = 'public/checks/'.$imageName;

        $data3 = 'public/check_images/' . $request->id . '-original.png';
        $data4 = 'public/check_images/' . $request->id . '-modified.png';
        $data5 = 'public/check_images/' . $request->id . '-diff.png';
        $data6 = 'public/check_images/' . $request->id . '-thresh.png';
        $process = new Process(['python', 'python_code/checkImage.py', "{$data1}", "{$data2}", "{$data3}", "{$data4}", "{$data5}", "{$data6}"]);
        $process->setTimeout(3600);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $afterArray = [
            'original' => 'public/'. $record->pdf_image_path,
            'modified' => 'public/check_images/' . $request->id . '-modified.png',
            'diff' => 'public/check_images/' . $request->id . '-diff.png',
            'thresh' => 'public/check_images/' . $request->id . '-thresh.png',
        ];
        $view_append = view('front.append_result', compact('afterArray'))->render();
        if ($process->getOutput()) {
            return response()->json(['result' => 'success', 'message' => 'Comparing Images Completed .', 'view_append' => $view_append]);
        } else {
            return response()->json(['result' => 'error', 'message' => 'Request Is not Submit']);
        }
    }
}
