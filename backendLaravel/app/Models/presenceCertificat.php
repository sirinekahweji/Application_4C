<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class presenceCertificat extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function certificat4cs() {
        return $this->belongsTo(certificat4c::class);
    }

    
    public function users() {
        return $this->belongsTo(User::class);
    }
}
