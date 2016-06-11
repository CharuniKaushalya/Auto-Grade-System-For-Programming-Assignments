@extends('layouts.admin')

@section('content')

<!-- PAGE CONTENT WRAPPER -->
<div class="page-content-wrap">
                    
                    <div class="row">
                        <div class="col-md-3">
                            
                            <div class="panel panel-default">
                                <div class="panel-body profile" style="background: url('img/backgrounds/programmer-life.jpg') center center no-repeat;">
                                    <div class="profile-image">
                                        @if( $user->image )

		                                <img src="img/Users/Employee/{{ $user->image }}" alt="John Doe" style="width:100px;height:100px"/>
		                                @else
		                                <img src="img/Users/no-image.jpg" alt="John Doe" style="width:100px;height:100px"/>
		                                @endif
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name">{{  $user->user_name }}</div>
                                        <div class="profile-data-title" style="color: #FFF;">Student of cnsytex</div>
                                    </div>
                                    <div class="profile-controls">
                                        <a href="#" class="profile-control-left twitter"><span class="fa fa-twitter"></span></a>
                                        <a href="#" class="profile-control-right facebook"><span class="fa fa-facebook"></span></a>
                                    </div>                                    
                                </div>                                
                                
                                <div class="panel-body list-group border-bottom">
                                    <a href="#" class="list-group-item active"><span class="fa fa-bar-chart-o"></span> Activity</a>
                                    <a href="#" class="list-group-item"><span class="fa fa-coffee"></span> {{  $user->user_name }}<span class="badge badge-default">{{  $user->id }}</span></a>                                
                                    <a href="#" class="list-group-item"><span class="fa fa-users"></span> {{  $user->email }}</a>
                                    <a href="#" class="list-group-item"><span class="fa fa-folder"></span> {{  $user->address }}</a>
                                    <a href="#" class="list-group-item"><span class="fa fa-cog"></span> Settings</a>
                                </div>
                                <div class="panel-body">
                                    <h4 class="text-title">Submitted Assignments</h4>
                                    <div class="row">
                                    	@foreach($assignments as $assignment)
                                        <div class="col-md-4 col-xs-4">
                                            <a href="#" class="friend">
                                                <span>{{$assignment->title}}</span>
                                            </a>                                            
                                        </div>
                                          @endforeach
                                    </div>
                                </div>
                            </div>                            
                            
                        </div>
                        <div class="col-md-9">
                        	 <!-- START TIMELINE -->
                            <div class="timeline timeline-right">
                            	<!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-main">
                                	<div class="timeline-date">2016</div>
                                </div>
                                <!-- END TIMELINE ITEM -->   
                              </div>
                             <!-- START TIMELINE -->
                            <div class="timeline timeline-right">

                        	@foreach($assignments as $k => $assignment)
                                       

                            
          
                                
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-main">
                                    <div class="timeline-date">{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $assignment->created_at)->format('M-D') }}</div>
                                </div>
                                <!-- END TIMELINE ITEM -->  
                                <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-item-right">
                                    <div class="timeline-item-info">
                                    	{{ \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $assignment->created_at)->format('H:i') }}
                                    </div>
                                    <div class="timeline-item-icon"><span class="fa fa-info-circle"></span></div>                                   
                                    <div class="timeline-item-content">
                                        <div class="timeline-heading" style="padding-bottom: 10px;">
                                             @if( $user->image )

		                                <img src="img/Users/Employee/{{ $user->image }}" alt="John Doe"/>
		                                @else
		                                <img src="img/Users/no-image.jpg" alt="John Doe"/>
		                                @endif
                                            <a href="#">{{ $user->user_name}}</a> submitted assignment <strong>{{ $assignment->title}}</strong>

                                        </div> 
                                        <div class="timeline-body">                                            
                                            <i>Total marks {{ $assignment->marks or 0 }}</i>
                                            <pre class="prettyprint">{{$assignment->source}}
					                     	</pre>
                                        </div>                                       
                                        <div class="timeline-body comments">
                                                                                       
                                            <div class="comment-write">                                                
                                                <textarea class="form-control" placeholder="Write a comment" rows="1"></textarea>                                                
                                            </div>
                                        </div>
                                    </div>                                    
                                </div>       
                                <!-- END TIMELINE ITEM -->
                             
                              @endforeach
                               <!-- START TIMELINE ITEM -->
                                <div class="timeline-item timeline-main">
                                    <div class="timeline-date"><a href="#"><span class="fa fa-ellipsis-h"></span></a></div>
                                </div>                                
                             </div>   <!-- END TIMELINE ITEM -->
                        </div>
                    </div>
                </div>
@endsection