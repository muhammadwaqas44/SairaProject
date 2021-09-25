<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use Uuids;
    use HasFactory;
    protected $guarded = [''];
    protected $appends = ['qr_image'];

    public function getQrImageAttribute(){
        if ($this->qr_code_path) {
            $file_name = $this->qr_code_path;
            return checkImage('public/' . $file_name);
        }
        return null;
    }
}
