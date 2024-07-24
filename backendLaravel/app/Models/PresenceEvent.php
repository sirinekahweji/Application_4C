<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PresenceEvent extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function evenements() {
        return $this->belongsTo(Evenement::class);
    }

    public function users() {
        return $this->belongsTo(User::class);
    }
}
