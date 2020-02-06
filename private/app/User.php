<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'id_privilege', 'img',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    // Un usuario tiene un privilegion
    public function privilege() {
        return $this->belongsTo('App\Privilege', 'id_privilege');
    }
    
    // Un ponente realiza varias ponencias
    public function presentationsSpeaker() {
        return $this->hasMany('App\Presentation');
    }
    
    // Una asistente puede asistir a varias ponencias
    public function presentationsAssistant() {
        return $this->hasMany('App\AssistantPresentation');
    }
}
