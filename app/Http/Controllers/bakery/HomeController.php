<?php

namespace App\Http\Controllers\bakery;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\Comments;
use App\Models\Orders;
use App\Models\Order_details;
use App\Models\Bookstores;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $books = Books::all()->take(12);
        foreach ($books as $key => $value) {
            $comments = Comments::where('book_id' , '=' , $value['id'])->get();
            $stars = 5;
            foreach ($comments as $key2 => $comment) {
                $stars += $comment['rating'];
            }
            $stars = round($stars/(count($comments)+1));
            $books[$key]['stars'] = $stars;
        }
        return view('bakery.test.demo' , compact('books'));
    }
    public function admin()
    {
        return view('admin.demo.test');
    }

    public function details ($id) {
        $book = Books::find($id)->get();
        return view('bakery.Details.bookdetail');
    }

    public function user_settings (Request $request) {
        /*
        echo "<pre>";
        print_r(Users::where('id' , '=' , $request->session()->get('user_details')->id)->get());
        print_r($request->session()->get('user_details'));
        echo "</pre>";
        */
        
        return view('bakery.test.edit_profile');
    }

    public function user_update_image (Request $request) {
        $this->validate($request , [
            'image'=>'required'
        ]);

        $image = $request->file('image');
        $name = basename($request->session()->get('user_details')->image);
        $store = $image->move('img/pfp', $name);
        $SQLstore = 'img/pfp/' . $name;

        Users::where('id' , '=' , $request->session()->get('user_details')->id)->update([
            'image'=>$SQLstore
        ]);

        $request->session()->put('user_details' , Auth::user());

        return redirect()->route('user_settings');
    }

    public function user_update_details (Request $request){
        $this->validate($request, [
            'name' => 'required',
            'username'=> 'required',
            'address'=> 'required',
            'phone' => 'required|max:10',
            'email' => 'required|unique:users|email'
        ] , 
        [
            'required' => 'Please fill in your :attribute.'
        ]);

        Users::where('id' , '=' , $request->session()->get('user_details')->id)->update([
            'name' => $request->name ,
            'username'=> $request->username ,
            'phone' => $request->phone ,
            'email' => $request->email ,
            'address' => $request->address
        ]);

        $request->session()->put('user_details' , Auth::user());

        return redirect()->route('user_settings');
    }

    public function user_orders(Request $request){
        $orders = Orders::where('user_id' , '=' , $request->session()->get('user_details')->id)->get();
        return view('bakery.test.user_orders' , compact('orders'));
    }
    public function user_order_details(Request $request , $id){
        $order = Orders::where('id' , '=' , $id)->get();
        $order_details = Order_details::where('order_id' , '=' , $id)->get();
        foreach ($order_details as $key => $value) {
            $book = Books::where('id' , '=' , $value['book_id'])->get();
            $bookstore = Bookstores::where('id' , '=' , $book[0]['bookstore_id'])->get();
            $value['image'] = $book[0]['image'];
            $value['book_name'] = $book[0]['book_name'];
            $value['bookstore_name'] = $bookstore[0]['bookstore_name'];
            $value['author'] = $book[0]['author'];
            $value['price'] = $book[0]['price'];
        }
        return view('bakery.test.user_order_details' , compact('order' , 'order_details'));
    }
    public function user_order_delete(Request $request , $id){
        $orders = Orders::where('user_id' , '=' , $id)->delete();
        return redirect()->route('user_orders')->with('success' , 'Deleted successfully');
    }
}
