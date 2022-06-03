<?php

namespace App\Http\Controllers\search;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Tags;
use App\Models\Products_tags;
use App\Models\Comments;
use App\Models\Order_details;
use App\Models\Productstores;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class search_controller extends Controller
{
	public function search_view (Request $request) {
		$param = [
			'search'=>$request->search ,
			'productstore'=>$request->productstore ,
			'tags'=>$request->tags ,
			'type'=>$request->type
		];
		if ($param['type'] == '') $param['type'] = 'book_name';

		$delimeter = ' ';
		$keywords = explode($delimeter, $param['search']);

		$condition = [];
		foreach ($keywords as $keyword) {
			$condition[] = [ $param['type'] , 'like' , '%' .$keyword .'%' ];
		}

		if (($param['productstore'] != '-1') and ($param['productstore'] != '')) $condition[] = [ 'bookstore_id' , '=' , $param['bookstore'] ];

		$condition_or = [];
		if ($param['tags'] != '') {
			$products_tags = DB::table('products_tags');
			$products_tags->orWhere('tag_id' , '=' , $param['tags']);
			foreach ($products_tags->get() as $key => $value) {
				$condition_or[] = ['id' , '=' , $value->book_id];
			}
		}
		$products = Products::query();
		foreach ($condition as $value) {
			$products = $products->where($value[0] , $value[1] , $value[2]);
		}
		$products = $products->where(function ($query) use ($condition_or) {
				foreach ($condition_or as $value) {
					$query->orWhere($value[0] , $value[1] , $value[2]);
				}
			}
		);
		/*
		foreach ($condition_or as $key => $value) {
			$books = $books->orWhere($value[0] , $value[1] , $value[2]);
		}
		*/
		$products = $products->get();

		foreach ($products as $key => $value) {
			$productstores = Productstores::where("id" , "=" , $value['bookstore_id'])->get();
			$value['bookstore_name'] = $productstores[0]['bookstore_name'];
			$comments = Comments::where('book_id' , '=' , $value['id'])->get();
			$stars = 5;
			foreach ($comments as $key2 => $comment) {
				$stars += $comment['rating'];
			}
			$stars = round($stars/(count($comments)+1));
			$products[$key]['stars'] = $stars;
		}

		$productstores = Productstores::all();
		$tags = Tags::all();

		return view('bakery.test.search' , compact('products' , 'tags' , 'productstores' , 'param'));
	}

	public function search_store (Request $request) {
		$this->validate($request , [
			'search' ,
			'productstore' ,
			'tags' ,
			'type'
		]);

		$return = [
			'search'=>$request->search ,
			'bookstore'=>$request->bookstore ,
			'tags'=>$request->tags ,
			'type'=>$request->type
		];

		return redirect()->route('search_view' , $return);
	}
}