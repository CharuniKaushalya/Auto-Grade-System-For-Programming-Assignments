<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class UserAssignment extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users_has_assignment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['users_id','assignment_id','marks','lang_id','source'];

    
    /*
    one to one
    public function type()
    {
        return $this->hasOne('App\Phone');
    }*/
    
}