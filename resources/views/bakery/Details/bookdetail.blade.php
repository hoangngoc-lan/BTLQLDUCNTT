@extends('bakery.layout.master')
@section('title')
    Detail
@endsection


@section('content')
<div class="container-fuild" style="padding-bottom: 50px; margin-top: 0px;">
    <div class="mt-5 px-5">
        @foreach ($products as $key => $value)
            <div class="row pb-4 border-bottom">
                <div class="col-md-4">
                    <img src="{{ asset($value['image']) }}" style="width: 100%; height: auto;">
                </div>
                <div class="col-md-5">
                    <h1>{{ $value['book_name'] }}</h1>
                    <span>{{ $value['author'] }}</span>
                    <p style="margin-bottom: 0px;">{{ $value['bookstore_name'] }}</p>
                    <p style="font-size: 30px;" class="border-bottom">
                        @for ($i=0 ; $i < $value['stars'] ; $i++)
                            <span style="color: #FD4;">&#9733;</span>
                        @endfor
                        @for ($i=0 ; $i < 5-$value['stars'] ; $i++)
                            <span style="color: #FD4;">&#9734;</span>
                        @endfor
                    </p>
                    <p>{{ $value['description'] }}</p>
                    <p class="mb-0">Tags:</p>
                    <ul>
                        @foreach ($products_tags as $key => $tags)
                            <li style="margin-left: 20px;">-{{ $tags['tag_name'] }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-3">
                    <div class="p-3" style="border: 6px solid lightgray; border-radius: 10px;">
                        <form method="POST" action="{{ route('add_cart' , $value['id']) }}">
                            @csrf
                            <h4 style="width: 100%;" class="mb-0">
                                <span>Price :</span>
                                <span style="float: right; color: orange">${{ $value['price'] }}</span>
                            </h4>
                            <div style="width: 100%;" class="border-bottom">
                                <span>In stock :</span>
                                <span style="float: right;">{{ $value['quantity'] }}</span>
                            </div>
                            <div class="form-group">
                                <label for="quantity" class="mb-0">Amount</label>
                                <select class="form-control mb-2" id="quantity" name="quantity">
                                    @for ($i = 1 ; $i <= $value['quantity'] ; $i++)
                                        <option>{{ $i }}</option>
                                    @endfor
                                </select>
                                @if (session('user_details')) 
                                    <button class="btn rounded-pill btn-warning mb-2" type="submit" style="width: 100%;">Add to cart</button>
                                @else
                                    <a class="btn rounded-pill btn-warning mb-2" href="{{ route('login') }}" style="width: 100%;">Add to cart</a>
                                @endif
                                <button class="btn rounded-pill btn-warning" type="button" style="width: 100%;" data-toggle="modal" data-target="#buy_now">Buy now</button>
                            </div>
                        </form>

                        <div class="modal" id="buy_now" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('order_now' , $value['id']) }}">
                                        @csrf
                                        <div class="modal-body">
                                            @if (session('user_details'))
                                                <div class="form-group">
                                                    <label for="order_name">Full name</label>
                                                    <input type="text" name="name" class="form-control" id="order_name" placeholder="John M. Doe" value="{{ session('user_details')->name }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="form_address">Address</label>
                                                    <input type="text" name="address" class="form-control" id="form_address" placeholder="542 W. 15th Street" value="{{ session('user_details')->address }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="form_email">Email address</label>
                                                    <input type="email" name="email" class="form-control" id="form_email" placeholder="johndoe@example.com" value="{{ session('user_details')->email }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="form_phone">Phonenumber</label>
                                                    <input type="text" name="phonenumber" class="form-control" id="form_phone" placeholder="" value="{{ session('user_details')->phone }}">
                                                </div>
                                            @else
                                                <div class="form-group">
                                                    <label for="order_name">Full name</label>
                                                    <input type="text" name="name" class="form-control" id="order_name" placeholder="John M. Doe">
                                                </div>
                                                <div class="form-group">
                                                    <label for="form_address">Address</label>
                                                    <input type="text" name="address" class="form-control" id="form_address" placeholder="542 W. 15th Street">
                                                </div>
                                                <div class="form-group">
                                                    <label for="form_email">Email address</label>
                                                    <input type="email" name="email" class="form-control" id="form_email" placeholder="johndoe@example.com">
                                                </div>
                                                <div class="form-group">
                                                    <label for="form_phone">Phonenumber</label>
                                                    <input type="text" name="phonenumber" class="form-control" id="form_phone" placeholder="">
                                                </div>
                                            @endif
                                            <div class="form-group">
                                                <label for="form_amount">Amount</label>
                                                <select class="form-control" id="form_amount" name="amount">
                                                    @for ($i = 1 ; $i <= $value['quantity'] ; $i++)
                                                        <option>{{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="form-check">
                                                <input name="send_message" type="checkbox" class="form-input" id="send_message">
                                                <label for="send_message">Send me a message when the pakage arrives</label>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger my-0" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-success my-0">Order</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="row pt-2"style="margin-left: 50px; margin-right: 50px;">
            <div class="col-md-7"> 
                <p style="font-size:28px;">Comments</p>
                @foreach ($comments as $key => $value)
                    <div class="row mt-4" style="margin-top: 10px; width: 100%;">
                        <div class="comment text-justify" style="width: 100%;">
                            <div style="width: 40px">
                                <img src="{{ asset($value['image']) }}" class="pfp rounded-pill">
                            </div>
                            <h6>{{ $value['username'] }}</h6> <span>- {{ $value['date'] }}</span>
                            <span>
                                @for ($i=0 ; $i < $value['stars'] ; $i++)
                                    <span style="color: #FD4;">&#9733;</span>
                                @endfor
                                @for ($i=0 ; $i < 5-$value['stars'] ; $i++)
                                <span style="color: #FD4;">&#9734;</span>
                                @endfor
                            </span>
                            <p style="margin-top: 5px; font-size: 20px; color: black;">{{ $value['comment'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-md-5">
                @if (session('user_details'))
                    <form id="algin-form" method="POST" action="{{ route('details_create_comment' , $products[0]['id']) }}">
                        @csrf
                        <div class="d-flex">
                            <div style="width: 40px">
                                <img src="{{ asset(session('user_details')->image) }}" class="pfp rounded-pill">
                            </div>
                            <h3 class="mt-1 ml-2">{{ session('user_details')->username }}</h3>
                        </div>
                        <div class="form-group">
                            <h4>Leave a comment</h4>
                            <div class="stars">
                                <input class="star star-5" id="star-5-2" type="radio" name="star" value="5" />
                                <label class="star star-5" for="star-5-2"></label>
                                <input class="star star-4" id="star-4-2" type="radio" name="star" value="4"/>
                                <label class="star star-4" for="star-4-2"></label>
                                <input class="star star-3" id="star-3-2" type="radio" name="star" value="3"/>
                                <label class="star star-3" for="star-3-2"></label>
                                <input class="star star-2" id="star-2-2" type="radio" name="star" value="2"/>
                                <label class="star star-2" for="star-2-2"></label>
                                <input class="star star-1" id="star-1-2" type="radio" name="star" value="1"/>
                                <label class="star star-1" for="star-1-2"></label>
                            </div><br>
                            <label for="message">Message</label>
                            <textarea name="comment" id="" msg cols="30" rows="5" class="form-control" style=""></textarea>
                        </div>
                        <div class="form-group">
                            <p class="text-secondary">
                            </p>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="post" class="btn btn-warning">Post Comment</button>
                        </div>
                    </form>
                @else
                    <form id="algin-form">
                        @csrf
                        <div class="form-group">
                            <h4>Leave a comment</h4>
                            <a href="{{ route('login') }}">Please login to leave a comment</a><br>
                            <div class="stars">
                                <input class="star star-5" id="star-5-2" type="radio" name="star" value="5" disabled/>
                                <label class="star star-5" for="star-5-2"></label>
                                <input class="star star-4" id="star-4-2" type="radio" name="star" value="4" disabled/>
                                <label class="star star-4" for="star-4-2"></label>
                                <input class="star star-3" id="star-3-2" type="radio" name="star" value="3" disabled/>
                                <label class="star star-3" for="star-3-2"></label>
                                <input class="star star-2" id="star-2-2" type="radio" name="star" value="2" disabled/>
                                <label class="star star-2" for="star-2-2"></label>
                                <input class="star star-1" id="star-1-2" type="radio" name="star" value="1" disabled/>
                                <label class="star star-1" for="star-1-2"></label>
                            </div><br>
                            <label for="message">Message</label>
                            <textarea name="comment" id="" msg cols="30" rows="5" class="form-control" style="" disabled></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" id="post" class="btn btn-warning" disabled>Post Comment</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push ('styles')
<style type="text/css">
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

    .comment h6,
    .comment span,
    .darker h6,
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

/*  
* Rating styles
*/
div.stars{
  width: auto;
  display: inline-block;
}

input.star{
  display: none;
}

label.star {
  float: right;
  padding: 2px;
  font-size: 30px;
  color: #444;
  margin-bottom: 0px;
}

input.star:checked ~ label.star:before {
  content:'★';
  color: #FD4;
}

label.star:hover ~ label.star:before {
  content:'★';
  color: #FD4;
}

label.star:hover:before {
  content:'★';
  color: #FD4;
  cursor: pointer;
}

label.star:before{
  content:'☆';
  color: #FD4;
  font-family: FontAwesome;
}
</style>
@endpush