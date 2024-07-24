<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $guarded=[];

    public function users() {
        return $this->belongsTo(User::class);
    }

    public function images() {
        return $this->hasMany(image::class);
    }

    public function videos() {
        return $this->hasMany(video::class);
    }

    public function commentaires() {
        return $this->hasMany(Commentaire::class);
    }

    public function reacts() {
        return $this->hasMany(React::class);
    }
}
