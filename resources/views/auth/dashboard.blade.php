@extends('layouts.admin')

@section('content')

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
                    
                    <div class="row">
                        <div class="col-md-12">
                            
                            <div class="panel panel-default">
                            	
                        <div class="col-md-6"></div>
                                <div class="panel-body profile col-md-6" style="background: url('img/backgrounds/programmer-life.jpg') center center ;">
                                    <div class="profile-image">
                                        @if( $user->image )

		                                <img src="img/Users/Employee/{{ $user->image }}" alt="John Doe" style="width:100px;height:100px"/>
		                                @else
		                                <img src="img/Users/no-image.jpg" alt="John Doe" style="width:100px;height:100px"/>
		                                @endif
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name">{{  $user->user_name }}</div>
                                        <div class="profile-data-title" style="color: #FFF;">Admin of cnsytex</div>
                                        
                                    </div>
                                     <div class="mytimer" style="top:10px;">
                                    	<div class="widget-big-int plugin-clock" style="color: #FFF;font-size:30px;top:10px;right:15px;position: absolute;"><h1 >00:00</h1></div>                            
                                		<div class="widget-subtitle plugin-date" style="color: #FFF;top:45px;right:15px;position: absolute">Loading...</div>
                                	</div>
                                    
                                                                      
                                </div>                                
                                
                                <div class="panel-body list-group border-bottom">
                                    <a href="#" class="list-group-item active"><span class="fa fa-bar-chart-o"></span> Activity</a>
                                    <a href="#" class="list-group-item"><span class="fa fa-coffee"></span> Stared at: {{  $user->created_at }}<span class="badge badge-default">{{  $user->id }}</span></a>                                
                                    <a href="#" class="list-group-item"><span class="fa fa-users"></span> {{  $user->email }}</a>
                                    <a href="#" class="list-group-item"><span class="fa fa-users"></span> {{  $user->address }}</a>
                                 
                                </div>
                                
                                <div class="panel-body" id="render_me">
                                    <table id="customers" class="table ">
                                        <thead>
                                            <tr>
                                                <th>Problem</th>
                                                <th>Language</th>
                                                <th>Submitted Date</th>
                                                <th>Marks</th>
                                                <th></th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($assignments as $k => $assignment)
                                            <tr>
                                                <td><a href="assignment_{{ $assignment->id }}">{{$assignment->title}}</a></td>
                                                <td>
                                                    @foreach($languages as $language)
                                                        @if($language->value == $assignment->lang_id)
                                                            {{ $language->name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                 <td>{{$assignment->created_at }}</td>
                                                <td>{{$assignment->marks }}</td>
                                                <td><button  class="btn btn-success showProduct" data-toggle="modal" data-target="#modal_basic{{$assignment->id}}">
                                 View Reults</button>
                                                </td>
                                                
                                             </tr>
						                    @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                            </div>                            
                            
                        </div>
                        

                    </div>
                </div>

                <!-- Modal -->
                 @foreach($assignments as $k => $assignment)
                 	<div class="modal fade" id="modal_basic{{$assignment->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
							        
							        <h4 class="modal-title " id="myModalLabel">{{ $assignment->title }} Results</h4>
							        
							      
							      </div>

			      				<div class="modal-body">
			      					 <div class="panel-body">
                     	<div class="form-group">
                            <h4 class="col-md-3 col-xs-12">Language</h4>
                            <div class="col-md-9 col-xs-12"> 
                                     <h4 class="col-md-9 col-xs-12">
                                        @foreach($languages as $language)
                                            @if($language->value == $assignment->lang_id)
                                                {{ $language->name }}
                                            @endif
                                        @endforeach

                                    </h4>    
                            </div>
                        </div>
                     	<pre class="prettyprint">{{$assignment->source}}
                     	</pre>
                        <div class="form-group">
                            <h4 class="col-md-3 col-xs-12">Result</h4>
                            <div class="col-md-9 col-xs-12">                                            
                                <div >
                                    @if($assignment->marks >= 50)
                                     <h4 class="col-md-9 col-xs-12">Accepted</h4>
                                     @else
                                     <h4 class="col-md-9 col-xs-12">NOt Accepted</h4>
                                     @endif
                                </div>    
                            </div>
                        </div>

                        </div>
			      				</div>
			      				<div class="modal-footer">
							        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
							    							      
							     </div>




                                </div>
                            </div>

                  
                            </div>
                 @endforeach 

@endsection