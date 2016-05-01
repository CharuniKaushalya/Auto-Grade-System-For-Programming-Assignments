@extends('layouts.admin')

@section('content')
<!-- page content wrapper -->
<div class="page-content-wrap">                    
                    
    <!-- page content holder -->
    <div class="page-content-holder">
        <div class="row">
            <div class="col-md-12">
                     
                {!! Form::open(['method'=>'POST','files'=>true,'role'=>'form','class'=>'form-horizontal','name'=>'pgenerate']) !!}
                {!! csrf_field() !!}
                	<div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><strong>Add a Assignment</strong> Layout</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
                        </div>
                        <div class="panel-body">
                        </div>
                        <div class="panel-body">
                                <div class="form-group">
                                    <h4 class="col-md-2 col-xs-12 control-label">Title</h4>
                                    <div class="col-md-10 col-xs-12">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="title" value="{{ old('name') }}"/>
                                            
                                        </div>  
                                            @if ($errors->has('title'))
                                                <span class="help-block-error">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif                                          
                                       </div>
                                </div>
                                <h4 class="col-md-2 col-xs-12 control-label">Dificulty</h4>
                                    <div class="col-md-10 col-xs-12">  
                                            <select class="form-control select" name="type">
                                            	<option value="1">Easy</option>
                                            	<option value="2">Medium</option>
                                            	<option value="3">Difficult</option>    
                                            </select>                               
                                       </div>
                                </div>
                                
                                <div class="block col-md-12">
                                	<h4>Description</h4>
                                    <p>To view code preivew, check "Code View" mode.</p>
                               		<textarea class="summernote" name="editor" style="height:500px;"> </textarea>
                           			@if ($errors->has('description'))
                                        <span class="help-block-error">
                                            <strong>{{ $errors->first('description') }}</strong>
                                         </span>
                                    @endif    		
                            	</div>
                            	<div class="block col-md-12">
                                	<h4 class="col-md-3">Sample Input</h4>
                               		<textarea  class="col-md-9" name="input"> </textarea>
                           			@if ($errors->has('input'))
                                        <span class="help-block-error">
                                            <strong>{{ $errors->first('input') }}</strong>
                                         </span>
                                    @endif    		
                            	</div>
                            	<div class="block col-md-12">
                                	<h4 class="col-md-3">Sample Output</h4>
                               		<textarea class="col-md-9" name="output"> </textarea>
                           			@if ($errors->has('output'))
                                        <span class="help-block-error">
                                            <strong>{{ $errors->first('output') }}</strong>
                                         </span>
                                    @endif    		
                            	</div>
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-default">Clear Form</button>                                    
                            <button class="btn btn-primary pull-right" type="submit" name="submit" value="true">Submit</button>
                        </div>
                    </div>
                {!! Form::close() !!}
                            
            </div>
        </div>   
    </div>
</div> 
       

@endsection