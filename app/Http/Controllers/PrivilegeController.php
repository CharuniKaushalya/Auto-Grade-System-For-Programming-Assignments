<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Validator;
use Mail;
use App\Privilege;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Functions;
use Auth;

class PrivilegeController extends Controller
{
    use Functions;
    public function users()
    {
        $users = User::where('role_id', '!=' , 1)->get();
        return view('auth.index',compact('users'))
            ->with('page','Users')
            ->with('privileges',$this->getPrivileges());
    }
	
    public function insert(){
		$privileges = Role::find(Auth::user()->role_id)->privilages()->get();
		return view('privilege.insert')->with('page','Add Privilege')->with('privileges',$this->getPrivileges());
	}
	public function postInsert(Request $request){
		
		if($request->get('submit')){
			$validator = $this->validatePrivilege($request->all());

	        if ($validator->fails()) {
	            $this->throwValidationException(
	                $request, $validator
	            );
	        }
							
			$data = $request->all();
			$slug = $this->slugGenerator(strtolower($data['title']));
			Privilege::create([
	            'name' => ucfirst($data['title']),
	            'description' => ucfirst($data['description']),
	            'slug' => $slug,
	            
	        ]);
		}
		return redirect('privilege_insert')
			->with('page','Add Privilege')
			->with('message', 'The data have been save to the database successfully');
	}

	protected function validatePrivilege(array $data){
        return Validator::make($data, [
            'title' => 'required|max:255|min:6',
        ]);
    }
    /*temporty*/
    public function staffRegister2(){
        return view('auth.staff-register2')->with('privileges',$this->getPrivileges());
    }

	public function postStaffRegister2(Request $request){
		
		$extension = $request->file('image')->getClientOriginalExtension(); // getting image extension
     	$path = 
		$data = $request->all();
		$imageName = "helloo". '.' . 
            $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(
            base_path() . '/public/img/employee/', $imageName);
        return redirect('staff_register2');

    }
    /*end rtempory*/


    public function staffRegister(){
    	$roles = Role::get();
        return view('auth.staff-register',compact('roles'))->with('page','Add Staff')->with('privileges',$this->getPrivileges());

    }
    public function postStaffRegister(Request $request){
        if($request->get('submit')){
		$validator = $this->validateRegister($request->all());

	        if ($validator->fails()) {
	            $this->throwValidationException(
	                $request, $validator
	            );
	        }
		$data = $request->all();
		$confirmation_code = str_random(30); 
		$data1 = [
			'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'confirmation_code' => $confirmation_code
        ];
        Mail::send('emails.staff', $data1, function ($m) use ($data) {
            $m->to($data['email'], $data['name'])->subject("registration");
        });

        
	        $imageName = $data['name']. '.' . 
        	$request->file('image')->getClientOriginalExtension();
        	$request->file('image')->move(
        	base_path() . '/public/img/Users/Employee/', $imageName);
			User::create([
            	'full_name' => $data['name'],
           		'user_name' => $data['name'],
            	'email' => $data['email'],
            	'confirmed' => 0,
            	'confirmation_code' => $confirmation_code,
            	'password' => bcrypt($data['password']),
            	'gender_id' => $data['gender'],
            	'role_id' => $data['role'],
            	'image' => $imageName,
            	'address' => $data['address']
            
        ]);
		
        
		return redirect('staff_register')
			->with('message','Data have been save to the database successfully and email have been send to the user!..');
		}
		return redirect('staff_register');
    }

    protected function validateRegister(array $data){
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
			'image' => 'required|mimes:jpeg,bmp,png',
        ]);
    }
    
    public function viewPrevileges(){
      	$Tprivileges = Privilege::get();
      	return view('privilege.index',compact('Tprivileges'))
            ->with('page','Privileges')
            ->with('privileges',$this->getPrivileges());
     }

	
}