<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'privilege';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description','slug'];

    public function roles()
    {
        return $this->belongsToMany('App\Role', 'role_has_privilege');
    }
   
}