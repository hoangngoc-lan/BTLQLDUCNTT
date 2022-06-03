@extends('admin.layout.master')

@section('title')
    Category
@endsection

@section('content')
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Tags</h1>
        <a href="{{ route('admin_tag_lists') }}">< Back</a>
            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin_tag_update' , $tag[0]['id']) }}" method="POST">
                        @csrf
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label>Tag name</label>
                            <input class="form-control" name="tag_name" placeholder="Please enter book's name" value="{{ $tag[0]['tag_name'] }}" />
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