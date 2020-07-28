<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    protected $fillable = ['nombre','descripcion','course_id','isConfigurable',];

    public function notas_structures()
    {
    	return $this->hasMany('App\Nota_Structure');
    }

    public function course()
    {
    	return $this->belongsTo('App\Course');
    }

}
