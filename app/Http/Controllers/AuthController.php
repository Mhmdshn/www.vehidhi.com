<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function index(){
        return view('auth.login');
    }

    public function login(Request $request){
        //dd($request->all());
        //validate
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        //login user here
        if(\Auth::attempt($request->only('email','password'))){
            return redirect('home');
        }
        return redirect('login')->withError('Login details are not valid');
    }

    public function register_view(){
        return view('auth.register');
    }

    public function register(Request $request){
        //dd($request->all());
        //validate
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|confirmed'
        ]);
        //save in users table
        User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> \Hash::make($request->password)
        ]);

        //login user here
        if(\Auth::attempt($request->only('email','password'))){
            return redirect('home');
        }
        return redirect('register')->withError('error');
    }

    public function home(){
        return view('home');
    }
    public function logout(){
        \Session::flush();
        \Auth::logout();
        return redirect('');
    }

}
