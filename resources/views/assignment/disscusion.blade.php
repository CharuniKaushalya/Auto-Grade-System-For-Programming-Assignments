@extends('layouts.admin')

@section('content')
                    <!-- MESSAGES WIDGET -->
                        <div class="col-md-8 col-md-offset-2">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><span class="fa fa-comments"></span> Discussion</h3>
                                    <div class="pull-right">
                                    </div>
                                </div>
                                <div class="panel-body">

                                    <div class="messages messages-img">
                                        @foreach($comments as $k => $comment)
                                        @if($k%2 == 0)
                                        <div class="item in">
                                            <div class="image">
                                                @if( $comment->image )
                                                        <img src="img/Users/Employee/{{ $comment->image }}" alt="John Doe" style="width:50px;height:50px;border-radius: 50%;"/>
                                                    @else
                                                        <img src="img/Users/no-image.jpg" alt="John Doe" style="width:50px;height:50px;border-radius: 50%;"/>
                                                    @endif
                                            </div>
                                            <div class="text">
                                                <div class="heading">
                                                    <a href="#">{{ $comment->user_name }}</a>
                                                    <span class="date">08:33</span>
                                                </div>
                                                {{$comment->comment }}
                                            </div>
                                        </div>
                                        @else
                                        <div class="item">
                                            <div class="image">
                                                @if( $comment->image )
                                                        <img src="img/Users/Employee/{{ $comment->image }}" alt="John Doe" style="width:50px;height:50px;border-radius: 50%;"/>
                                                    @else
                                                        <img src="img/Users/no-image.jpg" alt="John Doe" style="width:50px;height:50px;border-radius: 50%;"/>
                                                    @endif
                                            </div>
                                            <div class="text">
                                                <div class="heading">
                                                    <a href="#">{{ $comment->user_name }}</a>
                                                    <span class="date">08:33</span>
                                                </div>
                                                {{$comment->comment }}
                                            </div>
                                        </div>
                                        @endif
                                        @endforeach                           
                                    </div>                                

                                </div>
                                <div class="panel-footer">
                                      {!! Form::open(['method'=>'POST','role'=>'form','class'=>'form-horizontal']) !!}
                                    {!! csrf_field() !!}

                                    <div class="input-group">                                    
                                        <input type="text" name="comment" rows="5" class="form-control" placeholder="Type a message..."/>
                                        <span class="input-group-btn">
                                            <button class="btn btn-default" type="submit">Send</button>
                                        </span>                                    
                                    </div> 
                                    {!! Form::close() !!}   
                                </div>
                            </div>

                        </div>
                        <!-- END MESSAGES WIDGET -->
@endsection