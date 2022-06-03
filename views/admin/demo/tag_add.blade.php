@extends('admin.layout.master')

@section('title')
    Category
@endsection

@section('content')
	<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tags</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin_tag_store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Tag Name</label>
                            <input class="form-control" name="tag_name" placeholder="Please enter bookstore's name" />
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
