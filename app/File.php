<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['url','user_id']; //Para que no me dee problemas de asignación masiva.

    public function user() {
        return $this->belongsTo('App/User'); //Relación uno a muchos inversa.
    }
}
