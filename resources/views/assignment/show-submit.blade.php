
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
        <script src="https://cdn.rawgit.com/google/code-prettify/master/loader/run_prettify.js"></script>
<!-- page content wrapper -->
<div class="page-content-wrap">                    
                    
    <!-- page content holder -->
    <div class="page-content-holder">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                        <div class="panel-heading">
                                <h2 class="panel-title"><strong>Assignment {{ $assignment->title or ''}}</strong> Details</h2>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
                        </div>
                        <div class="panel-body">
                        </div>
                        <div class="panel-body">
                                <h4 class="col-md-4 col-xs-12 control-label"><strong>Problem</strong></h4>
                                <div class="form-group">
                                    <div class="col-md-12 col-xs-12">
                                        {!! $assignment->description or ''!!}                                        
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h4 class="col-md-4 col-xs-12 control-label"><strong>Sample Input</strong></h4>
                                    <div class="alert alert-primary">
                                        <h4 class="col-md-8 col-xs-12">
                                        {!! $assignment->input or ''!!}                                        
                                        </h4>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <h4 class="col-md-4 col-xs-12 control-label"><strong>Sample Output</strong></h4>
                                    <div class="alert alert-primary">
                                        <h4 class="col-md-8 col-xs-12">
                                            {!! $assignment->output or ''!!}                                        
                                        </h4>
                                    </div>
                                </div>
                        </div>
                        <div class="panel-footer">
                        </div>
                </div>


                <div id="wrapper" class="panel panel-default">
                    <div class="panel-heading">
                        <h2 class="panel-title"><strong>My Solution</strong> Layout</h2>
                        <ul class="panel-controls">
                            <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                        </ul>
                     </div>
                     <div class="panel-body">
                     	<pre class="prettyprint">
                     		{{ $submit->source }}
                     	</pre>
            			<div class="form-group">
                            <h3 class="col-md-3 col-xs-12">Total marks</h3>
                            <div class="col-md-9 col-xs-12">                                            
                                <div class="input-group">
                                     <h3 class="col-md-9 col-xs-12">{{ $submit->marks }}</h3>
                                </div>    
                            </div>
                        </div>
                        <div class="form-group">
                            <h3 class="col-md-3 col-xs-12">Submited Date</h3>
                            <div class="col-md-9 col-xs-12">                                            
                                <div class="input-group">
                                     <h3 class="col-md-9 col-xs-12">{{ $submit->created_at }}</h3>
                                </div>    
                            </div>
                        </div>

                        </div>
                    <div class="panel-footer">
                     </div>
    
     
      			</div>
                            
            </div>
        </div>   
    </div>
</div>
  
@endsection





