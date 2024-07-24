<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Enseignant extends User
{
    use HasFactory;

    protected $guarded=[];

    public function departements() {
        return $this->belongsTo(Departement::class);
    }

    public function users() {
        return $this->belongsTo(User::class);
    }
}
