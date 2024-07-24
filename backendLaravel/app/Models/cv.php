<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cv extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function competences() {
        return $this->hasMany(Competence::class);
    }

    public function langues() {
        return $this->hasMany(Langues::class);
    }

    public function formationAcademisue() {
        return $this->hasMany(FormationAcademique::class);
    }

    public function experiences() {
        return $this->hasMany(Experience::class);
    }

    public function formationObtenus() {
        return $this->hasMany(Formation::class);
    }

    public function certificatObtenus() {
        return $this->hasMany(Certificat::class);
    }

    public function interets() {
        return $this->hasMany(interet::class);
    }
}
