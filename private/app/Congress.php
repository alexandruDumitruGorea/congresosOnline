<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Congress extends Model
{
    use SoftDeletes;

    protected $table = 'congress';

    protected $hidden = ['created_at','updated_at'];

    protected $fillable = ['title', 'description', 'date'];

    // Un congreso tiene varias ponencias
    public function presentations() {
        return $this->hasMany('App\Presentation');
    }
}
