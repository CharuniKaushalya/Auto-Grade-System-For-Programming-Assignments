<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Validator;
use Mail;
use App\Privilege;
use App\User;
use App\Language;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Functions;
use Auth;

class RoleController extends Controller
{/*... ...*/
    use Functions;
     /*...View all the roles in tabulation...*/
    public function viewRoles(){
        $roles = Role::get();
        return view('role.index',compact('roles'))
            ->with('page','Roles')
            ->with('privileges',$this->getPrivileges());
     }

     public function insert(){
		$privileges = Role::find(Auth::user()->role_id)->privilages()->get();/*...Get all the privileges for relevant user...*/
		return view('role.insert')->with('page','Add Role')->with('privileges',$this->getPrivileges());
	}

     public function postInsert(Request $request){
		
		if($request->get('submit')){
            /*...Check for form validation...*/
            $validator = $this->validateRole($request->all());

            /*...If validation fails redirect to current page with errors...*/
            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }
							
			$data = $request->all();/*...Get all user inputs...*/
            /*...Save data into the database...*/
			Role::create([
	            'name' => ucfirst($data['title']),
	            'description' => ucfirst($data['description']),
	            
	        ]);
		}
		return redirect('role_insert')
			->with('page','Add Role')
			->with('message', 'The data have been save to the database successfully');
	}

    /*...Validation rules...*/
	protected function validateRole(array $data){
        return Validator::make($data, [
            'title' => 'required|max:255|min:6',
        ]);
    }


}