@extends('admin.layout.master')

@section('title')
    Moderate Users
@endsection

@section('content')
	<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Users</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
									<th scope="col">Id</th>
									<th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Phonenumber</th>
									<th scope="col">Email</th>
                                    <th scope="col">Level</th>
									<th scope="col">Created at</th>
									<th colspan="2"></th>
								</tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">Id</th>
									<th scope="col">Name</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Phonenumber</th>
									<th scope="col">Email</th>
                                    <th scope="col">Level</th>
									<th scope="col">Created at</th>
									<th colspan="2"></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($admins as $value)
                                	<tr>
										<th scope="row">{{$value['id']}}</th>
										<td>{{$value['name']}}</td>
                                        <td>{{$value['username']}}</td>
                                        <td>{{$value['phonenumber']}}</td>
										<td>{{$value['email']}}</td>
                                        <td>{{$value['level']}}</td>
										<td>{{$value['created_at']->toDateString() }}</td>
										<td>
                                            <ul class="add">
                                                <li><button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete{{ $value['id'] }}">Delete</button></li>
                                                     <div class="modal" id="delete{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete admin#{{$value['id']}}?</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{ Route('admin_admin_delete', $value['id']) }}" class="btn btn-danger">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </ul>
                                        </td>
									</tr>
				    			@endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href='{{ Route('admin_admin_add') }}' class="btn btn-primary">Add admin</a>
                </div>
            </div>

            @if (session('success'))
            	<div class="bg-success rounded" style="color: white;">{{ session('success') }}</div>
            @endif

        </div>
@endsection


    <!-- Custom fonts for this template-->
