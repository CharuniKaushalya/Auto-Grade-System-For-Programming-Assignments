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

class LanguageController extends Controller
{/*... ...*/
    use Functions;
      /*...View all the languages in tabulation...*/
    public function viewLanguages(){
        $languages = Language::get();
        return view('language.index',compact('languages'))
            ->with('page','languages')
            ->with('privileges',$this->getPrivileges());
     }

     public function insert(){
		$privileges = Role::find(Auth::user()->role_id)->privilages()->get();/*...Get all the privileges for relevant user...*/
		return view('language.insert')->with('page','Add Language')->with('privileges',$this->getPrivileges());
	}

     public function postInsert(Request $request){
		
		if($request->get('submit')){
            /*...Check for form validation...*/
            $validator = $this->validateLanguage($request->all());

            /*...If validation fails redirect to current page with errors...*/
            if ($validator->fails()) {
                $this->throwValidationException(
                    $request, $validator
                );
            }
							
			$data = $request->all();/*...Get all user inputs...*/
            /*...Save data into the database...*/
			Language::create([
	            'name' => ucfirst($data['title']),
	            'value' => $data['value'],
	            
	        ]);
		}
		return redirect('language_insert')
			->with('page','Add Language')
			->with('message', 'The data have been save to the database successfully');
	}

    /*...Validation rules...*/
	protected function validateLanguage(array $data){
        return Validator::make($data, [
            'title' => 'required|max:255|min:6',
            'value' => 'required|numeric',
        ]);
    }


}