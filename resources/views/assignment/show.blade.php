@extends('layouts.admin')

@section('content')
        <script type="text/javascript" src="js/plugins/codemirror/codemirror.js"></script>        
        <script type='text/javascript' src="js/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
        <script type='text/javascript' src="js/plugins/codemirror/mode/xml/xml.js"></script>
        <script type='text/javascript' src="js/plugins/codemirror/mode/javascript/javascript.js"></script>
        <script type='text/javascript' src="js/plugins/codemirror/mode/css/css.js"></script>
        <script type='text/javascript' src="js/plugins/codemirror/mode/clike/clike.js"></script>
        <script type='text/javascript' src="js/plugins/codemirror/mode/php/php.js"></script> 
        <script type="text/javascript" src="js/plugins/summernote/summernote.js"></script>
<!-- page content wrapper -->
<div class="page-content-wrap">                    
                    
    <!-- page content holder -->
    <div class="page-content-holder">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                        <div class="panel-heading">
                            <ul class="panel-controls">                                               
                             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span>&nbsp</a></li>             
                             </ul>
                                <h2 class="panel-title"><strong>Assignment {{ $assignment->title or ''}}</strong> Details</h2>
                                <a href="leaderboard_{{ $assignment->id }}"><button class="btn btn-warning pull-right btn-lg col-md-2-offset-1" style="margin-right:10px;">
                            <span class="fa fa-trophy"></span>Leaderboard</button></a>
                            <a href="submission_{{ $assignment->id }}"><button class="btn btn-success pull-right btn-lg col-md-2-offset-1" style="margin-right:10px;">
                            <span class="fa fa-list"></span>Submissons</button></a>
                            <a href="discussion_{{ $assignment->id }}"><button class="btn btn-info pull-right btn-lg col-md-2-offset-1" style="margin-right:10px;">
                            <span class="fa fa-comment"></span>Discussion</button></a>
                            
                        </div>
                        <div class="panel-body">
                        </div>
                        <div class="panel-body">
                                <h4 class="col-md-4 col-xs-12 control-label"><strong>Problem</strong></h4>
                                 
                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        {!! $assignment->description or ''!!}                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h4 class="col-md-4 col-xs-12 control-label"><strong>Sample Input</strong></h4>
                                    <div class="alert alert-primary">
                                        <h4 class="col-md-8 col-xs-12">
                                        {!! $assignment->input or ''!!}                                        
                                        </h4>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h4 class="col-md-4 col-xs-12 control-label"><strong>Sample Output</strong></h4>
                                    <div class="alert alert-primary">
                                        <h4 class="col-md-8 col-xs-12">
                                            {!! $assignment->output or ''!!}                                        
                                        </h4>
                                    </div>
                                </div>
                        </div>
                        <div class="panel-footer">
                            <ul class="panel-controls">                                               
                             <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span>&nbsp</a></li>
                                             
                                           
                             </ul>
                        </div>
                </div>



                <div id="wrapper" class="panel panel-default">
                    {!! Form::open(['class'=>'form-horizontal', 'id' =>'code']) !!}
                        {!! csrf_field() !!}
                    <div class="panel-heading">
                        <h2 class="panel-title"><strong>Online Code Compiler</strong> Layout</h2>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                     </div>
       
                    <div class="panel-body">
                        <div class="form-group">
                            <h4 class="col-md-7 col-xs-12 control-label">Select Language</h4>
                            <div class="col-md-4 col-xs-12">                                            
                                <div>
                                                <select name="lang" id="lang" class="form-control select full-right" data-size="7" data-style="btn-success" data-live-search="true">
                                                    
                                                    <option value="11">C (gcc-4.3.4)</option>
                                                    <option value="27">C# (mono-2.8)</option>
                                                    <option value="1"   selected="selected">C++ (gcc-4.3.4)</option>
                                                    <option value="44">C++0x (gcc-4.5.1)</option>
                                                    <option value="102">D (dmd) (dmd-2.042)</option>
                                                    <option value="36">Erlang (erl-5.7.3)</option>
                                                    <option value="124">F# (fsharp-2.0.0)</option>
                                                    <option value="114">Go (gc-2010-07-14)</option>
                                                    <option value="121">Groovy (groovy-1.7)</option>
                                                    <option value="21">Haskell (ghc-6.8.2)</option>
                                                    <option value="10">Java (sun-jdk-1.6.0.17)</option>
                                                    <option value="35">JavaScript (rhino) (rhino-1.6.5)</option>
                                                    <option value="112">JavaScript (spidermonkey) (spidermonkey-1.7)</option>
                                                    <option value="26">Lua (luac 5.1.4)</option>
                                                    <option value="22">Pascal (fpc) (fpc 2.2.0)</option>
                                                    <option value="2">Pascal (gpc) (gpc 20070904)</option>
                                                    <option value="3">Perl (perl 5.12.1)</option>
                                                    <option value="54">Perl 6 (rakudo-2010.08)</option>
                                                    <option value="29">PHP (php 5.2.11)</option>
                                                    <option value="4">Python (python 2.6.4)</option>
                                                    <option value="116">Python 3 (python-3.1.2)</option>
                                                    <option value="117">R (R-2.11.1)</option>
                                                    <option value="17">Ruby (ruby-1.9.2)</option>
                                                    <option value="39">Scala (scala-2.8.0.final)</option>
                                                    <option value="23">Smalltalk (gst 3.1)</option>
                                                    <option value="101">Visual Basic .NET (mono-2.4.2.3)</option>
                                                </select>
                                </div>                                          
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 class="col-md-3  control-label" for="source">Source Code:</h4>
                            <textarea class="col-md-8" cols="40" rows="15" name="source" id="source">
        #include <iostream>
        #include <cmath>

        using namespace std;

        int main(int argc, char **argv)
        {
          int n;
          cin >> n;
          cout << pow(2, double(n));
          return 0;
        }











            
                        </textarea>

                    </div>
                     <div class="form-group">
                        <h4 class="col-md-3  control-label" for="source">Input: <span class="description">Input Test Cases Here</span></h4>
                        <textarea class="col-md-8" cols="40" rows="4" name="input" id="input"></textarea>
                     </div>
                     <div class="res">
                      @foreach($test as $k => $t)
                         <div id="response_{{$k}}"  style="font-size:16px;text-align:center">
                            <div class="processing_{{$k}}"></div>
                            <div class="meta_{{$k}}"></div>
                            <div class="output_{{$k}}"></div>
                            <div class="state_{{$k}}"></div>
                        </div>
                    @endforeach
                    </div>
                    <div class="output" style="font-size:16px;text-align:center"></div>
                    <div class="data_save" style="font-size:16px;text-align:center"></div>

                 
                
                </div>

                <div class="panel-footer">  
                  <input type="button" class="btn btn-success btn-large" value="Run Code" id="code1" onclick="hello();"/>      
                    <input type="submit" name="submit23" class="btn btn-primary btn-large pull-right" value="Submit"  /> 
                </div>
                 
 {!! Form::close() !!}
  
  
    </div>
    
    
                            
            </div>
        </div>   
    </div>
