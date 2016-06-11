@extends('layouts.admin')

@section('content')
    <!-- page content wrapper -->
    <div class="page-content-wrap">                    
                    
        <!-- page content holder -->
        <div class="page-content-holder">
            <div class="row">
                 <div class="col-md-12">
                            
                    <form class="form-horizontal" role="form" method="POST">
                     {!! csrf_field() !!}
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Add Programming Language</strong> Layout</h3>
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
                                    <label class="col-md-3 col-xs-12 control-label">Title</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" name="title"/>
                                            
                                        </div>  
                                            @if ($errors->has('title'))
                                                <span class="help-block-error">
                                                    <strong>{{ $errors->first('title') }}</strong>
                                                </span>
                                            @endif                                          
                                        <span class="help-block">Add name of the programming language (Eg:C (gcc-4.3.4))</span>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Value</label>
                                    <div class="col-md-6 col-xs-12">                                            
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="number" class="form-control" name="value"/>
                                            
                                        </div>  
                                            @if ($errors->has('value'))
                                                <span class="help-block-error">
                                                    <strong>{{ $errors->first('value') }}</strong>
                                                </span>
                                            @endif                                          
                                        <span class="help-block">Add id given by ideone api for that language (Eg:4 for c programming language)</span>
                                    </div>
                                </div>
                                    
                                   
                                    
                                
                                    

                                </div>
                            <div class="panel-footer">
                                <button class="btn btn-default">Clear Form</button>                                    
                                <button class="btn btn-primary pull-right" type="submit" name="submit" value="true">Submit</button>
                            </div>
                        </div>
                    </form>
                            
                </div>
            </div>   
        </div>
    </div>  

@endsection               
                    