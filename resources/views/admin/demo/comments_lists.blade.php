@extends('admin.layout.master')

@section('title')
    Category
@endsection

@section('content')
	<div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-2 text-gray-800">{{ $print }}</h1>

            <!-- DataTales Example -->
            @foreach ($comments as $key => $value)
                <div class="card shadow mb-4 p-3">
                    <div class="" style="width: 100%;">
                        <div style="width: 40px">
                            <img src="{{ asset($value['image']) }}" class="pfp rounded-pill">
                        </div>
                        <h6>{{ $value['username'] }}</h6>
                        <span>-{{ $value['date'] }}</span>
                        <span>
                            -From book <a href="{{ route('book_details' , $value['id']) }}">#{{ $value['book_id'] }}-{{ $value['book_name'] }}</a>
                        </span>
                        <span>
                            @for ($i=0 ; $i < $value['rating'] ; $i++)
                                <span style="color: #FD4;">&#9733;</span>
                            @endfor
                            @for ($i=0 ; $i < 5-$value['rating'] ; $i++)
                                <span style="color: #FD4;">&#9734;</span>
                            @endfor
                        </span>
                        <p style="margin-top: 5px; font-size: 20px; color: black;">{{ $value['comment'] }}</p>
                    </div>
                </div>
            @endforeach

            @if (session('success'))
            	<div class="bg-success rounded" style="color: white;">{{ session('success') }}</div>
            @endif

        </div>
@endsection


    <!-- Custom fonts for this template-->
