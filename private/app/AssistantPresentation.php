<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssistantPresentation extends Model
{
    use SoftDeletes;

    protected $table = 'assistant_presentation';

    protected $hidden = ['created_at','updated_at'];

    protected $fillable = ['id_assistant', 'id_presentation', 'paid_out', 'document'];

    // Una asistencia tiene asistente
    public function assistant() {
        return $this->belongsTo('App\User', 'id_assistant');
    }
    
    // Una asistencia tiene una ponencia
    public function presentation() {
        return $this->belongsTo('App\Presentation', 'id_presentation');
    }
}
