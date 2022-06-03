@extends('admin.layout.master')

@section('title')
    Orders Moderation
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Orders{{ $print }}</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Account</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phonenumber</th>
                                    <th scope="col">Email address</th>
                                    <th scope="col">Date sent</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Account</th>
                                    <th scope="col">Customer</th>
                                    <th scope="col">Address</th>
                                    <th scope="col">Phonenumber</th>
                                    <th scope="col">Email address</th>
                                    <th scope="col">Date sent</th>
                                    <th scope="col">Status</th>
                                    <th scope="col"></th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($orders as $value)
                                    <tr>
                                        <th scope="row">{{$value['id']}}</th>
                                        <td>{{$value['username']}}</td>
                                        <td>{{$value['cus_name']}}</td>
                                        <td>{{$value['address']}}</td>
                                        <td>{{$value['phone']}}</td>
                                        <td>{{$value['email']}}</td>
                                        <td>{{$value['created_at']->toDateString() }}</td>
                                        <td>
                                            @if ($value['status'] == 0) <b class="text-danger">Not confirmed</b>
                                            @else <b class="text-success">Confirmed</b>
                                            @endif
                                        </td>
                                        <td>
                                            <ul>
                                                <li><a href="{{ Route('admin_order_confirm', $value->id ) }}">Confirm</a></li>
                                                <li><a href="{{ Route('admin_order_disconfirm', $value->id ) }}">Disconfirm</a></li>
                                                <li><button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete{{ $value['id'] }}">Delete</button></li>
                                                     <div class="modal" id="delete{{ $value['id'] }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Cancel order#{{$value['id']}}?</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <a href="{{ Route('admin_order_delete', $value['id']) }}" class="btn btn-danger">Cancel</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <li><a href="{{ Route('admin_order_details', $value->id ) }}">Details</a></li>
                                            </ul>
                                        </td>
                                    </tr>
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