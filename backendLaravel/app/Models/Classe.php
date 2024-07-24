<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function etudiants() {
        return $this->hasMany(Etudiant::class);
    }

    public function specialtes() {
        return $this->belongsTo(Specialite::class);
    }
}
