<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends User
{
    use HasFactory;

    protected $guarded=[];

    public function classes() {
        return $this->belongsTo(Classe::class);
    }

    public function users() {
        return $this->belongsTo(User::class);
    }
}
