<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Presentation extends Model
{
    use SoftDeletes;

    protected $table = 'presentation';

    protected $hidden = ['created_at','updated_at'];

    protected $fillable = ['title', 'description', 'extract', 'price', 'hour', 'video_url', 'id_congress', 'id_speaker'];

    // Una ponencia tiene un congreso
    public function congress() {
        return $this->belongsTo('App\Congress', 'id_congress');
    }
    
    // Una ponencia tiene un ponente
    public function speaker() {
        return $this->belongsTo('App\User', 'id_speaker');
    }
    
    // Una ponencia tiene varios asistentes
    public function assistants() {
        return $this->hasMany('App\AssistantPresentation');
    }
}
