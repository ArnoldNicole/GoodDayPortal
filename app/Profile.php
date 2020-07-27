<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
   protected $guarded=[];
   protected $appends=['is_teacher'];
   public function getIsTeacherAttribute()
   {
      $teacher = \App\Teacher::where('user_id',$this->user->id)->first();
   	if ($this->date_of_birth!="") {
   		$age=\Carbon\Carbon::parse($this->date_of_birth)->age;
   		if ($age>25 AND $teacher==null) {
   			return true;
   		}else{
            return false;
         }
   	}else{
   		return false;
   	}
   }
   public function user()
   { 
   	return $this->belongsTo(User::class); 
   }
}
