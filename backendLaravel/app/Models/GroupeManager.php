<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GroupeManager extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function users() {
        return $this->belongsTo(User::class);
    }
}
