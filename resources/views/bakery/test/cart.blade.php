

      @extends('bakery.layout.master')
@section('title')
    Category
@endsection

@section('content')
	@if (session('success'))
		<p class="bg-success text-light" style="padding: 10px;">{{ session('success') }}</p>
	@endif
	@if ($errors->any())
        @foreach($errors->all() as $message) 
    	   <div class="bg-danger text-light" style="padding: 5px; color: white; margin-bottom: 5px;">{{ $message }}</div>
        @endforeach
    @endif

	<div class="container padding-bottom-3x mt-3" style="min-height: 600px;">
		<h1 style="font-size: 40px; border-bottom: 1px solid lightgray; width: 100%;">Your cart</h1>
		@if ($cart)
			<div class="table-responsive shopping-cart">
		        <table class="table">
		            <thead>
		                <tr>
		                    <th></th>
		                    <th class="text-center">Quantity</th>
		                    <th class="text-center">Subtotal</th>
		                    <th class="text-center">Price</th>
		                    <th class="text-center"></th>
		                    <th class="text-center"><a class="btn btn-sm btn-outline-danger" href="{{ route('cart_delete_all') }}">Clear Cart</a></th>
		                </tr>
		            </thead>
		            <tbody>
		                @foreach ($cart as $key => $value)
		   				 	<tr>
			                    <td>
			                        <div class="product-item">
			                            <a class="product-thumb" href="{{ route('book_details' , $value['book_id']) }}"><img src="{{ asset($value['image']) }}" alt="Product" style="height: 180px;"></a>
			                            <div class="product-info">
			                                <h4 class="product-title"><a href="#">{{ $value['author'] }}</a></h4><span><h4 class="product-title"><a href="#">{{ $value['bookstore_name'] }}</a></h4></span><span>{{ $value['book_name'] }}</span>
			                            </div>
			                        </div>
			                    </td>
			                    <td class="text-center">
			                        <div class="count-input">
			                            <input type="number" name="amount" oninput="subtotal_function(false)" min="1" max='{{ $value['books_stock'] }}' value="{{ $value['quantity'] }}" class="quantity">
			                        </div>
			                    </td>
			                    <td class="text-center text-lg text-medium subtotal">${{ $value['price'] * $value['quantity'] }}</td>
			                    <td class="text-center text-lg text-medium price">${{ $value['price'] }}</td>
			                    <td>
			                    	<form method="POST" action="{{ route('cart_update' , $value['id']) }}" align='center'>
			                    		@csrf
			                    		<input type="hidden" name="quantity" class="quantity_update">
			                    		<button type="submit" class="btn btn-primary update_btn">Update</button>
			                    	</form>
			                	</td>
			                    <td class="text-center"><a class="remove-from-cart" href="{{ route('cart_delete' , $value['id']) }}" data-toggle="tooltip" title="" data-original-title="Remove item"><i class="fa fa-trash"></i></a></td>
			                </tr>
			            @endforeach
			        </tbody>
			    </table>
			</div>
			<div class="shopping-cart-footer">
			    <div class="column text-lg">Subtotal: <span class="text-medium" id="total_price"></span></div>
			</div>
			<div class="shopping-cart-footer">
			    <div class="column"><a class="btn btn-outline-secondary" href="{{ route('home') }}"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a></div>
				<form action="{{ route('cart_order') }}" method="POST">
                    @csrf
                    <div class="column">
                    	<button type="button" class="btn btn-success" id="checkout_btn" type="button" data-toggle="modal" data-target="#buy_now">Checkout</button>

                    	<!-- Popup -->
                    	<div class="modal" id="buy_now" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <form method="POST" action="{{ route('cart_order') }}">
                                        @csrf
                                        <div class="modal-body">
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
                </form>
			</div>
		@else
			<div align="center" style="height: 400px;">
				<h1 style="padding: 20px; font-size: 60px;">Nothing in the cart</h1>
				<a style="" href="{{ route('home') }}" align="center">Return to home</a><br>
				<a style="" href="{{ route('user_orders') }}" align="center">Check orders</a>
			</div>
		@endif

		<h3 style="margin-left: auto; width: 100%;">Suggestions</h3>
		<div class="products">
			@foreach ($products as $key => $value)
				<div class="single-book">
					<a href="{{ route('book_details' , $value['id']) }}" class="single-book__img">
						<img src="{{ asset($value['image']) }}" style="width: 241px;" alt="single book and cd">
						<div class="single-book_download">
							<img src="./bakery/img/svg/download.svg" alt="book image">
						</div>
					</a>
					<h4 class="single-book__title">{{ $value['book_name'] }}</h4>
					<span class="single-book__price">${{ $value['price'] }}</span>
					<!-- star rating -->
					<div class="rating">
						@for ($i=0 ; $i < 5-$value['stars'] ; $i++)
							<span>&#9734;</span>
						@endfor
						@for ($i=0 ; $i < $value['stars'] ; $i++)
							<span>&#9733;</span>
						@endfor
					</div>
					<!-- star rating end -->
				</div>
			@endforeach
		</div>
	</div>
	<br>
@endsection

@push ('scripts')
	<script type="text/javascript">
		var price = document.getElementsByClassName('price');
		var quantity = document.getElementsByClassName('quantity');
		var subtotal = document.getElementsByClassName('subtotal');
		var quantity_update = document.getElementsByClassName('quantity_update');
		var update_btn = document.getElementsByClassName('update_btn');
		var total_price = document.getElementById('total_price');
		var checkout_btn = document.getElementById('checkout_btn');

		function subtotal_function(update) {
			var n = 0;
			for (var i=0 ; i<subtotal.length; i++) {
				if (quantity[i].value > parseInt(quantity[i].max)) {
					quantity[i].value = parseInt(quantity[i].max);
				}
				else if (quantity[i].value < 1) {
					quantity[i].value = 1;
				}
				if (quantity[i].value == "") {
					quantity[i].value = 1;
				}
				subtotal[i].innerHTML = '$' + (quantity[i].value * parseInt(price[i].innerHTML.substring(1))).toString();
				quantity_update[i].value = quantity[i].value;
				n += quantity[i].value * parseInt(price[i].innerHTML.substring(1));

				update_btn[i].disabled = update;
			}
			total_price.innerHTML = '$' + n.toString();
			checkout_btn.disabled = -1+update;
		}

		subtotal_function(true);
	</script>
@endpush