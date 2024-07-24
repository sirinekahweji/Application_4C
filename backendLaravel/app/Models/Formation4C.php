<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Formation4C extends Formation
{
    use HasFactory;

    protected $guarded=[];

    public function sessions() {
        return $this->hasMany(session::class);
    }


}
