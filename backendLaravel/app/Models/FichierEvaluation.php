<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FichierEvaluation extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function participantFormations() {
        return $this->belongsTo(participantFormation::class);
    }
}
