<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded=[];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function roles() {
        return $this->belongsTo(Role::class);
    }

    public function reacts() {
        return $this->hasMany(React::class);
    }

    public function commentaires() {
        return $this->hasMany(Commentaire::class);
    }

    public function publications() {
        return $this->hasMany(Publication::class);
    }

    public function Recepteurmessages() {
        return $this->hasMany(Message::class);
    }

    public function EmetteurMessage() {
        return $this->hasMany(Message::class);
    }

    public function cv() {
        return $this->belongsTo(cv::class);
    }

    public function groupeManagers() {
        return $this->hasMany(GroupeManager::class);
    }

    public function demandeAcces() {
        return $this->hasMany(demandeAcce::class);
    }

    public function notifications() {
        return $this->hasMany(Notification::class);
    }

    public function attestations() {
        return $this->hasMany(Attestation::class);
    }

    public function badges() {
        return $this->hasMany(Badge::class);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
