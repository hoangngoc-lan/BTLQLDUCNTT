<?php

namespace App\Http\Controllers\bakery;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Products;
use App\Models\Orders;
use App\Models\Order_details;
use App\Models\Products_tags;
use App\Models\Tags;
use App\Models\Comments;
use App\Models\Productstores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DetailsController extends Controller
{
    public function details(Request $request, $id){
        $products = Products::where('id' , '=' , $id)->get();

        $stars = 5;
        $products_tags = [];
        foreach ($products as $key => $value) {
        	$productstores = Productstores::where("id" , "=" , $value['bookstore_id'])->get();
    		$products[$key]['bookstore_name'] = $productstores[0]['bookstore_name'];
            $arr = Products_tags::where('book_id' , '=' , $value['id'])->get();
            foreach ($arr as $key => $tag) {
                $tag_arr = Tags::where('id' , '=' , $tag['tag_id'])->get();
                $products_tags[] = [
                    'id'=>$tag['id'] , 
                    'tag_name'=>$tag_arr[0]['tag_name']
                ];
            }
        }

    	$comments_arr = Comments::where('book_id' , '=' , $products[0]['id'])->get();
        $stars = 5;
        $comments = [];
        foreach ($comments_arr as $key => $comment) {
            $stars += $comment['rating'];
        }
        $stars = round($stars/(count($comments_arr)+1));
        $products[0]['stars'] = $stars;

        foreach ($comments_arr as $key => $value) {
        	$users = Users::where('id' , '=' , $value['user_id'])->get();
        	foreach ($users as $user_key => $user) {
        		$comments[] = [
        			'name' => $user['name'] ,
                    'username' => $user['username'] ,
        			'image' => $user['image'] ,
        			'comment' => $value['comment'] ,
        			'stars' => $value['rating'] ,
        			'date' => $value['created_at']
        		];
        	}
        }

        /*
        echo '<pre>';
        print_r($comments);
        echo '</pre>';
        */
        

        return view('bakery.Details.bookdetail' , compact('products' , 'products_tags' , 'comments'));
    }

    public function add_cart(Request $request, $id) {
        if (!$request->session()->has('cart')) {
            $request->session()->put('cart' , []);
        }

        $this->validate($request , [
            'quantity'=>'required'
        ]);

        $products = Products::where('id' , '=' , $id)->get();
        Products::where('id' , '=' , $id)->update([
            'quantity'=>$products[0]['quantity'] - $request->quantity
        ]);
        $arr = $request->session()->get('cart');
        $productstore = Productstores::where('id' , '=' , $products[0]['bookstore_id'])->get();

        if (!isset($arr[$id])) {
            $arr[$id] = [
                'id'=>$id ,
                'book_id'=>$products[0]['id'] ,
                'book_name'=>$products[0]['book_name'] ,
                'author'=>$products[0]['author'] ,
                'image'=>$products[0]['image'] , 
                'quantity'=>$request->quantity ,
                'price'=>$products[0]['price'] ,
                'bookstore_name'=>$productstore[0]['bookstore_name'] ,
                'books_stock'=>$products[0]['quantity']
            ];
        }
        else {
            $arr[$id] = [
                'id'=>$id ,
                'book_id'=>$products[0]['id'] ,
                'book_name'=>$products[0]['book_name'] ,
                'author'=>$products[0]['author'] ,
                'image'=>$products[0]['image'] , 
                'quantity'=>$arr[$id]['quantity'] + $request->quantity ,
                'price'=>$products[0]['price'] ,
                'bookstore_name'=>$productstore[0]['bookstore_name'] ,
                'books_stock'=>$products[0]['quantity']
            ];
        }

        $request->session()->put('cart' , $arr);

        return redirect()->route('cart')->with('success' , 'Added successfully');
    }

    public function order_now (Request $request , $id) {
        $this->validate($request , [
            'name'=>'required' ,
            'phonenumber'=>'required' ,
            'email'=>'required' ,
            'address'=>'required' ,
            'amount'=>'required'
        ]);
        $products = Products::where('id' , '=' , $id)->get();
        Products::where('id' , '=' , $id)->update([
            'quantity'=>$products[0]['quantity'] - $request->amount
        ]);
        $user_details = $request->session()->get('user_details');
        $order = Orders::create([
            'user_id'=>$user_details->id ,
            'cus_name'=>$request->name ,
            'address'=>$request->address ,
            'phone'=>$request->phonenumber ,
            'email'=>$request->email ,
            'payment'=> $request->amount * $products[0]['price'] ,  
            'status'=>'0'
        ]);
        Order_details::create([
            'order_id'=>$order->id ,
            'book_id'=>$id ,
            'quantity'=>$request->amount ,
            'price'=>$products[0]['price'] * $request->amount
        ]);
        return redirect()->route('book_details' , $id)->with('success' , 'Bought successfully');
    }

    public function create_comment (Request $request , $id) {
        $this->validate($request , [
            'star'=>'required' ,
            'comment'=>'required'
        ]);

        $user = $request->session()->get('user_details');

        Comments::create([
            'book_id' => $id,
            'user_id' => $user->id ,
            'comment' => $request->comment ,
            'rating' => $request->star
        ]);
        return redirect()->route('book_details' , $id);
    }
}