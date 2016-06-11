<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class TestCase extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'test_case';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['input','output','assignment_id',];
   
    
}