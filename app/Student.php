<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['nombre','apellidos','direccion','email'];
    
    public function courses()
    {
    	return $this->belongsToMany('App\Course','courses_students')
    	             ->withTimestamps();
    }

    public function notas_values()
    {
        return $this->hasMany('App\Nota_Value');
    }
}
