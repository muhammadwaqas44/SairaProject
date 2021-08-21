<?php


namespace App\Services;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class CheckStudentServices
{
    public function checkQrCode($request)
    {
        $checkData = $request->qrcode_value;
        if ($checkData == 'a3a284c7-18ed-4b1f-abb3-26b954114d4e') {
            return response()->json(['result' => 'success', 'message' => 'Document is not forged.']);
        } else {
            return response()->json(['result' => 'error', 'message' => 'Document is forged.']);
        }
    }

    public function checkImageDetail($request)
    {
        ini_set('max_execution_time', 300);
        $data1 = 'public/pdf_images/3db2e2a9-adf9-457b-afdd-78db3b877544.jpg';
        $data2 = 'public/pdf_images/20beeccf-fd50-4267-907d-fd8304c8d6cf.jpg';

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
        if ($process->getOutput() != null) {
            return response()->json(['result' => 'success', 'message' => 'Comparing Images Completed .', 'view_append' => $view_append]);
        } else {
            return response()->json(['result' => 'error', 'message' => 'Request Is not Submit']);
        }
    }
}
