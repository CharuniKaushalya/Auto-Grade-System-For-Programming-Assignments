 {!! Form::model($user,['method'=>'PATCH','files'=>true]) !!}
                  
                  {!! Form::hidden('id',$user->users_id) !!}  
                   {!! Form::hidden('assignment_id',$user->assignment_id) !!}  
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        
			        <h4 class="modal-title " id="myModalLabel">Provide Feedback</h4>
			        
			      
			      </div>

			     
			      <div class="modal-body">
                       
					
						<div class="panel-body">
                            <div class="timeline-body comments">
                            <div class="comment-write">                                                
                                <textarea class="form-control" name="feedback" placeholder="Write a comment" rows="2"></textarea>    

                            </div>
                             <button class="btn btn-info pull-right" style="margin:15px">Provide Feedback</button> 

                        </div>
                        </div>

                        
					
				
			      </div>
		
			      <div class="modal-footer">

			        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

			      
			      </div>
                         {!! Form::close() !!}

			        


			    