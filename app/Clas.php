<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clas extends Model
{
	protected $guarded=[];
    public function teacher()
    {
    	return $this->belongsTo(Teacher::class);
    }
}
