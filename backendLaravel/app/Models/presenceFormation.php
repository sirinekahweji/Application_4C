<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presenceFormation extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function sessions() {
        return $this->belongsTo(session::class);
    }

    
    public function users() {
        return $this->belongsTo(User::class);
    }
}
