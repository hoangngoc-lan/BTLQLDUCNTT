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
                    <form action="{{ route('admin_bookstore_store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Bookstore Name</label>
                            <input class="form-control" name="name" placeholder="Please enter bookstore's name" />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Please enter book publisher description"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Add</button>
                    </form>
                </div>
            </div>

            @if ($errors->any())
                @foreach($errors->all() as $message) 
                   <div class="bg-danger rounded" style="padding: 5px; color: white; margin-bottom: 5px;">{{ $message }}</div>
                @endforeach
            @endif

        </div>
        <!-- /.container-fluid -->

            
    <!-- End of Main Content -->
@endsection


    <!-- Custom fonts for this template-->
