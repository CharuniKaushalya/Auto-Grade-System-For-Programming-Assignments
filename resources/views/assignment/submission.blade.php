

@extends('layouts.admin')

@section('content')
        <script type="text/javascript" src="js/plugins/codemirror/codemirror.js"></script>        
        <script type='text/javascript' src="js/plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
        <script type='text/javascript' src="js/plugins/codemirror/mode/xml/xml.js"></script>
        <script type='text/javascript' src="js/plugins/codemirror/mode/javascript/javascript.js"></script>
        <script type='text/javascript' src="js/plugins/codemirror/mode/css/css.js"></script>
        <script type='text/javascript' src="js/plugins/codemirror/mode/clike/clike.js"></script>
        <script type='text/javascript' src="js/plugins/codemirror/mode/php/php.js"></script> 
        <script type="text/javascript" src="js/plugins/summernote/summernote.js"></script>
 <!-- page content wrapper -->
<div class="page-content-wrap">                    
                    
    <!-- page content holder -->
    <div class="page-content-holder">
        <div class="row">
            <div class="col-md-12">


                <div id="wrapper" class="panel panel-default">
                	@foreach($assignments as $assignment)
                    <div class="panel-heading">
                       
                    	<div class="profile-image">
                        <h2 class="panel-title"> 
                        		@if( $assignment->image )
									<img src="img/Users/Employee/{{ $assignment->image }}" alt="John Doe" style="width:50px;height:50px"/>
                                @else
                                	<img src="img/Users/no-image.jpg" alt="John Doe" style="width:50px;height:50px"/>
                                @endif
                        	<strong>{{$assignment->user_name}}</strong> Answer</h2>
                        </div>
                                
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                     </div>
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
                            <h4 class="col-md-3 col-xs-12">Total marks</h4>
                            <div class="col-md-9 col-xs-12">                                            
                                <div class="input-group">
                                     <h4 class="col-md-9 col-xs-12">{{$assignment->marks or 0}}</h4>
                                </div>    
                            </div>
                        </div>
                        <div class="form-group">
                            <h4 class="col-md-3 col-xs-12">Submited Date</h4>
                            <div class="col-md-9 col-xs-12">                                            
                                <div >
                                     <h4 class="col-md-9 col-xs-12">{{$assignment->created_at}}</h4>
                                </div>    
                            </div>
                        </div>
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
                    <br/><br/><hr>
                     @endforeach
    
     
      			</div>
                            
            </div>
        </div>   
    </div>
</div>
  
@endsection





