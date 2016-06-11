<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comment';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['comment','assignment_id','users_id',];

    
    /*
    one to one
    public function type()
    {
        return $this->hasOne('App\Phone');
    }*/
    
}