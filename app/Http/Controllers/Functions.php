<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Validator;
use Mail;
use Illuminate\Http\Request;

trait Functions 
{
	protected function slugGenerator($str, $replace=array(), $delimiter='-') {
		$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $str);
   		return $slug;
	}

}