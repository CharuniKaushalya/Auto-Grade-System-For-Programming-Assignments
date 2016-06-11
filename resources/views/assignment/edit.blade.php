@extends('layouts.admin')

@section('content')
<!-- page content wrapper -->
<div class="page-content-wrap">                    
                    
    <!-- page content holder -->
    <div class="page-content-holder">
        <div class="row">
            <div class="col-md-12">
                     
                {!! Form::model($assignment,['method'=>'POST','files'=>true,'role'=>'form','class'=>'form-horizontal','name'=>'pgenerate']) !!}
                {!! Form::hidden('id',$assignment->id) !!}
                	<div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><strong>Edit Assignment</strong> Layout</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
                        </div>
                        <div class="panel-body">
                        </div>
                        <div class="panel-body">
                                <div class="form-group  {{ $errors->has('type')?'has-error': ''}}">
                                    <h4 class="col-md-2 col-xs-12 control-label">Title</h4>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <div class="input-group">
                                           <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="title" value="{{ $assignment->title }}"/>
                                         </div>  
                                            @if ($errors->has('title'))
                                                <span class="help-block-error">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif                                          
                                       </div>
                                </div>
                                <div class="form-group">
                                <h4 class="col-md-2 col-xs-12 control-label">Dificulty</h4>
                                    <div class="col-md-9 col-xs-12">  
                                        {{ Form::select('type', [1 => "Easy",2=> "Medium",3 => "Difficult"], $assignment->assignment_type_id  , ['class' => 'form-control select']) }}                             
                                       </div>
                                </div>
                                
                                <div class="block col-md-10">
                                	<h4>Description</h4>
                                    <p>To view code preivew, check "Code View" mode.</p>
                               		<textarea class="summernote" name="editor" style="height:500px;" row="100">{{ $assignment->description }} </textarea>
                           			@if ($errors->has('description'))
                                        <span class="help-block-error">
                                            <strong>{{ $errors->first('description') }}</strong>
                                         </span>
                                    @endif    		
                            	</div>
                            	
                                

                                
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-default">Clear Form</button>                                    
                            <button class="btn btn-primary pull-right" type="submit" name="Submit" value="true">Submit</button>
                        </div>
                    </div>
                {!! Form::close() !!}
                            
            </div>
        </div>   
    </div>
</div> 
 <script type="text/javascript">
 var content = $('#msg500').text();
$('#msg500').wrapInner('<textarea>'+content+'</textarea>');
$('#msg500').html( $('#in').val() );
 </script>   

@endsection
