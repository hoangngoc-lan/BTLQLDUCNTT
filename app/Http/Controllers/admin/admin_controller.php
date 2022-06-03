<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Users;
use App\Models\Admins;
use App\Models\Products;
use App\Models\Tags;
use App\Models\Products_tags;
use App\Models\Comments;
use App\Models\Orders;
use App\Models\Order_details;
use App\Models\Productstores;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class admin_controller extends Controller
{
    public function admin(){
        return view('admin.demo.test');
    }

    public function admin_account_settings(){
        return view('admin.demo.admin_account_settings');
    }
    public function admin_account_update_image (Request $request) {
        $this->validate($request , [
            'image'=>'required'
        ]);

        $image = $request->file('image');
        $name = basename($request->session()->get('admin_details')->image);
        if ($name == 'default.jpg') {
            $extension = $image->getClientOriginalExtension();
            $name = time() . "." . $extension;
        }
        $store = $image->move('img/pfp', $name);
        $SQLstore = 'img/pfp/' . $name;

        Admins::where('id' , '=' , $request->session()->get('admin_details')->id)->update([
            'image'=>$SQLstore
        ]);

        $request->session()->put('admin_details' , Auth::user());

        return redirect()->route('admin_account_settings');
    }

    public function admin_account_update_details (Request $request){
        $this->validate($request, [
            'name' => 'required',
            'username'=> 'required',
            'phonenumber' => 'required|max:10',
            'email' => 'required|unique:users|email'
        ] , 
        [
            'required' => 'Please fill in your :attribute.'
        ]);

        Admins::where('id' , '=' , $request->session()->get('admin_details')->id)->update([
            'name' => $request->name ,
            'username'=> $request->username ,
            'phonenumber' => $request->phonenumber ,
            'email' => $request->email
        ]);

        $request->session()->put('admin_details' , Auth::user());

        return redirect()->route('admin_account_settings');
    }

    	// Users
    public function admin_user_lists(){
    	$users = Users::all();
        return view('admin.demo.user_lists' , compact('users'));
    }
    public function admin_user_add(){
        return view('admin.demo.user_add');
    }
    public function admin_user_store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'username'=> 'required',
            'phone' => 'required',
            'email' => 'required|unique:users|email',
            'address' => 'required',
            'password' => 'required|min:6|max:32',
            'confirm' => 'same:password',
        ] , 
        [
            'required' => 'Please fill in your :attribute.'
        ]);     

        Users::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'address' => $request->address,
            'phonenumber' => $request->phone,
            'email' => $request->email //Hash::make($request->password)
        ]);

        return redirect()->route('admin_user_lists')->with('success', 'Created successfully');
    }
    public function admin_user_delete ($id){
    	Users::find($id)->delete();
        return redirect()->route('admin_user_lists')->with('success', 'Created successfully');
    }





        // Comments
    public function admin_comment_lists (Request $request) {
        $user_id = $request->user_id;
        $book_id = $request->book_id;
        $comments = Comments::where('id' , '!=' , '0');
        if (!is_null($user_id)) {
            $user = Users::where('id' , '=' , $user_id)->get();
            $print = "Comments from user#" .$user_id ." - " .$user[0]['username'];
            $comments->where('user_id' , '=' , $user_id);
        }
        if (!is_null($book_id)) {
            $products = Products::where('id' , '=' , $book_id)->get();
            $print = "Comments from book#" .$book_id ." - " .$products[0]['book_name'];
            $comments->where('book_id' , '=' , $book_id);
        }
        $comments = $comments->get();

        foreach ($comments as $key => $value) {
            $products = Products::where('id' , '=' , $value['book_id'])->get();
            $user = Users::where('id' , '=' , $value['user_id'])->get();
            $value['book_name'] = $products[0]['book_name'];
            $value['username'] = $user[0]['username'];
            $value['image'] = $user[0]['image'];
        }

        return view('admin.demo.comments_lists' , compact('comments' , 'print'));
    }





        // Admins
    public function admin_admin_lists(Request $request){
        $admins = Admins::where('level' , '!=' , '1')->get();
        return view('admin.demo.admin_lists' , compact('admins'));
    }
    public function admin_admin_add(){
        return view('admin.demo.admin_add');
    }
    public function admin_admin_store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'username'=> 'required',
            'phone' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|max:32',
            'confirm' => 'same:password',
        ] , 
        [
            'required' => 'Please fill in your :attribute.'
        ]);     

        echo bcrypt($request->password);

        Admins::create([
            'name' => $request->name,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'phonenumber' => $request->phone,
            'email' => $request->email //Hash::make($request->password)
        ]);

        return redirect()->route('admin_admin_lists')->with('success', 'Created successfully');
    }
    public function admin_admin_delete ($id){
        Users::find($id)->delete();
        return redirect()->route('admin_admin_lists')->with('success', 'Created successfully');
    }





    	// Bookstores
    public function admin_bookstore_lists(){
    	$productstores = productstores::all();
        return view('admin.demo.bookstore_lists' , compact('productstores'));
    }
    public function admin_bookstore_add(){
        return view('admin.demo.bookstore_add');
    }
    public function admin_bookstore_store(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'description'=> 'required'
        ] , 
        [
            'required' => 'Please fill in your :attribute.'
        ]);

        Productstores::create([
            'bookstore_name' => $request->name,
            'information' => $request->description
        ]);

        return redirect()->route('admin_bookstore_lists')->with('success', 'Created successfully');
    }
    public function admin_bookstore_delete ($id){
    	Productstores::find($id)->delete();
        return redirect()->route('admin_bookstore_lists')->with('success', 'Created successfully');
    }
    public function admin_bookstore_edit(Request $request , $id) {
        $productstore = Productstores::where('id' , '=' , $id)->get();
        return view('admin.demo.bookstore_edit' , compact('productstore'));
    }
    public function admin_bookstore_update(Request $request , $id) {
        $this->validate($request , [
                'bookstore_name' => "required" ,
                'information' => 'required'
            ],
            [
                'required' => 'Please fill in your :attribute.',
                'min' => 'Please pick the :attribute.'
            ]
        );

        Productstores::where('id' , '=' , $id)->update([
            'bookstore_name' => $request->bookstore_name,
            'information' => $request->information
        ]);

        return redirect()->route('admin_bookstore_lists')->with('success', 'Updated successfully');
    }





    	// Books
    public function admin_book_lists(Request $request){
    	$products = Products::all();
    	foreach ($products as $key => $value) {
    		$productstores = Productstores::where("id" , "=" , $value['bookstore_id'])->get();
    		$value['productstore_name'] = $productstores[0]['bookstore_name'];
    	}
        $products_tags = [];
        foreach ($products as $key => $value) {
            $arr = Products_tags::where('book_id' , '=' , $value['id'])->get();
            foreach ($arr as $key => $tag) {
                $tag_arr = Tags::where('id' , '=' , $tag['tag_id'])->get();
                $products_tags[$value['id']][] = [
                    'id'=>$tag['id'] , 
                    'tag_name'=>$tag_arr[0]['tag_name']
                ];
            }
        }

        return view('admin.demo.book_lists' , compact('products' , 'products_tags'));
    }
    public function admin_book_add(){
    	$productstores = Productstores::all();
        $tags = Tags::all();
        return view('admin.demo.book_add' , compact("productstores" , "tags"));
    }
    public function admin_book_store(Request $request){
        $this->validate($request , [
                'book_name' => "required",
                'author' => "required",
                'image' => "required",
                'quantity' => "required",
                'description' => "required",
                'price' => "required",
                'bookstore_id' => "required|min:0",
                'tag_id' => "required"
            ],
            [
                'required' => 'Please fill in your :attribute.',
                'min' => 'Please pick the :attribute.'
            ]
        );
        $image = $request->file('image');
        $extension = $image->getClientOriginalExtension();
        $name = time() . "." . $extension;
        $store = $image->move('img', $name);
        $SQLstore = 'img/' . $name;
        $products = Products::create([
            'book_name' => $request->book_name,
            'author' => $request->author,
            'image' => $SQLstore,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'price' => $request->price,
            'bookstore_id' => $request->bookstore_id
        ]);

        foreach ($request->tag_id as $value) {
            if ($value != -1) {
                Products_tags::create([
                    "book_id" => $products->id,
                    'tag_id' => $value
                ]);
            }
        }

        return redirect()->route('admin_book_lists')->with('success', 'Created successfully');
    }
    public function admin_book_edit(Request $request , $id) {
        $products = Products::where('id' , '=' , $id)->get();
        $productstores = Productstores::all();
        $tags = Tags::all();

        return view('admin.demo.book_edit' , compact('products' , 'productstores' , 'tags'));
    }
    public function admin_book_update(Request $request , $id) {
        $this->validate($request , [
                'book_name' => "required",
                'author' => "required",
                'quantity' => "required",
                'description' => "required",
                'price' => "required",
                'bookstore_id' => "required|min:0",
                'tags' => "required"
            ],
            [
                'required' => 'Please fill in your :attribute.',
                'min' => 'Please pick the :attribute.'
            ]
        );

        $products = Products::where('id' , '=' , $id)->get();
        if (!is_null($request->tags)) {
            $tag_add = [];
            foreach ($request->tags as $value) {
                if ($value != '-1') {
                    $tag_add[] = [
                        'book_id'=> $id ,
                        'tag_id' => $value
                    ];
                    Products_tags::where('book_id' , '=' , $id)->delete();
                }
            }

            foreach ($tag_add as $key => $value) {
                Products_tags::create([
                    "book_id" => $value['book_id'],
                    'tag_id' => $value['tag_id']
                ]);
            }
        }

        
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $name = basename($books[0]['image']);
            $store = $image->move('img', $name);
            $SQLstore = 'img/' . $name;
        }
        else {
            $SQLstore = Products::find($id)->image;
        }

        Products::where('id' , '=' , $id)->update([
            'book_name' => $request->book_name,
            'author' => $request->author,
            'image' => $SQLstore,
            'quantity' => $request->quantity,
            'description' => $request->description,
            'price' => $request->price,
            'bookstore_id' => $request->bookstore_id
        ]);

        return redirect()->route('admin_book_lists')->with('success', 'Deleted successfully');
    }
    public function admin_book_delete ($id){
    	Products::find($id)->delete();
        return redirect()->route('admin_book_lists')->with('success', 'Deleted successfully');
    }





        // Tags
    public function admin_tag_lists(){
        $tags = Tags::all();
        return view('admin.demo.tag_lists' , compact('tags'));
    }
    public function admin_tag_add(){
        return view('admin.demo.tag_add');
    }
    public function admin_tag_store(Request $request){
        $this->validate($request, [
            'tag_name' => 'required'
        ] , 
        [
            'required' => 'Please fill in your :attribute.'
        ]);     

        Tags::create([
            'tag_name' => $request->tag_name,
            'information' => $request->description
        ]);

        return redirect()->route('admin_tag_lists')->with('success', 'Created successfully');
    }
    public function admin_tag_delete ($id){
        Tags::find($id)->delete();
        return redirect()->route('admin_tag_lists')->with('success', 'Created successfully');
    }
    public function admin_tag_edit(Request $request , $id) {
        $tag = Tags::where('id' , '=' , $id)->get();
        return view('admin.demo.tag_edit' , compact('tag'));
    }
    public function admin_tag_update(Request $request , $id) {
        $this->validate($request , [
                'tag_name' => "required"
            ],
            [
                'required' => 'Please fill in your :attribute.',
                'min' => 'Please pick the :attribute.'
            ]
        );

        Tags::where('id' , '=' , $id)->update([
            'tag_name' => $request->tag_name,
        ]);

        return redirect()->route('admin_tag_lists')->with('success', 'Updated successfully');
    }





        // Orders
    public function admin_order_lists(Request $request , $id=-1){
        if ($id != -1) {
            $orders = Orders::where('user_id' , '=' , $id)->get();
            foreach ($orders as $key => $value) {
                $user = Users::where('id' , '=' , $value['user_id'])->get();
                $value['username'] = $user[0]['username'];
            }
            $print = ' - Orders from "' .$user[0]['username'] .'"';
        } 
        else {
            $print = '';
            $orders = Orders::all();
            foreach ($orders as $key => $value) {
                $user = Users::where('id' , '=' , $value['user_id'])->get();
                $value['username'] = $user[0]['username'];
            }
        }
        return view('admin.demo.order_lists' , compact('orders' , 'print'));
    }
    public function admin_order_details(Request $request , $id){
        $order = Orders::where('id' , '=' , $id)->get();
        $order_details = Order_details::where('order_id' , '=' , $order[0]['id'])->get();
        foreach ($order_details as $key => $value) {
            $products = Products::where('id' , '=' , $value['book_id'])->get();
            $productstore = Productstores::where('id' , '=' , $products[0]['bookstore_id'])->get();
            $value['image'] = $products[0]['image'];
            $value['book_name'] = $products[0]['book_name'];
            $value['bookstore_name'] = $productstore[0]['bookstore_name'];
            $value['author'] = $products[0]['author'];
            $value['price'] = $products[0]['price'];
        }
        return view('admin.demo.order_details' , compact('order' , 'order_details'));
    }
    public function admin_order_delete ($id){
        $order_details = Order_details::where('order_id' , '=' , $id)->get();
        foreach ($order_details as $key => $value) {
            $$products =Products::where('id' , '=' , $value['book_id'])->get();
            Products::where('id' , '=' , $value['book_id'])->update([
                'quantity'=>$products[0]['quantity'] + $value['quantity']
            ]);
        }
        Orders::where('id' , '=' , $id)->delete();
        return redirect()->route('admin_order_lists')->with('success', 'Order cancelled successfully');
    }
    public function admin_order_confirm ($id){
        Orders::where('id' , '=' , $id)->update([
            'status' => '1'
        ]);
        return redirect()->route('admin_order_lists')->with('success', 'Order confirmed successfully');
    }
    public function admin_order_disconfirm ($id){
        Orders::where('id' , '=' , $id)->update([
            'status' => '0'
        ]);
        return redirect()->route('admin_order_lists')->with('success', 'Order disconfirmed successfully');
    }
}
