<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Teacher;
use App\Profile;
class ProfileController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
	}
   public function update(User $user){
   	$data=request()->validate([
   	'name' => ['required','string'],
   	'username' =>['required','string'],
   	'date_of_birth' =>['required','date','before:today'], 
   	'recovery_email' =>['required','email','unique:users'], 
   	'bio' =>  ['required','string'],
   	'today'=>['date'],
   ]);
   	//update the user
   	$user->update([
   		'name'=>$data['name']
   	]);
   	$user->profile->update([
   		'username'=>$data['username'],
   		'date_of_birth'=>$data['date_of_birth'],
   		'recovery_email'=>$data['recovery_email'],
   		'bio'=>$data['bio'],
   	]);
   	
   	return redirect()->back()->with('success','Your profile was updated successfully.');

   }

   public function create(Profile $profile){
      $data=request()->validate([
         'certificate_name'=>['string','required'],
         'certificate_number'=>['string','required','unique:teachers'],
         'favourite_subject'=>['string','required'],
         'national_id_number'=>['string','required'],
         'staff_number'=>['string','required'],
      ]);
      //if the teacher has a profile, update else insert new
      $teacher=Teacher::where('user_id',$profile->user_id)->first();
      if ($teacher) {
         $teacher->update($data);
      }else{
         $profile->user->teacher()->create($data);
      }

      return redirect()->back()->with('success','Teacher account profile created successfully, Pending Approval');

   }
}
