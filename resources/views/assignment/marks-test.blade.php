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

@endsection
