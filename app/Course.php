<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       
    ];

    public function classrooms(){
		return $this->belongsToMany('App\Classroom','courses_classrooms')->withPivot('classroom_id');
    }
    
    public function stages(){
		return $this->hasMany('App\Stage');
    }
    
}
