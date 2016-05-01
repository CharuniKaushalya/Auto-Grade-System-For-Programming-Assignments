@extends('layouts.admin')

@section('content')
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
                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h2 class="panel-title"><strong>Compile</strong> Code</h2>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
                        </div>
                          {!! $code or 'mycodeee' !!}

                        {!! Form::open(['method'=>'POST','files'=>true,'role'=>'form','class'=>'form-horizontal','name'=>'compile']) !!}
                        {!! csrf_field() !!}
                        <div class="panel-body">
                            <div class="form-group">
                                <h4 class="col-md-10 col-xs-12 control-label">Code</h4>
                                <div class="col-md-2 col-xs-12">                                            
                                    <div class="input-group full-right">
                                        <select class="form-control select full-right" name="lang">
                                            <option value="11">C (gcc-4.3.4)</option>
                                            <option value="27">C# (mono-2.8)</option>
                                            <option value="1" selected="selected">C++ (gcc-4.7.2)</option>
                                            <option value="44">C++0x (gcc-4.5.1)</option>
                                            <option value="10">Java (sun-jdk-1.6.0.17)</option>
                                            <option value="35">JavaScript (rhino) (rhino-1.6.5)</option>
                                            <option value="112">JavaScript (spidermonkey) (spidermonkey-1.7)</option>
                                            <option value="29">PHP (php 5.2.11)</option>
                                            <option value="4">Python (python 2.6.4)</option>
                                            <option value="116">Python 3 (python-3.1.2)</option>
                                            <option value="40">SQL (sqlite3-3.7.3)</option> 
                                        </select>  
                                            
                                    </div>                                           
                                </div>
                            </div>


                            <div class="form-group">
                            <div class="col-md-12 col-xs-12"> 
                                <textarea class="col-md-12" style="height:400px;" name="code" id="code"></textarea>                                          
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-12 col-xs-12"> 
                                    <h4 class="col-md-1 col-xs-12 control-label">Input</h4>
                                    <textarea class="col-md-12" style="height:200px;" name="input" id="input" ></textarea>                                          
                                </div>
                            </div>

                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-default">Clear Form</button>                                    
                            <button class="btn btn-primary pull-right" type="submit" name="submit" value="submit">Submit</button>
                        </div>
                        {!! Form::close() !!}

                        <div id="response">
                            <div class="meta"></div>
                            <div class="output"></div>
                        </div>
                    </div>
                            
            </div>
        </div>   
    </div>
</div>  
@endsection