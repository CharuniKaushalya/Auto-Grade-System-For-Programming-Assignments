@extends('layouts.single')

@section('content')
@endsection

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
                {!! Form::close() !!}
                            
            </div>
        </div>   
    </div>
</div>  
@endsection


public function insert(){
		return view();

	}

	public function postInsert(Request $request){
		dd($request->all());
		return redirect('assignment_insert');
	}



	//panel
	<div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><strong>Add Administative staff</strong> Layout</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
                        </div>
                        <div class="panel-body">
                                <p> The Administrator has full system access and should be used only
                                 for administrative tasks. There are basically no restrictions on what you can do
                                  to your system as the root user, which is powerful, but extremely dangerous. 
                                  To alleviate this risk, we can create a new user, who has less privileges, 
                                  but is more appropriately suited to everyday tasks.</p>
                        </div>
                        <div class="panel-body">
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Full Name</label>
                                    <div class="col-md-9 col-xs-12">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"/>
                                            
                                        </div>  
                                            @if ($errors->has('name'))
                                                <span class="help-block-error">
                                                    <strong>{{ $errors->first('name') }}</strong>
                                                </span>
                                            @endif                                          
                                       </div>
                                </div>
                        </div>
                        <div class="panel-footer">
                            <button class="btn btn-default">Clear Form</button>                                    
                            <button class="btn btn-primary pull-right" type="submit" name="submit" value="true">Submit</button>
                        </div>
                    </div>



  //get by id
   $product = Product::find($id);

    get all
     $products = Product::get();