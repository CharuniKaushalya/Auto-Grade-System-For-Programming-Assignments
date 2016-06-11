@extends('layouts.admin')

@section('content')
					<div class="panel panel-default">
                        <div class="panel-heading">
                                <h3 class="panel-title"><strong>View Roles</strong> Layout</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
                        </div>
                        <div class="panel-body">
                        	<div class="pull-right">
                                        <a href="{{ url('/role_insert')}}" class="btn btn-success"><i class="fa fa-plus"></i> Create New</a>
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
                        	<div class="panel-body">
                                    <table id="customers" class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Name</th>
                                                <th>Description</th>
                                                <th>Create Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($roles as $role) 
                                            <tr>
                                                <td>{{ $role->id }}</td>
                                                <td>{{ $role->name }}</td>
                                                <td>{{ $role->description }}</td>
                                                <td>{{ $role->created_at }}</td>
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