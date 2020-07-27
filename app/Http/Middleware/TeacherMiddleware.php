<?php

namespace App\Http\Middleware;

use Closure;

class TeacherMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
     public function handle($request, Closure $next)
    {
        $user=$request->user();
        if ($user->teacher!=null){
            if ($user->teacher->status==="Approved") {
               return $next($request);
            }else{
                return redirect('/account')->with('error','You are a teacher, but seems your profile is not active');
            }
        }else{
            return redirect()->back()->with('error','Only teachers can access this resource');
        }
    }
}
