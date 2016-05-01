<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'assignment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title','description','slug','assignment_type_id','input','output',];

    public function testcases()
    {
        return $this->belongsToMany('App\TestCase', 'test_case');
    }
    /*
    one to one
    public function type()
    {
        return $this->hasOne('App\Phone');
    }*/
    
}