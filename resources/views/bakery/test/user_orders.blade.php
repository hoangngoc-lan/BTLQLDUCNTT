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
	<h1 class="h3 mb-2 text-gray-800">Your orders</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Date sent</th>
                            <th scope="col">Date confirmed</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Date sent</th>
                            <th scope="col">Date confirmed</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($orders as $value)
                            <tr>
                                <th scope="row">{{$value['id']}}</th>
                                <td>{{$value['created_at']->toDateString() }}</td>
                                <td>
                                	@if ($value['status'] == 0) <b class="text-danger">Not confirmed</b>
                                    @else {{$value['updated_at']->toDateString() }}
                                    @endif
                                </td>
                                <td>
                                    @if ($value['status'] == 0) <b class="text-danger">Not confirmed</b>
                                    @else <b class="text-success">Confirmed</b>
                                    @endif
                                </td>
                                <td>
                                    <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#delete{{ $value['id'] }}">Cancel</button>
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
                                                            <a href="{{ Route('user_order_delete', $value['id']) }}" class="btn btn-danger">Cancel</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <a href="{{ Route('user_order_details', $value['id'] ) }}" class="btn btn-primary">Details</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push ('scripts')
@endpush