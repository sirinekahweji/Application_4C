<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entreprise extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function contacts() {
        return $this->hasMany(Contact::class);
    }

    public function personnel_entreprises() {
        return $this->hasMany(PersonnelEntreprise::class);
    }
}
