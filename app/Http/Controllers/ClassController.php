<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Clas;
use App\User;

class ClassController extends Controller
{
   public function __construct()
   {
   	return $this->middleware('auth');
   } 

   public function index(User $user)
   {
      $classes=Clas::where('teacher_id',$user->teacher->id)->paginate(12);
      return view('teacher.view_my_classes', compact('classes'));
   }

   public function store(User $user)
   { 

   	/*
   	To create a new class you must not have more than two classes unless for VIP
   	No duplicate class names;
   	Unique names etc
   	*/
   	$teacher=$user;
   	$teacherClasesCount=Clas::where('teacher_id', $teacher->id)->count();
   	if ($teacherClasesCount>1 AND $teacher->teacher->status=="Approved") {
   	   		return redirect()->back()->with('error','No more classes allowed for you, please upgrade to vip teacher');
   	   	} 
   	   	else{
   	   		return view('teacher.create_clas_form', compact('teacher'));
   	   	}  	
   	
   }

   public function create(){
      $data=request()->validate([
      "class_name" => ['required', 'string', 'max:25','unique:clas'],
      "decription" => ['required', 'string', 'max:100','unique:clas'],
      "max_pupils" => ['required','numeric',  'max:255'],
      "class_key" =>['required', 'string', 'alpha_dash', 'min:8', 'confirmed'],       
   ]);

   $teacher=auth()->user()->teacher;
   $teacher->clases()->create([
      'class_name'=>$data['class_name'],
      'decription'=>$data['decription'],
      'max_pupils'=>$data['max_pupils'],
      'class_key' => Hash::make($data['class_key']),
   ]);

   return redirect(route('myClasses',auth()->user()->id))->with('success','Successfully created your class. Share your class name and key with your learners to enable them join the class');
   }

   public function update(Clas $clas)
   {
      $data=request()->validate([            
            "decription" => ['required', 'string', 'max:100'],
            "max_pupils" => ['required','numeric',  'max:255'],
            "existing_class_key"=>['required', 'string', 'alpha_dash', 'min:8'],                   
         ]);
      if (Hash::check($data['existing_class_key'], $clas->class_key)) {
         $clas->update([
            'decription'=>$data['decription'],
            'max_pupils'=>$data['max_pupils'],            
         ]);
         return redirect()->back()->with('success','Class has been updated Successfully');
      }else{
         return redirect()->back()->with('error','Wrong class security key');
      }
      
   }

   public function fetch()
   {
      $classes=Clas::paginate(50);
      return view('classes.all');
   }
   public function delete(Clas $clas){
      if (Hash::check(request()->class_key, $clas->class_key)) {
        $clas->delete();
        return redirect(route('myClasses',auth()->user()->id))->with('success','Class Deleted');
      }else{
         return redirect()->back()->with('error','Incorrect Security Key supplied');
      }
   }
}
