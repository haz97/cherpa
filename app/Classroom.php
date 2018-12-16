<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    public function courses(){
		return $this->belongsToMany('App\Course','courses_classrooms')->withPivot('course_id');
    }

    public function users(){
		return $this->belongsToMany('App\User','users_classrooms')->withPivot('user_id');
    }

}
