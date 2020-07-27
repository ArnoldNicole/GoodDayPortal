<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clas extends Model
{
	 use SoftDeletes;
	protected $guarded=[];
    public function teacher()
    {
    	return $this->belongsTo(Teacher::class);
    }
}
