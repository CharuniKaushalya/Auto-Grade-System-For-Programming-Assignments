<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Validator;
use Mail;
use App\Assignment;
use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;

class AssignmentController extends Controller
{/*... ...*/
	use Functions;

	public function index(){
		$assignments = Assignment::get(); /*...get all assignments from the database...*/
		$privileges = $this->getPrivileges(); /*...get all privileges relevent to user from the database...*/ 
		return view('assignment.index',compact('assignments','privileges'))->with('page','Assignments');

	}

	public function insert(){
		$privileges = $this->getPrivileges(); /*...get all privileges relevent to user from the database...*/ 
		return view('assignment.insert',compact('privileges'))->with('page','Add Assignment');

	}

	public function postInsert(Request $request){
		$data = $request->all(); /*...get all user input data...*/
    $input = $this->addLineBreakTeaxtArea($data['input']);/*...Add input with line break...*/
    $output = $this->addLineBreakTeaxtArea($data['output']);/*...Add output with line break...*/
    

		/*...Check for form validation...*/
    $validator = $this->validateAssignment($request->all());

	    /*...If validation fails redirect to current page with errors...*/
      if ($validator->fails()) {
	        $this->throwValidationException(
	            $request, $validator
	        );
	    }
		
    $slug = $this->slugGenerator(strtolower($data['title']));/*...Generate url...*/
    /*...Save data into database...*/
		Assignment::create([
            	'title' => ucwords($data['title']),
           		'description' => $data['editor'],
           		'input' => $input,
           		'output' => $output,
            	'slug' => $slug,
            	'assignment_type_id' => $data['type']
            
        ]);
		return redirect('assignment_insert')->with('message','Data have been send to the database successfully');
	}

	/*...Validation rules...*/
  protected function validateAssignment(array $data){
        return Validator::make($data, [
            'title' => 'required|max:255',
            'input' => 'required',
            'output' => 'required',
        ]);
    }

  /*...View assignment in details...*/
	public function show($id){
		$assignment = Assignment::find($id);/*...Get details of assginment from database relevant id...*/
		return view('assignment.show',compact('assignment'))->with('page','View Assignment - '.$id)
		->with('privileges',$this->getPrivileges());

	}



	public function runcode($id,Request $request){
		//dd($request->all());
		$data = $request->all();
    $data['id'] = $id;
    
		 ini_set('display_errors', 1);
     // Add a new service to the wrapper
    SoapWrapper::add(function ($service) {
       $service
       ->name('currency')
       ->wsdl('http://api.compilers.sphere-engine.com/api/1/service.wsdl')
       ->trace(true);
     });
    // Using the added service
    $mydetails = array();
    $client = SoapWrapper::service('currency', function ($client) use($data) {
        return $client->getFunctions();
    });

      // dd();
      
      $user = '558035d2ba7bf111146be7c30f8db79d';
      $pass = 'a256163962f2f9d3fb826f889081b727';

      $lang = isset( $data['lang'] ) ? intval( $data['lang'] ) : 1;; // C++

      $code = $data['code'];
      $input = $data['input'];


      $run = true;
      $private = false;
      $subStatus = array(
            0 => 'Success',
            1 => 'Compiled',
            3 => 'Running',
            11 => 'Compilation Error',
            12 => 'Runtime Error',
            13 => 'Timelimit exceeded',
            15 => 'Success',
            17 => 'memory limit exceeded',
            19 => 'illegal system call',
            20 => 'internal error'
        );

      $error = array(
            'status' => 'error',
            'output' => 'Something went wrong :('
      );

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
    //print_r($result);
      if ($result['error'] == 'OK') {
        $params = array(
              'user' => $user,
              'pass' => $pass,
              'link' => $result['link']
            );
        $status = $client->call('getSubmissionStatus', $params);
        //$status = $client->getSubmissionStatus($user, $pass, $result['link']);

        if ($status['error'] == 'OK') {
          if ($status['status'] != 0) {
            sleep(3);
            $status = $client->call('getSubmissionStatus', $params);
           //$status = $client->getSubmissionStatus($user, $pass, $result['link']);
            $params = array(
              'user' => $user,
              'pass' => $pass,
              'link' => $result['link'],
              'withSource' => true,
              'withInput' => true,
              'withOutput' => true,
              'withStderr' => true,
              'withCmpinfo' => true 
            );
            $details = $client->call('getSubmissionDetails', $params);
            if ( $details['error'] == 'OK' ) {
                    //print_r( $details );
                    if ( $details['status'] < 0 ) {
                        $status = 'waiting for compilation';
                    } else {
                        $status = $subStatus[$details['status']];
                    }
                    //dd($details);
                    //$details = $client->getSubmissionDetails($user, $pass, $result['link'], true, true, true, true, true);
                    //$mydetails =  $details;
                   //echo json_encode( $details );
                    echo '<table border="0" class="table">';
                    echo '<tr><th>Status </th><th>Input</th>  <th>Output</th> <th>Compilation info</th></tr>';
                    echo '<tr>';
                    echo "<td><code>".$status."</code></td>";
                    echo "<td><code>".$details['input']."</code></td>";
                    echo "<td><code>".$details['output']."</code></td>";
                    echo "<td><code>".$details['cmpinfo']."</code></td>";
                    
                    echo '</tr>';
                    echo '</table>';

                   /* return redirect()->back()
                      ->withInput($request->all())
                      ->with('details',$details)
                      ->with('status',$status);*/
                } else {
                    //we got some error :(
                    //print_r( $details );
                  //echo json_encode( $error );
                  //return redirect('assignment_'.$data['id'])->with('error',$error);
                }
              
          }
        }else{
         // return redirect('assignment_'.$data['id'])->with('error',$error);
        }
      } else {
       // return redirect('assignment_'.$data['id'])->with('error',$error);
      }
	}



