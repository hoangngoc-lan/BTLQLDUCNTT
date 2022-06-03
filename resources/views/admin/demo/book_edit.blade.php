@extends('admin.layout.master')

@section('title')
    Category
@endsection

@section('content')
<div class="container-fuild" style="padding-bottom: 50px; margin-top: 0px;">
            @if ($errors->any())
                @foreach($errors->all() as $message) 
                   <div class="bg-danger rounded" style="padding: 5px; color: white; margin-bottom: 5px;">{{ $message }}</div>
                @endforeach
            @endif
    <div class="mt-5 px-5">
        @foreach ($products as $key => $value)
            <form method="POST" enctype="multitype/form-data" action="{{ route('admin_book_update' , $value['id']) }}">
                @csrf
                {{ method_field('PUT') }}
                <div class="row pb-4">
                    <div class="col-md-4" align="center">
                        <label for="book_cover"><img src="{{ asset($value['image']) }}" style="width: 100%; height: auto; cursor: pointer;"></label>
                        <!--
                        <input type="file" name="image" id='book_cover' style="">
                        <h6 class="text-secondary">Import cover image</h6>
                        -->
                    </div>
                    <div class="col-md-8 col-xl-5">
                        <label for="book_name">Book title :</label>
                        <input type="text" name="book_name" id="book_name" value="{{ $value['book_name'] }}" class="form-control" placeholder="Book title">
                        <label for="author">Author :</label>
                        <input type="text" name="author" id="author" value="{{ $value['author'] }}" class="form-control" placeholder="Author">
                        <label for="productstore">Productstore :</label>
                        <select class="form-control" name="bookstore_id" id="productstore">
                            @foreach ($productstores as $key => $productstore)
                                <option value="{{ $productstore['id'] }}">{{ $productstore['bookstore_name'] }}</option>
                            @endforeach
                        </select>
                        <label for="description">Description :</label>
                        <textarea class="form-control" name="description" id="description">{{ $value['description'] }}</textarea>
                        <label for="extra_tags">Tags:<a href="#/" onclick="add_tag()"><i class="fas fa-plus"></i></a></label>
                        <div id="extra_tags">
                            <select class="form-control" name="tags[0]" id="tags">
                                <option value="-1" selected></option>
                                @foreach ($tags as $key => $tag)
                                    <option value="{{ $tag['id'] }}">{{ $tag['tag_name'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-12 col-lg-12 col-xl-3 mt-md-2">
                        <div class="p-3" style="border: 6px solid lightgray; border-radius: 10px;">
                            <div style="width: 100%;" class="form-group row mx-0">
                                <label for='price' class="col-sm-6 col-form-label">Price :</label>
                                <div class="col-sm-6">
                                    <input type="number" min='1' value="{{ $value['price'] }}" class="form-control" id="price" name="price">
                                </div>
                            </div>
                            <div style="width: 100%;" class="form-group row pb-4 border-bottom mx-0">
                                <label for="quantity" class="col-sm-6 col-form-label">In stock :</label>
                                <div class="col-sm-6">
                                    <input type="number" min='0' value="{{ $value['quantity'] }}" class="form-control" id="quantity" name="quantity">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="amount" class="mb-0">Amount</label>
                                <input type="number" class="form-control mb-2" id="amount" disabled>
                                <button class="btn rounded-pill btn-warning mb-2" type="button" style="width: 100%;" disabled>Add to cart</button>
                                <button class="btn rounded-pill btn-warning" type="button" style="width: 100%;" disabled>Buy now</button>
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        @endforeach
    </div>
</div>
@endsection

@push ('scripts')
    <script type="text/javascript">
        var tags = document.getElementById('extra_tags');
        var total = document.getElementById('total');
        var cur_tag = 1;

        function add_tag () {
            if (cur_tag < 5) {
                tags.innerHTML += "<br><select class='form-control' name='tags[" + cur_tag + "]' id='tags'><option value='-1' selected></option>@foreach ($tags as $key => $value)<option value='{{ $value['id'] }}'>{{ $value['tag_name'] }}</option>@endforeach</select>";
                cur_tag += 1;
                total.innerHTML = parseInt(cur_tag) + "/5";
            }
        }
    </script>
@endpush