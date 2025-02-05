<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class React extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function publications() {
        return $this->belongsTo(Publication::class);
    }
}
