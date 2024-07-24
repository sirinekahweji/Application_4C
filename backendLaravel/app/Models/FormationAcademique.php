<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormationAcademique extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function cvs() {
        return $this->belongsTo(cv::class);
    }
}
