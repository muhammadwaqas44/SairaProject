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
        $student = Student::find($checkData);
        if ($checkData == 'a3a284c7-18ed-4b1f-abb3-26b954114d4e') {
//        if ($student) {
            return response()->json(['result' => 'success', 'message' => 'Document is not forged.']);
        } else {
            return response()->json(['result' => 'error', 'message' => 'Document is forged.']);
        }
    }

    public function checkImageDetail($request)
    {
        ini_set('max_execution_time', 300);

        if ($request->type == 'certificate'){
            $record = Certification::where('student_id',$request->id)->first();
        }else{
            $record = Transcript::where('student_id',$request->id)->first();

        }
        if (!$record) {
            return response()->json(['result' => 'error', 'message' => 'Document is forged. No Record Found']);
        }
        $data1 = 'public/'. $record->pdf_image_path;
        $check_image = $request->check_image;
        $imageName = time().'.'.$request->image->extension();
        $check_image->move(public_path('checks'), $imageName);
        $data2 = 'public/checks/'.$imageName;

        $data3 = 'public/check_images/' . $request->id . '-original.jpg';
        $data4 = 'public/check_images/' . $request->id . '-modified.jpg';
        $data5 = 'public/check_images/' . $request->id . '-diff.jpg';
        $data6 = 'public/check_images/' . $request->id . '-thresh.jpg';

        $process = new Process(['python', 'python_code/checkImage.py', "{$data1}", "{$data2}", "{$data3}", "{$data4}", "{$data5}", "{$data6}"]);
        $process->setTimeout(3600);
        $process->run();

        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $afterArray = [
            'original' => 'public/check_images/' . $request->id . '-original.jpg',
            'modified' => 'public/check_images/' . $request->id . '-modified.jpg',
            'diff' => 'public/check_images/' . $request->id . '-diff.jpg',
            'thresh' => 'public/check_images/' . $request->id . '-thresh.jpg',
        ];
        $view_append = view('front.append_result', compact('afterArray'))->render();
        if ($process->getOutput()) {
            return response()->json(['result' => 'success', 'message' => 'Comparing Images Completed .', 'view_append' => $view_append]);
        } else {
            return response()->json(['result' => 'error', 'message' => 'Request Is not Submit']);
        }
    }
}
