<?php

namespace App\Models;

use App\Traits\Uuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use Uuids;
    use HasFactory;
    protected $guarded = [''];
    protected $appends = ['pdf_image'];

    public function student(){
        return $this->belongsTo(Student::class, 'student_id');
    }
    public function getPdfImageAttribute(){
        if ($this->pdf_image_path) {
            $file_name = $this->pdf_image_path;
            return checkImage('public/' . $file_name);
        }
        return null;
    }
}
