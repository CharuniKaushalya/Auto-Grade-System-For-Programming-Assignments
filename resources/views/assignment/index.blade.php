@extends('layouts.admin')

@section('content')
<!-- page content wrapper -->
<div class="page-content-wrap">                    
                    
    <!-- page content holder -->
    <div class="page-content-holder">
        <div class="row">
            <div class="col-md-12">
                @foreach($assignments as $assignment)
                    <div class="alert alert-primary">
                        <h2><a href="assignment_{{ $assignment->id }}" class="col-md-7"><strong>{{ $assignment->title }}</strong></a></h2>
                        <a href="assignment_{{ $assignment->id }}"><button class="btn btn-success pull-right btn-lg col-md-3-offset-1">
                            <span class="fa fa-globe"></span>Solve This</button></a>&nbsp;&nbsp;&nbsp;
                            @if(Auth::check() && (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4))
                            <a href="assignmentEdit_{{ $assignment->id }}"><button class="btn btn-warning pull-right btn-lg col-md-2-offset-1" style="margin-right:10px;">
                            <span class="fa fa-edit"></span>Edit</button></a>
                            <a href="assignmentView_{{ $assignment->id }}"><button class="btn btn-danger pull-right btn-lg col-md-2-offset-1" style="margin-right:10px;">
                            <span class="fa fa-check"></span>View Answers</button></a>

                            @endif
                        <div class="col-md-12 col-xs-12"> 
                        </br> 
                            <h4><span class="control-label">
                                Difficlty : <strong>{{ $assignment->assignment_type_id }}</strong>&nbsp;&nbsp;&nbsp;
                                Max Score : <strong>10</strong>
                            </span><h4>
                        </div>
                    </div>

                @endforeach
                            
            </div>
        </div>   
    </div>
</div>  
@endsection

