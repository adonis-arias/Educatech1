<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota_Value extends Model
{
	protected $table = "nota_values";
    protected $fillable = ['nota','nota_structure_id','student_id'];

    public function student()
    {
    	return $this->belongsTo('App\Student');
    }

    public function nota_structure()
    {
    	return $this->belongsTo('App\Nota_Structure');
    }
}
