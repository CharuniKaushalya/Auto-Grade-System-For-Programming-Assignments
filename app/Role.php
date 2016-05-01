<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'role';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','description'];

    public function privilages()
    {
        return $this->belongsToMany('App\Privilege', 'role_has_privilege');
    }
    
}