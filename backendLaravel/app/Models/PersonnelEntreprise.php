<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonnelEntreprise extends User
{
    use HasFactory;

    protected $guarded=[];

    public function entreprises() {
        return $this->belongsTo(Entreprise::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
