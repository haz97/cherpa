<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'name', 'stage_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

    ];

    public function stage(){
		return $this->belongsTo('App\Stage');
    }

    public function users(){
		return $this->belongsToMany('App\User','users_levels')->withPivot('status');
    }

    public function status()
    {
        return $this->pivot->status;
    }

}
