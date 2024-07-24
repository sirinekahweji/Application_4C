<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBadge extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function badges() {
        return $this->hasMany(Badge::class);
    }
}
