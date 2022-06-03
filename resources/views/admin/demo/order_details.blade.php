@extends('admin.layout.master')

@section('title')
    Books
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Books</h1>
        <a href="{{ route('admin_order_lists') }}">< Back</a>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" cellspacing="0" style="table-layout: auto; width: auto;">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">Bookstore Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Added at</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Book Name</th>
                                    <th scope="col">Bookstore Name</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Total</th>
                                    <th scope="col">Added at</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                @foreach ($order_details as $value)
                                    <trs>
                                        <th scope="row">{{$value['id']}}</th>
                                        <td><a href="{{ route('book_details' , $value['id']) }}"><img src="{{ asset($value['image']) }}" width="100"></a></td>
                                        <td>{{$value['book_name']}}</td>
                                        <td>{{$value['bookstore_name']}}</td>
                                        <td>${{$value['price']}}</td>
                                        <td>{{$value['quantity']}}</td>
                                        <td>${{$value['quantity'] * $value['price']}}</td>
                                        <td>{{$value['created_at']->toDateString() }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href='{{ Route('admin_order_confirm' , $order_details[0]['id']) }}'
                        class="btn btn-primary @if ($order[0]['status'] == 1) disabled @endif">
                        Confirm
                    </a>
                    <a href='{{ Route('admin_order_disconfirm' , $order_details[0]['id']) }}'
                        class="btn btn-secondary @if ($order[0]['status'] == 0) disabled @endif">
                        Disconfirm
                    </a>
                    <a href='{{ Route('admin_order_delete' , $order_details[0]['id']) }}'
                        class="btn btn-danger @if ($order[0]['status'] == 0) disabled @endif">
                        Cancel
                    </a>
                </div>
            </div>

            @if (session('success'))
                <div class="bg-success rounded" style="color: white;">{{ session('success') }}</div>
            @endif

        </div>
@endsection


    <!-- Custom fonts for this template-->
