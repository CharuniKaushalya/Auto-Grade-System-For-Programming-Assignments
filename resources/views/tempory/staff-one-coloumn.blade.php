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
                            <div class="row">
                                <div class="col-md-6">
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Full Name</label>
                                    <div class="col-md-6 col-xs-12">                                            
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
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Emp Id</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-user"></span></span>
                                            <input type="text" class="form-control" name="empid" value="{{ old('empid') }}" placeholder="Employee id"/>
                                            
                                        </div>  
                                            @if ($errors->has('empid'))
                                                <span class="help-block-error">
                                                    <strong>{{ $errors->first('empid') }}</strong>
                                                </span>
                                            @endif  
                                        <span class="help-block">AEmployee id contaion 7 charactors with 6 numeric charactors</span>
                                                                            
                                        </div> 
                                        
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Email</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon">@</span>
                                            <input type="email" class="form-control" name="email" value="{{ old('email') }}"/>
                                            
                                        </div>  
                                            @if ($errors->has('email'))
                                                <span class="help-block-error">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif                                          
                                        <span class="help-block">Add a valid email</span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Password</label>
                                    <div class="col-md-4 col-xs-12">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-lock"></span></span>
                                            <input type="password" class="form-control" name="password"/>
                                            
                                        </div>  
                                            @if ($errors->has('password'))
                                                <span class="help-block-error">
                                                    <strong>{{ $errors->first('password') }}</strong>
                                                </span>
                                            @endif                                          
                                        <span class="help-block">Add a valid password(min: 6, max:8)</span>
                                    </div>
                                    <div class="col-md-2 col-xs-12">  
                                        <input class="btn btn-success" type="button" value="Generate Password" onClick="populateform(8)">
                                    
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Gender</label>
                                    <div class="col-md-4 col-xs-12">                                        
                                        <select class="form-control select" name="gender">
                                            <option value="1">Female</option>
                                            <option value="2">Male</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Role</label>
                                    <div class="col-md-4 col-xs-12">                                        
                                        <select class="form-control select" name="role">
                                            @foreach($roles as $role)
                                            <option value="{{ $role->id}}">{{ $role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Add Image</label>
                                    <div class="col-md-4 col-xs-12">                                        
                                        <div class="input-group">
                                            {!! Form::file('image') !!}

                                            
                                        </div>  
                                            @if ($errors->has('image'))
                                                <span class="help-block-error">
                                                    <strong>{{ $errors->first('image') }}</strong>
                                                </span>
                                            @endif                                          
                                        <span class="help-block">Image type can be jpg/jpeg/bmp and png</span>
                                    </div>
                                </div>
                            </div>
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
<script>

//Random password generator- by javascriptkit.com
//Visit JavaScript Kit (http://javascriptkit.com) for script
//Credit must stay intact for use

var keylist="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz123456789"
var temp=''

function generatepass(plength){
temp=''
for (i=0;i<plength;i++)
temp+=keylist.charAt(Math.floor(Math.random()*keylist.length))
return temp
}

function populateform(enterlength){
document.pgenerate.password.value=generatepass(enterlength)
}
</script>   
@endsection  

                    