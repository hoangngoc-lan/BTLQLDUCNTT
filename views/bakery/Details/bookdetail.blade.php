@extends('bakery.layout.master')
@section('title')
    Detail
@endsection


@section('content')
<div class="container-fuild" style="padding-bottom: 50px; margin-top: 0px; background-color:#CED8F6">
    <div class="container ">
        <div class="row mt-5"  style="height:auto; background-color:white; margin-top:100px; border-radius:10px;" >
            <br><br><br>
            <div class="row" style="height:40%">
                @foreach ($books as $key => $value)
                    <div class="col-md-4 product" style="margin-left: 50px;">
                        <img src="{{ asset($value['image']) }}" style="width: 400px;">
                    </div>
                    <div class="col-md-6 infor">
                        <h1>{{ $value['book_name'] }}</h1>
                        <p style="font-family:Times New Roman;">{{ $value['bookstore_name'] }}</p>
                        <br>
                        <p>
                            @for ($i=0 ; $i < $value['stars'] ; $i++)
                                <span>&#9733;</span>
                            @endfor
                            @for ($i=0 ; $i < 5-$value['stars'] ; $i++)
                                <span>&#9734;</span>
                            @endfor
                        </p>
                        <br>
                        <p style="font-family:Times New Roman;">{{ $value['description'] }}</p>
                        <br><br>
                        <div class="row">
                            <div class="col-md-12 col-sm-6">
                                <div class="card" style="margin: 0px; border-radius: 20px; border: 1px solid lightgray; width: 300px;">
                                    <div class="card-top" style="background-color: lightgray; padding: 15px; border-bottom: 1px solid gray; border-radius: 20px 20px 0px 0px;">${{ $value['price'] }}</div>
                                    <div class="card-body" style="padding:35px;">
                                        <form method="POST" action="{{ route('add_cart' , $value['id']) }}">
                                            @csrf
                                            <section class="buy" ><br><input type="number" name="quantity" min="1" max="{{ $value['quantity'] }}" value="1" style="width: 75%;"></section>
                                            <button type="submit" class="btn btn-primary" style="margin-left:80px;height:40px;margin-top:-45px;">Add To  Cart</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <br><br>
                            <p>
                                Tags:
                                <ul style="font-family:Times New Roman;">
                                    @foreach ($book_tags as $key => $value)
                                        <li style="margin-left: 20px;">-{{ $value['tag_name'] }}</li>
                                    @endforeach
                                </ul>
                            </p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="row">
                <div class="col-md-5" style="margin-left:50px;">
                </div>
                <!--
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-10">
                            <p style="font-size:28px;">About The Author</p>
                            <br>
                            <p style="font-size:20px;">Saifudin A.</p>
                            <p>
                                How to Build a Successful Blog Business is a straight forward guide to building a publishing business online that covers everything from choosing a niche to hiring staff, registering a business to selling it.<br>
                                Finding traffic to monetizing it whether you are interested in creating an additional income stream or building a fully-fledged business, this is an essential read for web entrepreneurs and online publishers.
                            </p>
                        </div>
                        <div class="col-md-2">
                            <img src="/bakery/img/product/actor.jpg" style="border-radius: 50%;">
                        </div>
                    </div>
                </div>
                -->
                <div class="col-md-1"></div>
            </div>
            <br>
            <div class="row "style="margin-left: 50px; margin-right: 50px;">
                <p style="font-size:28px;">Comments</p>

                <div class="col-md-7"> 
                    @foreach ($comments as $key => $value)
                        <div class="row mt-4" style="margin-top: 10px; width: 100%;">
                            <div class="comment text-justify">
                                <img src="{{ asset($value['image']) }}" alt="" class="rounded-circle" width="40" height="40">
                                <h4>{{ $value['name'] }}</h4> <span>- {{ $value['date'] }}</span>
                                <span>
                                    @for ($i=0 ; $i < 5-$value['stars'] ; $i++)
                                        <span>&#9733;</span>
                                    @endfor
                                    @for ($i=0 ; $i < $value['stars'] ; $i++)
                                        <span>&#9734;</span>
                                    @endfor
                                </span><br>
                                <p style="margin-top: 5px; font-size: 20px; color: black;">{{ $value['comment'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="col-md-5">
                    <form id="algin-form">
                        <div class="form-group">
                            <h4>Leave a comment</h4> <label for="message">Message</label> <textarea name="msg" id="" msg cols="30" rows="5" class="form-control" style=""></textarea>
                        </div>
                        <div class="form-group">
                            <p class="text-secondary">
                                
                            </p>
                        </div>
                        <div class="form-group"> <button type="button" id="post" class="btn">Post Comment</button> </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@push ('styles')
<style type="text/css">
    .navbar-nav {
        width: 100%
    }

    @media(min-width:568px) {
        .end {
            margin-left: auto
        }
    }

    @media(max-width:768px) {
        #post {
            width: 100%
        }
    }

    #profile {
        background-color: unset
    }

    #post {
        margin: 10px;
        padding: 6px;
        padding-top: 2px;
        padding-bottom: 2px;
        text-align: center;
        background-color: #ecb21f;
        border-color: #a88734 #9c7e31 #846a29;
        color: black;
        border-width: 1px;
        border-style: solid;
        border-radius: 13px;
        width: 50%
    }

    #nav-items li a,
    #profile {
        text-decoration: none;
        color: rgb(224, 219, 219);
        background-color: black
    }

    .comments {
        margin-top: 5%;
        margin-left: 20px
    }

    .darker {
        border: 1px solid gray;
        background-color: lightgray;
        float: right;
        border-radius: 5px;
        padding-left: 40px;
        padding-right: 30px;
        padding-top: 10px
    }

    .comment {
        border: 1px solid lightgray;
        background-color: white;
        border-radius: 5px;
        padding-left: 40px;
        padding-right: 30px;
        padding-top: 10px;
    }

    .comment h4,
    .comment span,
    .darker h4,
    .darker span {
        display: inline
    }

    .comment p,
    .comment span,
    .darker p,
    .darker span {
        color: rgb(184, 183, 183)
    }

    #align-form {
        margin-top: 20px
    }

    .form-group p a {
        color: white
    }

    #darker img {
        margin-right: 15px;
        position: static
    }

    .form-group input,
    .form-group textarea {
        border: 1px solid lightgray;
        border-radius: 12px
    }

    .rounded {
      border-radius: 0.35rem !important;
    }
</style>
@endpush