</div>
<script> 
        var textArea = document.getElementById('source');
          var editor = CodeMirror.fromTextArea(textArea, {
            lineNumbers: true,
            matchBrackets: true,
            mode: "text/x-csharp"
          });
</script>   
@endsection
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript">
function hello(){
    alert("hiii");
        var data = $(this).serialize();
       // console.log(data);
        var source = $('textarea#source').val();

        if( source == '' ) {
            alert( 'No source code provided in the area.');
            return false;
        }
        
        $('.processing').html('<div class="loading">Processing...</div>');
        
        $.ajax({
            type: 'post',
            url: '{{ url('/compile') }}',
            dataType: 'json',
            data: data + '&process=1',
            cache: false,
            success: function(response){
                $('.loading').remove();
                $('.cmpinfo').remove();
                $('#response').show();
                         if( response.status == 'success' ) {
                    $('.meta').text( response.meta );
                    $('.output').html('<strong>Output</strong>: <br><br><pre>' + response.output + '</pre>');
                    
                    if( response.cmpinfo ) {
                        $('.cmpinfo').remove();
                        $('.meta').after('<div class="cmpinfo"></div>');
                        $('.cmpinfo').html('<strong>Compiler Info: </strong> <br><br>' + response.cmpinfo );
                    }
                    
                } else {
                    //$('.output').html('<pre>' + response + '</pre>');
                    alert( response.output );
                }
                //alert( response.msg );
            }
        });
        

}
</script>
<script type="text/javascript">

// OBJECTS
var t_mark = 0;
var obj = {!! json_encode($test->toArray()) !!};
var length = obj.length;
    var mark_p_test = 100/length;


