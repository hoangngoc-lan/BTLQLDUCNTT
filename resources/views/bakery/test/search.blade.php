@extends('bakery.layout.master')

@section('content')
	<div class="container my-3">
		<div class="row">
			<div class="col-md-5 col-lg-4 col-xl-3 col-sm-12 border rounded p-3" style="height: max-content;">
				<form method="POST" action="{{ route('search_store') }}">
					@csrf
					<div class="mb-3" style="display: inline-flex; border-radius: 40px; background-color: none; padding: 2px; border: 1px solid lightgray; width: 100%;">
						<input 
							value="{{ $param['search'] }}" 
							type="text" name="search" style="outline: none; border: none; background-color: transparent; padding: 10px; height: 40px; width: 100%;">
						<button name="submit" class="btn btn-warning" style="border-radius: 40px; height: 40px;">Search</button>
					</div><br>
                    <div class="form-group row">
                        <label for="type" class="col-sm-5 col-form-label">Search by</label>
                        <div class="col-sm-7">
                            <select name="type" id="type" aria-label="Default select example" class="form-control">
								<option value="book_name" selected>Shop name</option>
								<option value="author">name</option>
							</select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="bookstore" class="col-sm-5 col-form-label">Shopstore</label>
                        <div class="col-sm-7">
	                    	<select name="bookstore" id="bookstore" aria-label="Default select example" class="form-control">
								<option value="-1" selected></option>
								@foreach ($productstores as $key => $value)
									<option value="{{ $value['id'] }}">{{ $value['bookstore_name'] }}</option>
								@endforeach
							</select>
						</div>
                    </div>
                    <div class="form-group row">
                        <label for="tags" class="col-sm-5 col-form-label">Tags</label>
                        <div class="col-sm-7">
	                        <select name="tags" id="tags" aria-label="Default select example" class="form-control">
								<option value="" selected></option>
								@foreach ($tags as $key => $value)
									<option value="{{ $value['id'] }}">{{ $value['tag_name'] }}</option>
								@endforeach
							</select>
						</div>
                    </div>
				</form>
			</div>
			<div class="col-md-7 col-lg-8 col-xl-9 col-sm-12">
				<h1 style="width: 100%;" class="border-bottom">
					@if ($param['search'] != '')
						Results for "{{ $param['search'] }}"
					@endif
				</h1>
				<div class="d-flex" style="flex-flow: row wrap;">
					@foreach ($products as $key => $value)
						<div class="col-sm-4 col-md-6 col-lg-3 col-xl-4">
							<a href="{{ route('book_details' , $value['id']) }}" class="single-book__img">
								<img src="{{ asset($value['image']) }}" style="width: 100%;" alt="single book and cd">
								<div class="single-book_download">
									<img src="./bakery/img/svg/download.svg" alt="book image">
								</div>
							</a>
							<h4 class="single-book__title my-1"><a href="{{ route('book_details' , $value['id']) }}">{{ $value['book_name'] }}</a></h4>
							<h6 class="text-secondary my-1">{{ $value['author'] }}</h6>
							<h6 class="text-secondary my-1">{{ $value['bookstore_name'] }}</h6>
							<span class="single-book__price my-1">${{ $value['price'] }}</span>
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
		</div>
	</div>
@endsection

@section('title')
	Category
@endsection

@push ('scripts')
    <script type="text/javascript">
    </script>
@endpush