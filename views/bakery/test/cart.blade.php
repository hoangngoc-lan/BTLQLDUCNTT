

      @extends('bakery.layout.master')
@section('title')
    Category
@endsection

@section('content')
	<br><br><br><br><br><br><br>

	@if (session('success'))
		<p class="bg-success rounded" style="padding: 10px;">{{ session('success') }}</p>
	@endif
	@if ($errors->any())
        @foreach($errors->all() as $message) 
    	   <div class="bg-danger rounded" style="padding: 5px; color: white; margin-bottom: 5px;">{{ $message }}</div>
        @endforeach
    @endif

	<div class="container padding-bottom-3x mb-1" style="min-height: 600px;">
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
		                    <th class="text-center"><a class="btn btn-sm btn-outline-danger" href="#">Clear Cart</a></th>
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
			    <div class="column"><a class="btn btn-outline-secondary" href="#"><i class="icon-arrow-left"></i>&nbsp;Back to Shopping</a></div>
				<form action="{{ route('cart_order') }}" method="POST">
                    @csrf
                    <div class="column">
                    	<button type="submit" class="btn btn-success" id="checkout_btn">Checkout</button>
                    </div>
                </form>
			</div>
		@else
			<h1 style="width: 100%; padding: 20px; font-size: 60px;" align="center">Sorry, nothing in the cart</h1>
		@endif
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