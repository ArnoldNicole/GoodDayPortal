<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $guarded=[];
    public function user()
    {
    		return $this->belongsTo(User::class); 
    }

    public function clases()
    {
    	return $this->hasMany(Clas::class);
    }
    
}
