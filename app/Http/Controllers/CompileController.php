<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Validator;
use Mail;
use Illuminate\Http\Request;
use Artisaninweb\SoapWrapper\Facades\SoapWrapper;

class CompileController extends Controller
{
	public function index(){
		$privileges = $this->getPrivileges();
		return view('compile.index',compact('privileges'))->with('page','compile');
	}


	public function runcode(){
		//dd($request->all());
		$privileges = $this->getPrivileges();
    
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
    $client = SoapWrapper::service('currency', function ($client) {
        return $client->getFunctions();
    });

      // dd();
      
      $user = '558035d2ba7bf111146be7c30f8db79d';
      $pass = 'a256163962f2f9d3fb826f889081b727';

       $lang = isset( $_POST['lang'] ) ? intval( $_POST['lang'] ) : 1;
    	$input = trim( $_POST['input'] );
    	$code = trim(stripslashes( $_POST['source'] ));



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
                    $data = array(
                    'status' => 'success',
                    'meta' => "Status: $status | Memory: {$details['memory']} | Returned value: {$details['status']} | Time: {$details['time']}s",
                    'output' => htmlspecialchars( $details['output'] ),
                    'raw' => $details
                );
                
                if( $details['cmpinfo'] ) {
                    $data['cmpinfo'] = $details['cmpinfo'];
                }
                
                return json_encode( $data );
                    //dd($details);
                    //$details = $client->getSubmissionDetails($user, $pass, $result['link'], true, true, true, true, true);
                    //$mydetails =  $details;
                   //echo json_encode( $details );
                   // echo json_encode( $details );

                   /* return redirect()->back()
                      ->withInput($request->all())
                      ->with('details',$details)
                      ->with('status',$status);*/
                } else {
                    //we got some error :(
                    //print_r( $details );
                  //echo json_encode( $error );
                  //return redirect('assignment_'.$data['id'])->with('error',$error);
                	//echo json_encode( $error );
                }
              
          }
        }else{
         // return redirect('assignment_'.$data['id'])->with('error',$error);
        }
      } else {
       // return redirect('assignment_'.$data['id'])->with('error',$error);
      }
	}

}