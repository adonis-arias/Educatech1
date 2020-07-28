<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Nota_Structure extends Model
{
	protected $table = "Notas_structures";
    protected $fillable = ['nombre','nota_id',];

    public function nota()
    {
    	return $this->belongsTo('App\Nota');
    }

    public function notas_values()
    {
    	return $this->hasMany('App\Nota_Value');
    }
}
