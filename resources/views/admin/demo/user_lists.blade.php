@extends('admin.layout.master')

@section('title')
    Category
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
									<th scope="col">Created at</th>
									<th colspan="2"></th>
                                </tr>
                            </tfoot>
                            <tbody class="add">
                                @foreach ($users as $value)
                                	@if ($value['is_admin'] != '2')
										<tr>
											<th scope="row">{{$value['id']}}</th>
											<td>{{$value['name']}}</td>
                                            <td>{{$value['username']}}</td>
                                            <td>{{$value['phone']}}</td>
											<td>{{$value['email']}}</td>
											<td>{{$value['created_at']->toDateString() }}</td>
											<td>
                                                <ul>
                                                    <li><button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete{{ $value['id'] }}">Delete</button></li>
                                                     <div class="modal" id="delete{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Delete user#{{$value['id']}}?</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{ Route('admin_user_delete', $value['id']) }}" class="btn btn-danger">Delete</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <li><a href="{{ Route('admin_order_lists', $value['id'] ) }}"><button class="btn btn-success">Orders</button></a></li>
                                                    <li><a href="{{ Route('admin_comment_lists' , ['user_id' => $value['id']]) }}"><button class="btn btn-primary">Comments</button></a></li>
                                                </ul>
                                            </td>
										</tr>
									@endif
								@endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            @if (session('success'))
            	<div class="bg-success rounded" style="color: white;">{{ session('success') }}</div>
            @endif

        </div>
@endsection


    <!-- Custom fonts for this template-->
