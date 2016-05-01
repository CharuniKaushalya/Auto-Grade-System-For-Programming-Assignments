<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Validator;
use Mail;
use App\Assignment;
use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;

class AssignController extends Controller
{
	use Functions;

	public function index(){
		$assignments = Assignment::get();
		$privileges = $this->getPrivileges();
		return view('assignment.index',compact('assignments','privileges'))->with('page','Assignments');

	}

	public function insert(){
		$privileges = $this->getPrivileges();
		return view('assignment.insert',compact('privileges'))->with('page','Add Assignment');

	}

	public function postInsert(Request $request){
		$data = $request->all();
		$arry=explode( "\r\n", $data['myinput'] );
		$input = "";$output = "";
		for ($i = 0; $i < count($arry); $i++) 
	   {
	       $input .= $arry[$i]."<br/>";
	      
	   }

		$validator = $this->validateAssignment($request->all());

	    if ($validator->fails()) {
	        $this->throwValidationException(
	            $request, $validator
	        );
	    }
		
		$slug = $this->slugGenerator(strtolower($data['title']));
		Assignment::create([
            	'title' => ucwords($data['title']),
           		'description' => $data['editor'],
           		'input' => $input,
           		'output' => $data['output'],
            	'slug' => $slug,
            	'assignment_type_id' => $data['type']
            
        ]);
		return redirect('assignment_insert')->with('message','Data have been send to the database successfully');
	}

	protected function validateAssignment(array $data){
        return Validator::make($data, [
            'title' => 'required|max:255',
        ]);
    }


	public function show($id){
		$assignment = Assignment::find($id);
		return view('assignment.show',compact('assignment'))->with('page','View Assignment - '.$id)
		->with('privileges',$this->getPrivileges());

	}

	public function runcode($id,Request $request){
		//dd($request->all());
		$data = $request->all();
		 ini_set('display_errors', 1);
     // Add a new service to the wrapper
    SoapWrapper::add(function ($service) {
       $service
       ->name('currency')
       ->wsdl('http://api.compilers.sphere-engine.com/api/1/service.wsdl')
       ->trace(true);
     });
    // Using the added service
SoapWrapper::service('currency', function ($client) {




  
  $user = '558035d2ba7bf111146be7c30f8db79d';
  $pass = 'a256163962f2f9d3fb826f889081b727';

  $lang = isset( $data['lang'] ) ? intval( $data['lang'] ) : 1;; // C++

  $code = $data['code'];
  $input = $data['input'];


  $run = true;
  $private = false;

  $params = array(
        'user' => $user,
        'pass' => $pass,
        'sourceCode' => $code,
        'language' => $lang,
        'input' => $input,
        'run' => $run,
        'private' => $private
        );

  $result= $client->call('createSubmission', $params);
print_r($result);
  if ($result['error'] == 'OK') {
    $params = array(
          'user' => $user,
          'pass' => $pass,
          'link' => $result['link']
        );
    $status = $client->call('getSubmissionStatus', $params);
    //$status = $client->getSubmissionStatus($user, $pass, $result['link']);

    if ($status['error'] == 'OK') {
      while ($status['status'] != 0) {
        sleep(3);
        $status = $client->call('getSubmissionStatus', $params);
       //$status = $client->getSubmissionStatus($user, $pass, $result['link']);
      }
    }

    echo '<br><br>';
    $params = array(
          'user' => $user,
          'pass' => $pass,
          'link' => $result['link'],
          'withSource' => false,
          'withInput' => true,
          'withOutput' => true,
          'withStderr' => false,
          'withCmpinfo' => false 
        );
    $details = $client->call('getSubmissionDetails', $params);
    //$details = $client->getSubmissionDetails($user, $pass, $result['link'], true, true, true, true, true);

    echo '<table border="0">';
    echo '<tr><th>Input</th>  <th>Output</th></tr>';
    echo '<tr>';
    echo "<td><code>".$details['input']."</code></td>";
    echo "<td><code>".$details['output']."</code></td>";
    echo '</tr>';
    echo '</table>';
  } else {
    echo '<h1>ERROR!</h1>';
  }

  });
	}
}