  public function runcode2($id,Request $request){
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
    SoapWrapper::service('currency', function ($client) use($data) {
      error_reporting(0);

    $user = '558035d2ba7bf111146be7c30f8db79d';
    $pass = 'a256163962f2f9d3fb826f889081b727';
    $code = '';
    $input = '';
    $run = true;
    $private = false;

    $subStatus = array(
        0 => 'Success',
        1 => 'Compiled',
        3 => 'Running',
        11 => 'Compilation Error',
        12 => 'Runtime Error',
        13 => 'Timelimit exceeded',
        15 => 'Success',
        17 => 'memory limit exceeded',
        19 => 'illegal system call',
        20 => 'internal error'
    );

    $error = array(
        'status' => 'error',
        'output' => 'Something went wrong :('
    );

    //echo json_encode( array( 'hi', 1 ) ); exit;
    //print_r( $_POST ); exit;
        $lang = isset( $data['lang'] ) ? intval( $data['lang'] ) : 1;
        $input = trim( $data['input'] );
        $code = trim(stripslashes( $data['code'] ));

        //create new submission
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


        //if submission is OK, get the status
        if ( $result['error'] == 'OK' ) {

          $params = array(
              'user' => $user,
              'pass' => $pass,
              'link' => $result['link']
            );
        $status = $client->call('getSubmissionStatus', $params);
        //$status = $client->getSubmissionStatus($user, $pass, $result['link']);
            if ( $status['error'] == 'OK' ) {

                //check if the status is 0, otherwise getSubmissionStatus again
                while ( $status['status'] != 0 ) {
                    sleep( 3 ); //sleep 3 seconds
                    $status = $client->call('getSubmissionStatus', $params);
                }

                //finally get the submission results
                $params = array(
                      'user' => $user,
                      'pass' => $pass,
                      'link' => $result['link'],
                      'withSource' => true,
                      'withInput' => true,
                      'withOutput' => true,
                      'withStderr' => true,
                      'withCmpinfo' => true 
                    );
                $details = $client->call('getSubmissionDetails', $params);
                dd($details);


               // $details = $client->getSubmissionDetails( $user, $pass, $result['link'], true, true, true, true, true );
                if ( $details['error'] == 'OK' ) {
                    //print_r( $details );
                    if ( $details['status'] < 0 ) {
                        $status = 'waiting for compilation';
                    } else {
                        $status = $subStatus[$details['status']];
                    }

                    $data = array(
                        'status' => 'success',
                        'meta' => "Status: $status | Memory: {$details['memory']} | Returned value: {$details['status']} | Time: {$details['time']}s",
                        'output' => htmlspecialchars( $details['output'] ),
                        'raw' => $details
                    );
                    
                    if( $details['cmpinfo'] ) {
                        $data['cmpinfo'] = $details['cmpinfo'];
                    }
                    dd($details);
                    echo json_encode( $data );
                } else {
                    //we got some error :(
                    //print_r( $details );
                  dd($error);
                    echo json_encode( $error );
                }
            } else {
                //we got some error :(
                //print_r( $status );
              dd($error);
                echo json_encode( $error );
            }
        } else {
            //we got some error :(
            //print_r( $result );
          dd($error);
            echo json_encode( $error );
        }
      });
  }

}