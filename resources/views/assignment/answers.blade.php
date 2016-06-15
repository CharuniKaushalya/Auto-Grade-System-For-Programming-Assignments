

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
      

              
                	
                     <div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><strong>View All Answers submittedby students</strong> Layout</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
                        </div>
                        <div class="panel-body">
                            <div class="pull-right">
                                        
                                        <button class="btn btn-success toggle" data-toggle="exportTable"><i class="fa fa-bars"></i> Export Data</button>
                                    </div>
                            <div class="panel-body" id="exportTable" style="display: none;">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="list-group border-bottom">
                                                <a href="#" class="list-group-item" onClick ="$('#customers').tableExport({type:'json',escape:'false'});"><img src='img/icons/json.png' width="24"/> JSON</a>
                                                <a href="#" class="list-group-item" onClick ="$('#customers').tableExport({type:'json',escape:'false',ignoreColumn:'[2,3]'});"><img src='img/icons/json.png' width="24"/> JSON (ignoreColumn)</a>
                                                <a href="#" class="list-group-item" onClick ="$('#customers').tableExport({type:'json',escape:'true'});"><img src='img/icons/json.png' width="24"/> JSON (with Escape)</a>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="list-group border-bottom">
                                                <a href="#" class="list-group-item" onClick ="$('#customers').tableExport({type:'excel',escape:'false'});"><img src='img/icons/xls.png' width="24"/> XLS</a>
                                                 <a href="#" class="list-group-item" onClick ="$('#customers').tableExport({type:'xml',escape:'false'});"><img src='img/icons/xml.png' width="24"/> XML</a>
                                             
                                             </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="list-group border-bottom">
                                                <a href="#" class="list-group-item" onClick ="$('#customers').tableExport({type:'png',escape:'false'});"><img src='img/icons/png.png' width="24"/> PNG</a>
                                                <a href="#" class="list-group-item" onclick="generate()"><img src='img/icons/pdf.png' width="24"/> PDF</a>
                                            </div>
                                        </div>
                                    </div>                               
                            </div>
                        </div>
                        <div class="panel-body" id="render_me">
                                    <table id="customers" class="table datatable">
                                        <thead>
                                            <tr>
                                                <th></th>
                                                <th>User</th>
                                                <th>Language</th>
                                                <th>Submitted Date</th>
                                                <th>Marks</th>
                                                <th>Feedback</th>
                                                <th>Result</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($assignments as $k => $assignment)
                                            <tr>
                                                <td>{{$k +1 }}</td>
                                                <td><a href="student_{{ $assignment->id }}">@if( $assignment->image )
                                    <img src="img/Users/Employee/{{ $assignment->image }}" alt="John Doe" style="width:50px;height:50px;border-radius:50%"/>
                                @else
                                    <img src="img/Users/no-image.jpg" alt="John Doe" style="width:50px;height:50px;border-radius:50%"/>
                                @endif
                                </a>
                                                    {{$assignment->user_name}}</td>
                                                <td>
                                                    @foreach($languages as $language)
                                                        @if($language->value == $assignment->lang_id)
                                                            {{ $language->name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                                 <td>{{$assignment->created_at }}</td>
                                                <td>{{$assignment->marks }}</td>
                                                @if( $assignment->feedback )
                                                <td>{{$assignment->feedback }}</td>
                                                @else
                                                 <td><a href="feedback/{{$assignment->id}}/{{ $assignment->assignment_id }}" class="btn btn-info showProduct" data-toggle="modal" data-target="#modal_basic{{$k}}">
                                 Add Feedback
                            </a></td>
                                                @endif
                                                <td><button  class="btn btn-default showProduct" data-toggle="modal" data-target="#modal_basic2{{$k}}">
                                 View Reults</button>
                                                </td>
                                                
                                             </tr>
                                            @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                                <div class="panel-footer">
                        </div>
                    </div>
                    
    
     
      			
                            
            </div>
        </div>   
    </div>
</div>
  

<!-- Modal -->
                         @foreach($assignments as $k => $assignment)
                            <div class="modal fade" id="modal_basic{{$k}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">




                                </div>
                            </div>

                  
                            </div>
                        @endforeach 
<!-- Modal -->
                 @foreach($assignments as $k => $assignment)
                    <div class="modal fade" id="modal_basic2{{$k}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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





