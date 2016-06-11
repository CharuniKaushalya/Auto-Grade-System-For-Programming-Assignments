 {!! Form::model($user,['method'=>'PATCH','files'=>true]) !!}
			      
			      {!! Form::hidden('id',$user->id) !!}	
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        
			        <h4 class="modal-title " id="myModalLabel">Update Student Details</h4>
			        
			      
			      </div>

			     
			      <div class="modal-body">
                       
					
						<div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}" style="height:30px;">
                            <label class="col-md-4 control-label">Name</label>

                            <div class="col-md-8">
                                <input type="text" class="form-control" name="name" value="{{$user->user_name}}">

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}" style="height:30px;">
                            <label class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-8">
                                <input type="email" class="form-control" name="email" value="{{ $user->email }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

						<div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}" style="height:35px;">
                            <label class="col-md-4 col-xs-12 control-label">Gender</label>
                            <div class="col-md-8 col-xs-12">                                        
                                 {{ Form::select('gender', [1 => "Female",2=> "Male"], $user->gender_id  , ['class' => 'form-control select']) }}                             
                                       
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}" style="height:30px;">
                                    <label class="col-md-4 col-xs-12 control-label">Add Image</label>
                                    <div class="col-md-8 col-xs-12">                                        
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
		
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
			      {!! Form::submit('Update',['class'=>'btn btn-primary']) !!}
			      
			      </div>
			        
			        {!! Form::close() !!}

			    