<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Course;
use App\Stage;
use App\Classroom;
use App\Level;

class HomeController extends Controller
{
    public function view($courseId,$classId) {

        try {
            $user = auth()->userOrFail();
        } catch (\Tymon\JWTAuth\Exceptions\UserNotDefinedException $e) {
            return response()->json('Unauthorized',401);
        }
        
        $class=Classroom::find($classId);
        $course=Course::find($courseId);

        if(!$class) 
            return response()->json('Targeted classroom not found',401);

        else {
            $count = DB::table('courses_classrooms')->where('classroom_id', $classId)->where('course_id', $courseId)->count();
            if($count==1) {
                $stages=[];
                $enabledLevels=array();
                
                if($user->levels->count()!=0) {
                    foreach($course->stages as $stage) {   
                        foreach($stage->levels as $level) {
                            $stageLevels[]=$level->name;  
                        }
                        $stages[] = [
                            'name' => $stage->name,
                            'levels' => $stageLevels
                        ];
                        $stageLevels=[];
                        foreach($user->levels as $level){
                            if($level->status()==1 and $level->stage_id==$stage->id){
                                array_push($enabledLevels,$level->name);
                            }
                        }
                    }
                }

                $courseResult = [
                    'Name' => $course->name,
                    'Stages' => $stages
                ];

                $result = [
                    'Course' => $courseResult,
                    'Enabled Levels' => $enabledLevels
                    ];

                return response()->json($result);
            }  //end if($count==1)   

            else 
                return response()->json("Course not found in this classroom");
        }   
    } //end of view function

    public function index() {
        return view('welcome');
    }

    public function add(){
        $user = new Classroom;
        $user->name ='class2';
        $user->save();
    }

    public function login() {
        return view('auth.login');
    }

}
