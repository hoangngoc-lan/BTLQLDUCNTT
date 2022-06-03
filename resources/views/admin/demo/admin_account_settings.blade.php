@extends('admin.layout.master')

@section('title')
    Account configuration
@endsection

@section('content')
<p id='print'></p>
<div class="container mt-4" style="padding-bottom: 50px; margin-top: 0px;">
    <div class="row">
        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div style="width: 100%" class="p-3 border border-round">
                <img src="{{ asset(session('admin_details')->image) }}" id='pfp' style="width: 100%;" class="pfp rounded-pill border">
                <form action="{{ route('admin_account_update_image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="file" name="image" id='pfp_image' class="my-2">
                    <input type="submit" name="submit" style="width: 100%;" class="btn btn-primary rounded-pill">
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9 col-xl-9">
            <div style="width: 100%" class="p-3 border border-round">
                <form action="{{ route('admin_account_update_details') }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group row">
                        <label for="Level" class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" disabled id="Level" value="{{ session('admin_details')->level }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Name" name="name" value="{{ session('admin_details')->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Username" name="username" value="{{ session('admin_details')->username }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Password" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Password" name="password" value="">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Phonenumber" class="col-sm-2 col-form-label">Phonenumber</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Phonenumber" name="phonenumber" value="{{ session('admin_details')->phonenumber }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control" id="Email" name="email" value="{{ session('admin_details')->email }}">
                        </div>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary rounded-pill">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection


    <!-- Custom fonts for this template-->
