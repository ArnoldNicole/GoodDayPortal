<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clas extends Model
{
	 use SoftDeletes;
	protected $guarded=[];
    protected $hidden = [
        'class_key'
    ];
    public function teacher()
    {
    	return $this->belongsTo(Teacher::class);
    }
    
    public function members()
    {
    	return $this->hasMany(Profile::class);
    }
}
