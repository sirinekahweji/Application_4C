<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function enseignants() {
        return $this->hasMany(Enseignant::class);
    }

    public function specialites() {
        return $this->hasMany(Specialite::class);
    }
}
