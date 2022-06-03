<?php

namespace App\Http\Controllers\account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Admins;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function signin (Request $request)
    {
        Auth::logout();
        if ($request->session()->has('admin_details')) $request->session()->forget('admin_details');
        if ($request->session()->has('user_details')) $request->session()->forget('user_details');
        return view('loginform.view.signin');
    }
    public function signup(Request $request)
    {
        Auth::logout();
        if ($request->session()->has('admin_details')) $request->session()->forget('admin_details');
        if ($request->session()->has('user_details')) $request->session()->forget('user_details');
        return view('loginform.view.signup');
    }
    public function auth_user (Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('username', 'password');
        if (Auth::attempt($credentials)) {
            $request->session()->put('user_details' , Auth::user());
            return redirect()->route('home')->with('success','Signed in');
        }
        else return redirect()->route('login');
    }
    public function create_user (Request $request)
    {
        $this->validate($request , [
            'name' => 'required',
            'username'=> 'required',
            'phone' => 'required',
            'email' => 'required|unique:users|email',
            'address' => 'required',
            'password' => 'required|min:6|max:32',
            're-pass' => 'same:password',
        ] , 
        [
            'required' => 'Please fill in your :attribute.'
        ]);

        Users::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'name' => $request->name,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email
        ]);

        $credentials = $request->only('username', 'password');

        echo ('<pre>');
        print_r($credentials);
        echo ('</pre>');

        if (Auth::attempt($credentials)) {
            $request->session()->put('user_details' , Auth::user());
            return redirect()->route('home');
        }
    }



        // Admin
    public function admin_signin(Request $request)
    {
        Auth::logout();
        if ($request->session()->has('admin_details')) $request->session()->forget('admin_details');
        if ($request->session()->has('user_details')) $request->session()->forget('user_details');
        return view('loginform.view.admin_signin');
    }
    public function admin_signup(Request $request)
    {
        Auth::logout();
        if ($request->session()->has('admin_details')) $request->session()->forget('admin_details');
        if ($request->session()->has('user_details')) $request->session()->forget('user_details');
        return view('loginform.view.admin_signup');
    }
    public function create_admin (Request $request)
    {
        $this->validate($request , [
            'name' => 'required',
            'username'=> 'required',
            'name'=> 'required',
            'password' => 'required|min:6|max:32',
            're-pass' => 'same:password',
        ] , 
        [
            'required' => 'Please fill in your :attribute.'
        ]);

        Admins::create([
            'username' => $request->username ,
            'password' => bcrypt($request->password) ,
            'name' => $request->name ,
            'level' => 1
        ]);

        $credentials = $request->only('username', 'password');

        echo ('<pre>');
        print_r($credentials);
        echo ('</pre>');

        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->put('admin_details' , Auth::guard('admin')->user());
            return redirect()->route('admin_book_lists');
        }
    }
    public function auth_admin (Request $request)
    {
        $this->validate($request, [
            'username' => 'required',
            'password' => 'required'
        ]);
        $credentials = $request->only('username', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            $request->session()->put('admin_details' , Auth::guard('admin')->user());
            return redirect()->route('admin_book_lists');
        }
        else return redirect()->route('admin_login');
    }



    public function logout (Request $request) {
        Auth::logout();
        $request->session()->flush();
        return redirect()->to(url()->previous());
    }
}
