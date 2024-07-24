<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class participantFormation extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function formation4cs() {
        return $this->belongsTo(Formation4C::class);
    }

    
    public function users() {
        return $this->belongsTo(User::class);
    }

    public function fichierEvaluations() {
        return $this->belongsTo(FichierEvaluation::class);
    }
}
