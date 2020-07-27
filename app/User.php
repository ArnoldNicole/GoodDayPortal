<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    protected $appends = ['is_admin','is_verified_teacher'];
    protected static function boot(){
       parent::boot();

       static::created(function ($user){
           $user->profile()->create([
               'username'=>$user->email,
           ]);
           
           });
       }

       public function getIsAdminAttribute()
       {
        
        if ($this->admin=="true") {
         return true;
        }else{
          return false;
        }
        
       // return true;
       }

        public function getIsVerifiedTeacherAttribute()
       {
        $teacher = $this->teacher;
        if ($teacher) {
         if ($this->teacher->status=="Approved") {
           return true;
         }else{
          return false;
         }
        }else{
          return false;
        }
       }

      public function profile(){
        return $this->hasOne(Profile::class);
    }

    public function teacher(){
        return $this->hasOne(Teacher::class);
    }
}
