<?php

namespace App\Http\Controllers\cart;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Order_details;
use App\Models\Comments;
use App\Models\Productstores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class cart_controller extends Controller
{
    public function cart(Request $request){
        if (!$request->session()->has('cart')) {
            $request->session()->put('cart' , []);
        }

        /*
        echo ('<pre>');
        print_r($request->session()->get('cart'));
        echo ('</pre>');
        */

        /*
        $books = Books::all();
        $arr = [];
        $id = 0;
        foreach ($books as $key => $value) {
        	$bookstore = Bookstores::find($value['bookstore_id']);
        	$arr[] = [
                'id'=>$id ,
                'book_id'=>$value['id'] ,
        		'book_name'=>$value['book_name'] ,
				'author'=>$value['author'] ,
				'image'=>$value['image'] ,	
				'quantity'=>1 ,
				'price'=>$value['price'] ,
				'bookstore_name'=>$bookstore['bookstore_name'] ,
				'books_stock'=>$value['quantity']
        	];
        	$id++;
        }
        $request->session()->put('cart' , $arr);
        */
        
        $cart = $request->session()->get('cart');
        $products = Products::all()->random(4);
        foreach ($products as $key => $value) {
            $comments = Comments::where('book_id' , '=' , $value['id'])->get();
            $stars = 5;
            foreach ($comments as $key2 => $comment) {
                $stars += $comment['rating'];
            }
            $stars = round($stars/(count($comments)+1));
            $products[$key]['stars'] = $stars;
        }

        return view('bakery.test.cart' , compact("cart" , 'products'));
    }
    public function cart_update(Request $request , $id) {
    	$this->validate($request , [
    		'quantity'
    	]);
    	$arr = $request->session()->get('cart');
        Books::where('id' , '=' , $arr[$id]['book_id'])->update([
            'quantity'=>$books[0]['quantity'] + ($arr[$id]['quantity'] - $request->quantity)
        ]);
    	$arr[$id] = [
    		'id'=>$id ,
            'book_id'=>$arr[$id]['book_id'] ,
        	'book_name'=>$arr[$id]['book_name'] ,
			'author'=>$arr[$id]['author'] ,
			'image'=>$arr[$id]['image'] ,	
			'quantity'=>$request->quantity ,
			'price'=>$arr[$id]['price'] ,
			'bookstore_name'=>$arr[$id]['bookstore_name'] ,
			'books_stock'=>$arr[$id]['books_stock']
    	];
    	$request->session()->put('cart' , $arr);
        return redirect()->route('cart')->with('success' , 'Updated successfully');
    }
    public function cart_order(Request $request) {
        $this->validate($request , [
            'name'=>'required' ,
            'phonenumber'=>'required' ,
            'email'=>'required' ,
            'address'=>'required'
        ]);
        $user_details = $request->session()->get('user_details');
        $arr = [
            'user_id'=>$user_details->id ,
            'cus_name'=>$request->name ,
            'address'=>$request->address ,
            'phone'=>$request->phonenumber ,
            'email'=>$request->email ,
            'payment'=>'' ,  
            'status'=>'0'
        ];
        $cart = $request->session()->get('cart');
        $full_price = 0;
        foreach ($cart as $key => $value) {
            $full_price += $value['price'] * $value['quantity'];
        }
        $arr['payment'] = $full_price;

        Orders::create($arr);
        foreach ($cart as $key => $value) {
            Order_details::create([
                'order_id'=>Orders::max('id'),
                'book_id'=>$value['book_id'],
                'quantity'=>$value['quantity'],
                'price'=>$value['price'] * $value['quantity']
            ]);
        }
        $request->session()->put('cart' , []);

        return redirect()->route('cart')->with('success' , 'Bought successfully');
    }
    public function cart_delete(Request $request , $id) {
        $arr = $request->session()->get('cart');
        $book = Books::where('id' , '=' , $arr[$id]['book_id'])->get();
        Books::where('id' , '=' , $arr[$id]['book_id'])->update([
            'quantity'=>$book[0]['quantity'] + $arr[$id]['quantity']
        ]);
        unset($arr[$id]);
        $request->session()->put('cart' , $arr);
        return redirect()->route('cart')->with('success' , 'Deleted successfully');
    }

    public function cart_delete_all (Request $request) {
        $arr = $request->session()->get('cart');
        foreach ($arr as $key => $value) {
            $book = Books::where('id' , '=' , $value['id'])->get();
            Books::where('id' , '=' , $value['book_id'])->update([
                'quantity'=>$book[0]['quantity'] + $value['quantity']
            ]);
        }
        $request->session()->put('cart' , []);
        return redirect()->route('cart')->with('success' , 'Deleted successfully');
    }
}
