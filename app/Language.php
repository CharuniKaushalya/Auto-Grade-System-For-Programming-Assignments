<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Language extends Model
{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'language';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','value',];

    
    /*
    one to one
    public function type()
    {
        return $this->hasOne('App\Phone');
    }*/
    
}