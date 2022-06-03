@extends('admin.layout.master')

@section('title')
    Category
@endsection

@section('content')
	<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">Edit</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <form action="{{ route('admin_user_update' , $user->id) }}" method="POST">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label>Name</label>
                            <input class="form-control" name="name" placeholder="Please Enter Name" value="{{ $user['name'] }}" />
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" type="email" value="{{ $user->email }}" placeholder="Please Enter Email" readonly/>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input class="form-control" name="password" type="password" placeholder="Please Enter Password"/>
                        </div>
                        <div class="form-group">
                            <label>Confirm</label>
                            <input class="form-control" name="confirm" type="password" placeholder="Please Confirm Password" />
                        </div>
                        <div class="form-group">
                            <label>Role : </label>
                            <label class="radio-inline">
                                <input name="is_admin" value="0" checked type="radio"> User
                            </label>
                            <label class="radio-inline">
                                <input name="is_admin" value="1" type="radio"> Admin
                            </label>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit</button>
                    </form>
                </div>
            </div>

            @if ($errors->any())
                @foreach($errors->all() as $message) 
                   <div class="bg-danger rounded" style="padding: 5px; color: white; margin-bottom: 5px;">{{ $message }}</div>
                @endforeach
            @elseif (session('success')) 
                <div class="bg-success rounded" style="padding: 5px; color: white; margin-bottom: 5px;">{{ session('success') }}</div>
            @endif

        </div>
        <!-- /.container-fluid -->

            
    <!-- End of Main Content -->
@endsection


    <!-- Custom fonts for this template-->
