<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Teacher;

class TeachersController extends Controller
{
   public function __construct()
   {
   	return $this->middleware(['auth','admin']);
   }

   public function index()
   {
   	$teachers=Teacher::where('status','Approved')->with('user')->get();
   	return view('admin.validate_teachers', compact('teachers'));
   }

   public function update(Teacher $teacher)
   {
   	$teacher->update(['status'=>'Approved']);
   	return redirect()->back()->with('success', $teacher->user->name. 'Approved sucessfully, they can now use their account to post assignments');
   }

   public function show(){
   	$teachers=Teacher::where('status','Pending Validation')->with('user')->get();
   	return view('admin.validate_teachers', compact('teachers'));
   }

   public function store(Teacher $teacher)
   {
      $data=request()->validate([
         'certificate_name'=>['required','string'],
            'certificate_number'=>['required','string'],
            'favourite_subject'=>['required','string'],
            'national_id_number'=>['required','string'],
            'staff_number'=>['required','string'],
            
      ]);
      $teacher->update($data);
      return redirect()->back()->with('success','Update completed successfully');
   }
}
