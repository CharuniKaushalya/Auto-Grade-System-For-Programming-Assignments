@extends('layouts.admin')

@section('content')
         
<div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><strong>View Laaderboard Memebers</strong> Layout</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
                        </div>
                        <div class="panel-body">
                        	<div class="pull-right">
                                    @if(Auth::check() && (Auth::user()->role_id == 2 || Auth::user()->role_id == 3 || Auth::user()->role_id == 4))
                                        <a href="#"  class="btn btn-success toggle" data-toggle="exportTable"><i class="fa fa-bars"></i> Export Data</a>
                                    @endif
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
                        	<div class="panel-body" id="render_me">
                                    <table id="customers" class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>Rank</th>
                                                <th>Name</th>
                                                <th>Marks</th>
                                                <th>Language</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach($assignments as $k => $assignment)
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td style="text-align:left;padding-left:50px;">
                                                    @if( $assignment->image )
                                                        <img src="img/Users/Employee/{{ $assignment->image }}" alt="John Doe" style="width:50px;height:50px;border-radius: 50%;"/>
                                                    @else
                                                        <img src="img/Users/no-image.jpg" alt="John Doe" style="width:50px;height:50px;border-radius: 50%;"/>
                                                    @endif
                                                    {{$assignment->user_name}}
                                                    
                                                </td>
                                                <td>{{$assignment->marks }}</td>
                                                <td>
                                                    @foreach($languages as $language)
                                                        @if($language->value == $assignment->lang_id)
                                                            {{ $language->name }}
                                                        @endif
                                                    @endforeach
                                                </td>
                                             </tr>
						                    @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                                 
                        </div>
                        <div class="panel-footer">
                        </div>
                    </div>
    


@endsection

