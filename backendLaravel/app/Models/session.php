<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class session extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function formation4cs() {
        return $this->belongsTo(Formation4C::class);
    }
}
