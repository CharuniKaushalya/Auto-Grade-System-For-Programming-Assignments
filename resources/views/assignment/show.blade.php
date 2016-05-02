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
                                <h2 class="panel-title"><strong>Assignment {{ $assignment->title or ''}}</strong> Details</h2>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
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
                        </div>
                </div>
                <div id="wrapper" class="panel panel-default">
        <div class="panel-heading">
            <h2 class="panel-title"><strong>Online Code Compiler</strong> Layout</h2>
            <ul class="panel-controls">
                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
            </ul>
         </div>
        {!! Form::open(['method'=>'POST','files'=>true,'role'=>'form','class'=>'form-horizontal','id'=>'code']) !!}
        {!! csrf_field() !!}
            <div class="panel-body">
                <div class="form-group">
                                <h4 class="col-md-7 col-xs-12 control-label">Select Language</h4>
                                <div class="col-md-4 col-xs-12">                                            
                                    <div>
                                        <select name="lang" id="lang" class="form-control select full-right">
                                          <option value="7    ">Ada (gnat-4.3.2)</option>
                                            <option value="13">Assembler (nasm-2.07)</option>
                                            <option value="45">Assembler (gcc-4.3.4)</option>
                                            <option value="104">AWK (gawk) (gawk-3.1.6)</option>
                                            <option value="105">AWK (mawk) (mawk-1.3  .3)</option>
                                            <option value="28">Bash (bash 4.0.35)</option>
                                            <option value="110">bc (bc-1.06.95)</option>
                                            <option value="12">Brainf**k (bff-1.0.3.1)</option>
                                            <option value="11">C (gcc-4.3.4)</option>
                                            <option value="27">C# (mono-2.8)</option>
                                            <option value="1" selected="selected">C++ (gcc-4.3.4)</option>
                                            <option value="44">C++0x (gcc-4.5.1)</option>
                                            <option value="34">C99 strict (gcc-4.3.4)</option>
                                            <option value="14">CLIPS (clips 6.24)</option>
                                            <option value="111">Clojure (clojure 1.1.0)</option>
                                            <option value="118">COBOL (open-cobol-1.0)</option>
                                            <option value="106">COBOL 85 (tinycobol-0.65.9)</option>
                                            <option value="32">Common Lisp (clisp) (clisp 2.47)</option>
                                            <option value="102">D (dmd) (dmd-2.042)</option>
                                            <option value="36">Erlang (erl-5.7.3)</option>
                                            <option value="124">F# (fsharp-2.0.0)</option>
                                            <option value="123">Factor (factor-0.93)</option>
                                            <option value="125">Falcon (falcon-0.9.6.6)</option>
                                            <option value="107">Forth (gforth-0.7.0)</option>
                                            <option value="5">Fortran (gfortran-4.3.4)</option>
                                            <option value="114">Go (gc-2010-07-14)</option>
                                            <option value="121">Groovy (groovy-1.7)</option>
                                            <option value="21">Haskell (ghc-6.8.2)</option>
                                            <option value="16">Icon (iconc 9.4.3)</option>
                                            <option value="9">Intercal (c-intercal 28.0-r1)</option>
                                            <option value="10">Java (sun-jdk-1.6.0.17)</option>
                                            <option value="35">JavaScript (rhino) (rhino-1.6.5)</option>
                                            <option value="112">JavaScript (spidermonkey) (spidermonkey-1.7)</option>
                                            <option value="26">Lua (luac 5.1.4)</option>
                                            <option value="30">Nemerle (ncc 0.9.3)</option>
                                            <option value="25">Nice (nicec 0.9.6)</option>
                                            <option value="122">Nimrod (nimrod-0.8.8)</option>
                                            <option value="43">Objective-C (gcc-4.5.1)</option>
                                            <option value="8">Ocaml (ocamlopt 3.10.2)</option>
                                            <option value="119">Oz (mozart-1.4.0)</option>
                                            <option value="22">Pascal (fpc) (fpc 2.2.0)</option>
                                            <option value="2">Pascal (gpc) (gpc 20070904)</option>
                                            <option value="3">Perl (perl 5.12.1)</option>
                                            <option value="54">Perl 6 (rakudo-2010.08)</option>
                                            <option value="29">PHP (php 5.2.11)</option>
                                            <option value="19">Pike (pike 7.6.86)</option>
                                            <option value="108">Prolog (gnu) (gprolog-1.3.1)</option>
                                            <option value="15">Prolog (swi) (swipl 5.6.64)</option>
                                            <option value="4">Python (python 2.6.4)</option>
                                            <option value="116">Python 3 (python-3.1.2)</option>
                                            <option value="117">R (R-2.11.1)</option>
                                            <option value="17">Ruby (ruby-1.9.2)</option>
                                            <option value="39">Scala (scala-2.8.0.final)</option>
                                            <option value="33">Scheme (guile) (guile 1.8.5)</option>
                                            <option value="23">Smalltalk (gst 3.1)</option>
                                            <option value="40">SQL (sqlite3-3.7.3)</option>
                                            <option value="38">Tcl (tclsh 8.5.7)</option>
                                            <option value="62">Text (text 6.10)</option>
                                            <option value="115">Unlambda (unlambda-2.0.0)</option>
                                            <option value="101">Visual Basic .NET (mono-2.4.2.3)</option>
                                            <option value="6">Whitespace (wspace 0.3)</option>
                                        </select>
                                    </div>                                          
                                </div>
                </div>
                <div class="form-group">
                    <h4 class="col-md-3  control-label" for="source">Source Code:</h4>
                    <textarea class="col-md-8" cols="40" rows="15" name="source" id="source"></textarea>

                 </div>
                 <div class="form-group">
                    <h4 class="col-md-3  control-label" for="source">Input: <span class="description">Input Test Cases Here</span></h4>
                    <textarea class="col-md-8" cols="40" rows="4" name="input" id="input"></textarea>
                 </div>

                 <div id="response"  style="font-size:16px;text-align:center">
                    <div class="processing"></div>
                    <div class="meta"></div>
                    <div class="output"></div>
                </div>

                <div class="panel-footer"> 
                    <input type="submit" name="submit23" class="btn btn-primary btn-large pull-right" value="Submit" />                               
                    <input type="submit" name="submit" class="btn btn-success btn-large pull-right" value="Run Code" />

                 </div>
        {!! Form::close() !!}

        
  
  
    </div>
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
jQuery(document).ready(function($) {
    $('#code').submit( function(){
        var data = $(this).serialize();
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
        
        return false;
    });
});

</script>
