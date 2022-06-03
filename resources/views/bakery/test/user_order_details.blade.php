@extends('bakery.layout.master')
@section('title')
    Category
@endsection

@section('content')
@if (session('success'))
    <div class="bg-success p-2" style="color: white;">{{ session('success') }}</div>
@endif
<div class="container-fluid" style="min-height: 500px;">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Order#{{ $order[0]['id'] }} details</h1>
    <!-- DataTales Example -->
    <a href="{{ route('user_orders') }}">< Back</a>
            <!-- DataTales Example -->
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                <a href='{{ Route('user_order_delete' , $order_details[0]['id']) }}' class="btn btn-danger">Cancel</a>
            </div>
        </div>
    </div>
</div>
@endsection

@push ('scripts')
@endpush