jQuery(document).ready(function($) {
    
   


    $('#code').submit( function(){
         //$('.processing').html('<div class="loading"><br/>Processing...</div>');

    
    values = $(this).serializeArray();
    var queue = [];
    var i=0;
    //$('.processing_'+i).html('<div class="loading">Processing...</div>');
    
    console.log(mark_p_test);
    
    $.each(obj, function (index, value) {
 // Get the parameters as an array
        $('.meta_'+i).html(" <img src='img/loading.gif' width='64' height='64' />Running..... Test "+i);
        var callback = function () {
            if ($.active !== 0) {
                setTimeout(callback, '500');
                return;
            }
            a(value.input,values,i,value.output);
            //whatever you need to do here
            //...
        };
        callback();
        
        i++;
    });
    $('.output').html('<strong>Total marks</strong>: <br><br><pre>' + t_mark ); 
    var data = $(this).serialize();
    $.ajax({
            type: 'post',
            url: '{{ url('/marks_'.$id) }}',
            dataType: 'json',
            data: data + '&mark=' + t_mark + '&process=1',
            async:false,
            cache: true,
            success: function(response){
                $('.data_save').text( "data saved successfully....");
                var box = $('#message-box-success-1');
                    if(box.length > 0){
                        box.toggleClass("open");
                        
                        var sound = box.data("sound");
                        
                        if(sound === 'alert')
                            playAudio('alert');
                        
                        if(sound === 'fail')
                            playAudio('fail');
                        
                    }
            }
        });
  
     
       return false;
    });
});

function a1(val,values,i,output){
    if(Math.pow(2,values.input) == output){
        console.log("true");
        return true;
    }
    return false;
}
function a(val,values,i,output){
    
    var index;

       

        // Find and replace `content` if there
        for (index = 0; index < values.length; ++index) {
            if (values[index].name == "input") {
                values[index].value = val;
                break;
            }
        }
        values = jQuery.param(values);

       /* var data = {
           source: $('textarea#source').val(),
           lang: 1,
           input: 11,
           process : 1
        };*/
        var source = $('textarea#source').val();

        if( source == '' ) {
            alert( 'No source code provided in the area.');
            //return false;
        }
        
       
        var final_output =0;
        $.ajax({
            type: 'post',
            url: '{{ url('/compile') }}',
            async:false,
            dataType: 'json',
            data: values + '&process=1',
            cache: true,
            success: function(response){
                $('.loading').remove();
                $('.cmpinfo').remove();
                $('#response_'+i).show();
                         if( response.status == 'success' ) {

                            if(response.output== output){

                                $('.state_'+i).html('<strong>true</strong>');
                                $('.state_'+i).append("<img id='theImg' src='img/icons/accept.png'/>");
                                $('.meta_'+i).html( response.meta + true);
                               // $('.output_'+i).html('<strong>Output</strong>: <br><br><pre>' + response.output + '</pre>' + 'here output ' + output + "true print");
                                
                                if( response.cmpinfo ) {
                                    $('.cmpinfo').remove();
                                    $('.meta_'+i).after('<div class="cmpinfo"></div>');
                                    $('.cmpinfo').html('<strong>Compiler Info: </strong> <br><br>' + response.cmpinfo );
                                }
                                final_output = 1;
                                t_mark += mark_p_test;
                                console.log("update t mark " + t_mark);
                                return true;
                            }else{
                                $('.state_'+i).html('<strong>false</strong>');
                                $('.state_'+i).append("<img id='theImg' src='img/icons/agt_action_fail.png'/>");
                                $('.meta_'+i).html( response.meta + true);
                                //$('.output_'+i).html('<strong>Output</strong>: <br><br><pre>' + response.output + '</pre>' + 'here output' + output);
                                
                                if( response.cmpinfo ) {
                                    $('.cmpinfo').remove();
                                    $('.meta_'+i).after('<div class="cmpinfo"></div>');
                                    $('.cmpinfo').html('<strong>Compiler Info: </strong> <br><br>' + response.cmpinfo );
                                }
                                final_output = 0;
                                t_mark += 0;
                                return false;
                            }
                    
                    
                } else {
                    //$('.output').html('<pre>' + response + '</pre>');
                    alert( response.output );
                }
                //alert( response.msg );
            }
        });
    console.log("final output" + final_output);
    if (final_output == 0) {
        return false;
    }else{
        return true;
    }
}


</script>





