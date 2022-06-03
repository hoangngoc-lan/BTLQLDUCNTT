@extends('admin.layout.master')

@section('title')
    Category
@endsection

@section('content')
	<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Bookstore</h1>
        <a href="{{ route('admin_bookstore_lists') }}">< Back</a>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin_bookstore_update' , $productstore[0]['id']) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label>Bookstore name</label>
                            <input class="form-control" name="bookstore_name" placeholder="Please enter book's name" value="{{ $productstore[0]['bookstore_name'] }}" />
                        </div>
                        <div class="form-group">
                            <label>Description</label>
                            <textarea class="form-control" name="information" rows="3" placeholder="Please enter book description">{{ $productstore[0]['information'] }}</textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
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

@push ('scripts')
    <script type="text/javascript">
    </script>
@endpush