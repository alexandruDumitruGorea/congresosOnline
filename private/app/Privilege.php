<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Privilege extends Model
{
    use SoftDeletes;

    protected $table = 'privilege';

    protected $hidden = ['created_at','updated_at'];

    protected $fillable = ['privilege_name'];

    // Un privilegio tiene varios usuarios
    public function users() {
        return $this->hasMany('App\Users');
    }
}
