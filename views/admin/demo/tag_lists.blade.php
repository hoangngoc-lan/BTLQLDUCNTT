@extends('admin.layout.master')

@section('title')
    Bookstore
@endsection

@section('content')
	<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tags</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
									<th scope="col">Id</th>
									<th scope="col">Tag name</th>
									<th scope="col">Created at</th>
									<th scope="col">Last update</th>
									<th colspan="2"></th>
								</tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Tag name</th>
                                    <th scope="col">Created at</th>
                                    <th scope="col">Last update</th>
                                    <th colspan="2"></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($tags as $value)
									<tr class="tag">
										<th scope="row">{{$value['id']}}</th>
										<td>{{$value['tag_name']}}</td>
										<td>{{$value['created_at']->toDateString() }}</td>
										<td>{{$value['updated_at']->toDateString() }}</td>
										<td><button class="btn btn-success"><a href="{{ /*Route('admin_user_edit', $value->id ))*/ "a" }}"><i class="fas fa-user-edit"></i></a></button></td>
										<td><button class="btn btn-danger"><a href="{{ Route('admin_tag_delete', $value->id ) }}"><i class="fas fa-user-times"></i></a></button></td>
									</tr>
								@endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href='{{ Route('admin_tag_add') }}' class="btn btn-primary">Add tags</a>
                </div>
            </div>

            @if (session('success'))
            	<div class="bg-success rounded" style="color: white;">{{ session('success') }}</div>
            @endif

        </div>
@endsection


    <!-- Custom fonts for this template-->
