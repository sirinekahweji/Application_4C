<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Specialite extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function departements() {
        return $this->belongsTo(Departement::class);
    }

    public function classes() {
        return $this->belongsTo(Classe::class);
    }
}
