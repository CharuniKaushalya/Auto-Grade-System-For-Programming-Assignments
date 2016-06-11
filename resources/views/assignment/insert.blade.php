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
                                    <div class="col-md-9 col-xs-12">                                            
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
                                <div class="form-group">
                                <h4 class="col-md-2 col-xs-12 control-label">Dificulty</h4>
                                    <div class="col-md-9 col-xs-12">  
                                            <select class="form-control select" name="type">
                                            	<option value="1">Easy</option>
                                            	<option value="2">Medium</option>
                                            	<option value="3">Difficult</option>    
                                            </select>                               
                                       </div>
                                </div>
                                
                                <div class="block col-md-10">
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
                                <div class="block col-md-12">
                                    <h4 class="col-md-3">Add test cases</h4>
                                    <input type="button" id="addBox" value="Add Test Case" class="btn btn-primary"/>
                                    <div id="myBox" class="col-md-12"></div>
                                   
                                        
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
       
<script>
var i =0;
$("#addBox").click(function () {
  /*  
var newDD = $("<div class=\"block col-md-12\">");
$(newDD).append("<h4 class=\"col-md-3\">Sample Input</h4>");
$(newDD).append("<textarea class=\"col-md-9\" name=\"test[i][input]\" required> ");
$(newDD).append("</textarea>");
$(newDD).append("<h4 class=\"col-md-3\">Sample Outputs</h4>");
$(newDD).append("<textarea class=\"col-md-9\" name=\"test[\'+i+\'][output]\" required> ");
$(newDD).append("</textarea>");
$(newDD).append("</div>");
$("#myBox").append(newDD);*/

var br = document.createElement('br');     // Create a `br` element,
var headF = $("</div>"); // Create a `input` element,
var head = $("<div class=\"block col-md-12\">"); // Create a `input` element,
var h1 = $("<h4 class=\"col-md-3\">Sample Input</h4>"); // Create a `input` element,


var tagd1 = document.createElement('textarea'); // Create a `input` element,
tagd1.setAttribute('class', 'col-md-9');          // Set it's `class` attribute,
tagd1.setAttribute('placeholder', 'Add Input');          // Set it's `placeholder` attribute,
tagd1.setAttribute('name', 'test['+i+'][input]');               // Set it's `name` attribute,
var h2 = $("<h4 class=\"col-md-3\">Sample Output</h4>"); // Create a `input` element,


var tagd2 = document.createElement('textarea'); // Create a `input` element,
tagd2.setAttribute('class', 'col-md-9');          // Set it's `class` attribute,
tagd2.setAttribute('placeholder', 'Add Output');          // Set it's `placeholder` attribute,
tagd2.setAttribute('name', 'test['+i+'][output]');               // Set it's `name` attribute,


var y = document.getElementById("myBox");      // "Get" the `y` element,
$("#myBox").append(head);
$("#myBox").append(h1);                      // Append the input to `y`,
y.appendChild(tagd1);                        // Append the input to `y`,
y.appendChild(br);                         // Append the br to `y`.
y.appendChild(br);                         // Append the br to `y`.
$("#myBox").append(h2);                      // Append the input to `y`,
y.appendChild(tagd2);                         // Append the br to `y`.
y.appendChild(br);                         // Append the br to `y`.
y.appendChild(br);                         // Append the br to `y`.
$("#myBox").append(headF);
i++;
});
</script>
@endsection
