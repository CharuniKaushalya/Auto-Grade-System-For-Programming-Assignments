<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Validator;
use Mail;
use App\Privilege;
use App\User;
use App\UserAssignment;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Functions;
use Auth;
use DB;

class StudentController extends Controller
{/*... ...*/
    use Functions;
    public function students()
    {
        if(Auth::check()){
        $users = User::where('role_id', '=' , 1)->get();/*...Get all the users whose role_id is nt equals to one...*/
        return view('Students.index',compact('users'))
            ->with('page','Studnets')
            ->with('privileges',$this->getPrivileges());
        }return view('auth.login');
    }

    public function progress($id)
    {
    	 $user = User::find($id);
    	 if($user){
        $assignments = DB::table('assignment')
        ->rightJoin('users_has_assignment',  'assignment.id', '=','users_has_assignment.assignment_id' )
        ->where('users_has_assignment.users_id', '=', $id)
        ->get();
        /*...Get all the assignmnets submittedby the student*/
       
        return view('Students.progress',compact('assignments','user'))
            ->with('page','Studnets')
            ->with('privileges',$this->getPrivileges());
        }return view('errors.404');
    }

    public function postUpdate(Request $request)
    {
         /*...Save the image...*/
            $data = $request->all();/*...Get all user inputs...*/
            $imageName = $data['name']. '.' . 
            $request->file('image')->getClientOriginalExtension();
            $request->file('image')->move(
            base_path() . '/public/img/Users/Employee/', $imageName);

        $this->validate($request, [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255',
            ]);
            $product = User::whereid($request->get('id'))->first();
            $product->user_name =  $request->get('name');
            $product->email =  $request->get('email');
            $product->gender_id =  $request->get('gender');
            $product->image =  $imageName;
            $product->save();
            return redirect('student');
    }
     public function update($id)
    {
        $user = User::find($id);

        return view('students.edit-modal', compact('user'));
    }
}