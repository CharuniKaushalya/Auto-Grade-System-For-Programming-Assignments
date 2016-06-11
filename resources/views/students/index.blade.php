@extends('layouts.admin')

@section('content')
         
<div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><strong>View Student Memebers</strong> Layout</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
                        </div>
                        <div class="panel-body">
                        	<div class="pull-right">
                                        <a href="{{ url('/staff_register')}}" class="btn btn-success"><i class="fa fa-plus"></i> Create New</a>
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
                        	<div class="panel-body" id="render_me">
                                    <table id="customers" class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Create Date</th>
                                                <th>Last Update</th>
                                                <th>Update</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($users as $user) 
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td style="text-align:left"><a href="student_{{ $user->id }}">
                                                    @if( $user->image )
                                                        <img src="img/Users/Employee/{{ $user->image }}" alt="John Doe" style="width:50px;height:50px;border-radius: 50%;"/>
                                                    @else
                                                        <img src="img/Users/no-image.jpg" alt="John Doe" style="width:50px;height:50px;border-radius: 50%;"/>
                                                    @endif</a>
                                                    {{ $user->user_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->created_at }}</td>
                                                <td>{{ $user->updated_at }}</td>
                                                <td><a href="{{ url('stuUpdate', $user->id) }}" class="showProduct" data-toggle="modal" data-target="#modal_basic{{$user->id}}">
                                 Update<img style="height:60px;width:50px;" src='img/icons/update3.jpg'>
                            </a>
                                                    </td>
                                             </tr>
						                    @endforeach 
                                        </tbody>
                                    </table>
                                </div>
                                 
                        </div>
                        <div class="panel-footer">
                        </div>

                        <!-- Modal -->
                         @foreach($users as $user) 
                            <div class="modal fade" id="modal_basic{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">




                                </div>
                            </div>

                  
                            </div>
                        @endforeach 



                    </div>
    


@endsection

