<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Validator;
use Mail;
use Auth;
use App\Assignment;
use App\TestCase;
use App\Language;
use App\Comment;
use App\UserAssignment;
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
    //dd($data);
    $arry1=explode( "\r\n", $data['input'] );
    $arry2=explode( "\r\n", $data['input'] );
    $input = "";$output = "";
    for ($i = 0; $i < count($arry1); $i++) 
     {
         $input .= $arry1[$i]."<br/>";/*...break input by adding <br> tag...*/
         $output .= $arry2[$i]."<br/>";/*...break output lines by adding <br> tag...*/
        
     }

    /*...call validate input data...*/
    $validator = $this->validateAssignment($request->all());

      if ($validator->fails()) {
          $this->throwValidationException(
              $request, $validator
          );
      }
    
    /*...generate url for assignment...*/
    $slug = $this->slugGenerator(strtolower($data['title']));
    /*...insert data into assignment table...*/
    /*...get id of saved assignment...*/
    $id = Assignment::create([
              'title' => ucwords($data['title']),
              'description' => $data['editor'],
              'input' => $input,
              'output' => $data['output'],
              'slug' => $slug,
              'assignment_type_id' => $data['type']
            
        ])->id;

    /*...save test cases for assignment...*/
    foreach ($data['test'] as $key => $value) {
      # code...
      TestCase::create([
        'input' => $value['input'],
        'output' => $value['output'],
        'assignment_id' => $id
        ]);
    }
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

    /*...check if there is login session...*/
    if(Auth::check()){
  		$assignment = Assignment::find($id);/*...Get details of assginment from database relevant id...*/
      $test = TestCase::whereassignment_id($id)->get();/*...get all test cases for assignment...*/
      /*...check whether this assigment has been submit at least once by  the lgin user...*/
      $submit = UserAssignment::whereassignment_id($id)->whereusers_id(Auth::user()->id)->get();
      $languages = Language::get();/*...get all programming languages support by this system...*/
      //dd($submit);
      
      if ($submit === null) {
         // user doesn't submit
        return view('assignment.show',compact('assignment','test','id','languages'))->with('page','View Assignment - '.$id)
      ->with('privileges',$this->getPrivileges());
      }
      return view('assignment.show',compact('assignment','test','id','submit','languages'))->with('page','View Assignment - '.$id)
      ->with('privileges',$this->getPrivileges());
    }return view('errors.404');
		
	}
  public function getMarks(){
    return view('assignment.marks-test')->with('page','View Assignment - ')
    ->with('privileges',$this->getPrivileges());

  }

  /*...saved marks for submitted assignment..*/
  public function saveMarks($id){
   $lang = isset( $_POST['lang'] ) ? intval( $_POST['lang'] ) : 1;
      $code = trim(stripslashes( $_POST['source'] ));
      $mark = intval( $_POST['mark'] ) ;
      $saved = UserAssignment::create([
              'users_id' => Auth::user()->id,
              'assignment_id' => $id,
              'marks' => $mark,
              'lang_id' => $lang,
              'source' => $code
            
        ]);
      return 0;
   
    
  }
  public function runcode($id,Request $request){
    /* $data = $request->all();
    $source = (string)$data['source'];
    $lang = $data['lang'];
    $test = TestCase::whereassignment_id($id)->get();
    if(isset($data['submit23'])){
     //dd( $data);
      //return view('assignment.marks',compact('source','test','lang'))->with('privileges',$this->getPrivileges());;
    }*/
  }

  /*...get update page for specific assignment details...*/
  public function update($id){
    if(Auth::check()){
    $privileges = $this->getPrivileges(); /*...get all privileges relevent to user from the database...*/ 
    $assignment = Assignment::find($id);/*...get details of assignment ...*/
    return view('assignment.edit',compact('privileges','assignment'))->with('page','Update Assignment ');
    }return view('errors.404');
  }

  /*...saved updated assignment details in to the database...*/
  public function postUpdate($id,Request $request){
    $data = $request->all(); /*...get all user input data...*/
    /*...Check for form validation...*/
    $validator = $this->validation($request->all());

      /*...If validation fails redirect to current page with errors...*/
      if ($validator->fails()) {
          $this->throwValidationException(
              $request, $validator
          );
      }
    /*...Save data into database...*/
    $assignment = Assignment::whereid($id)->first();
    $assignment->title = ucwords($data['title']);
    $assignment->description = $data['editor'];
    $assignment->assignment_type_id = $data['type'];
    $assignment->save();
            
    return redirect('assignmentEdit_'.$id)->with('message','Data have been updated successfully');
  

  }

  /*...Validation rules...*/
  protected function validation(array $data){
        return Validator::make($data, [
            'title' => 'required|max:255',
        ]);
    }

  /*...view all answers submitted by student...*/  
  public function viewAnswers($id){
    if(Auth::check()){
    $privileges = $this->getPrivileges(); /*...get all privileges relevent to user from the database...*/ 
    $languages = Language::get();/*...get all user input data...*/
    $assignments = UserAssignment::whereassignment_id($id)
    ->join('users', 'users.id', '=', 'users_has_assignment.users_id' )
    ->where('users_has_assignment.assignment_id' ,'=', $id)
    ->get();
   //dd($assignments);
    return view('assignment.answers',compact('privileges','assignments','languages'))->with('page','View Students Answers ');
    }return view('auth.login');
  }

  /*...view details of  the answe...*/
  public function modalAnswer($id,$sid)
  {
        $user = UserAssignment::whereusers_id($id)->whereassignment_id($sid)->first();

        return view('assignment.answer-modal', compact('user'));
  }

  /*...saved feedback provided by lecturers to the database ...*/
  public function postModalAnswer(Request $request)
  {
      $data = $request->all();/*...Get all user inputs...*/
      //dd($data);
      /*...save data in the database...*/
            $product = UserAssignment::whereusers_id($request->get('id'))
            ->whereassignment_id($data['assignment_id'])
            ->first();
            $product->feedback =  $request->get('feedback');
            $product->save();
      return redirect('assignmentView_'.$data['assignment_id']);
  }

  /*...view rank of each student for assignment...*/
  public function leaderboard($id){

    if(Auth::check()){
    $privileges = $this->getPrivileges(); /*...get all privileges relevent to user from the database...*/ 
    $languages = Language::get();/*...get all languages...*/
    /*...get assignments and submitted user details...*/
    $assignments = UserAssignment::whereassignment_id($id)
    ->join('users', 'users_has_assignment.users_id', '=', 'users.id')
    ->orderBy('marks', 'desc')
    ->get();
    return view('assignment.leaderboard',compact('privileges','assignments','languages'))->with('page','Leaderboard ');
    }return view('auth.login');
  }

  /*...get details of all submisons for the assignments..*/
  public function submission($id){
    if(Auth::check()){
    $privileges = $this->getPrivileges(); /*...get all privileges relevent to user from the database...*/ 
    $languages = Language::get();/*...get all languages...*/
    /*...get all details of assignment and subbited users...*/
    $assignments = UserAssignment::whereassignment_id($id)
    ->whereusers_id(Auth::user()->id)
    ->orderBy('created_at', 'desc')
    ->get();
    return view('assignment.submission',compact('privileges','assignments','languages'))->with('page','Submisssions ');
    }return view('auth.login');
  }

  /*...view discussion page for assignment...*/
  public function disscusion($id){
    if(Auth::check()){
       $privileges = $this->getPrivileges(); /*...get all privileges relevent to user from the database...*/
       /*...get currently available comments...*/ 
      $comments = Comment::whereassignment_id($id)
       ->join('users', 'comment.users_id', '=', 'users.id')
    ->get();
   // dd($comments);
    return view('assignment.disscusion',compact('privileges','comments'))->with('page','disscusion ');


    }return view('auth.login');
  }

  /*...saved login user comment in to the database...*/
  public function postDisscusion($id,Request $request){
  $data = $request->all();
  $this->validate($request, [
      'comment' => 'required',
  ]);
  $comment = new Comment;
  $comment->comment = $data['comment'];
  $comment->assignment_id = $id;
  $comment->users_id = Auth::user()->id;
  $comment->save();
  return redirect('discussion_'.$id);

  }


/*	public function runcodep($id,Request $request){
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

                   //return redirect()->back()
                     // ->withInput($request->all())
                     // ->with('details',$details)
                     // ->with('status',$status);
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
*/
}