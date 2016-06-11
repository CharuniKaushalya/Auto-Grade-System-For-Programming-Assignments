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

class PrivilegeController extends Controller
{/*... ...*/
    use Functions;
    public function users()
    {
        $users = User::where('role_id', '!=' , 1)->get();/*...Get all the users whose role_id is nt equals to one...*/
        return view('auth.index',compact('users'))
            ->with('page','Users')
            ->with('privileges',$this->getPrivileges());
    }
	
    public function insert(){
		$privileges = Role::find(Auth::user()->role_id)->privilages()->get();/*...Get all the privileges for relevant user...*/
		return view('privilege.insert')->with('page','Add Privilege')->with('privileges',$this->getPrivileges());
	}
	public function postInsert(Request $request){
		
		if($request->get('submit')){
            /*...Check for form validation...*/
            $validator = $this->validatePrivilege($request->all());

            /*...If validation fails redirect to current page with errors...*/
            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }
							
			$data = $request->all();/*...Get all user inputs...*/
			$slug = $this->slugGenerator(strtolower($data['title']));/*...Generate Url...*/
            /*...Save data into the database...*/
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

    /*...Validation rules...*/
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
            /*...Check for form validation...*/
            $validator = $this->validateRegister($request->all());

            /*...If validation fails redirect to current page with errors...*/
	        if ($validator->fails()) {
	            $this->throwValidationException(
	                $request, $validator
	            );
	        }
		$data = $request->all();/*...Get all user inputs...*/
		$confirmation_code = str_random(30); /*...Create confimation code...*/
		$data1 = [
			'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password'],
            'confirmation_code' => $confirmation_code
        ];
        /*...Send an email to user...*/
        Mail::send('emails.staff', $data1, function ($m) use ($data) {
            $m->to($data['email'], $data['name'])->subject("registration");
        });

        /*...Save the image...*/
	        $imageName = $data['name']. '.' . 
        	$request->file('image')->getClientOriginalExtension();
        	$request->file('image')->move(
        	base_path() . '/public/img/Users/Employee/', $imageName);

            /*...Save the data into the database...*/
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

    /*...Validation rules...*/
    protected function validateRegister(array $data){
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
			'image' => 'required|mimes:jpeg,bmp,png',
        ]);
    }
    
    /*...View all the privileges in tabulation...*/
    public function viewPrevileges(){
      	$Tprivileges = Privilege::get();
      	return view('privilege.index',compact('Tprivileges'))
            ->with('page','Privileges')
            ->with('privileges',$this->getPrivileges());
     }

    

    
	
}