@extends('bakery.layout.master')
@section('title')
    Detail
@endsection


@section('content')
<p id='print'></p>
<div class="container mt-4" style="padding-bottom: 50px; margin-top: 0px;">
    <div class="row">
        <div class="col-sm-12 col-md-3 col-lg-3 col-xl-3">
            <div style="width: 100%" class="p-3 border border-round">
                <img src="{{ asset(session('user_details')->image) }}" class="pfp rounded-pill border">
                <form action="{{ route('user_update_image') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <input type="file" name="image" id='pfp_image' class="my-2">
                    <input type="submit" name="submit" style="width: 100%;" class="btn btn-primary rounded-pill">
                </form>
            </div>
        </div>
        <div class="col-sm-12 col-md-9 col-lg-9 col-xl-9">
            <div style="width: 100%" class="p-3 border border-round">
                <form action="{{ route('user_update_details') }}" method="POST">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="form-group row">
                        <label for="Name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" name="name" class="form-control" id="Name" value="{{ session('user_details')->name }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Username" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" name="username" class="form-control" id="Username" value="{{ session('user_details')->username }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Address" class="col-sm-2 col-form-label">Address</label>
                        <div class="col-sm-10">
                            <input type="text" name="address" class="form-control" id="Address" value="{{ session('user_details')->address }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Phonenumber" class="col-sm-2 col-form-label">Phonenumber</label>
                        <div class="col-sm-10">
                            <input type="text" name="phone" class="form-control" id="Phonenumber" value="{{ session('user_details')->phone }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="Email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" name="email" class="form-control" id="Email" value="{{ session('user_details')->email }}">
                        </div>
                    </div>
                    <input type="submit" name="submit" class="btn btn-primary rounded-pill">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push ('styles')
@endpush

@push ('scripts')
@endpush