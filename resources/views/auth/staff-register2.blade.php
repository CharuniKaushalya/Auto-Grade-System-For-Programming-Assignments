@extends('layouts.admin')

@section('content')
{!! Form::open(['method'=>'POST','files'=>true]) !!}
	<div class="form-group   {{ $errors->has('type')?'has-error': ''}}">
		<div style="height:50px;">
							<div style="width:30%;float:left">
							{!! Form::label('image','Choose an imsge:')!!}</div>
							<div style="width:70%;float:left">
							{!! Form::file('image') !!}
							{!! $errors->first('image','<span class="help-block">:message</span>')!!}</div>
						</div>

	</div>
	<div class="form-group">
		{!! Form::submit('Add new Employee',['class'=>'btn btn-primary']) !!}
	</div>

{!! Form::close() !!}
@endsection  
