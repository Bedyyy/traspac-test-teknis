<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
           'email' => 'required|email|max:50',
           'password' => 'required|max:50'
        ]);
        if(Auth::attempt($request->only('email', 'password'), $request->remember)){
            if(Auth::user()->role == 'guest'){
                return redirect('/guest');
            }
            return redirect('/dashboard');
        }
        return back()->with('failed', "Email atau password salah.");
    }

    public function register(Request $request){
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|email|max:50|unique:users,email',
            'password' => 'required|max:50',
            'retype-password' => 'required|max:50|same:password'
        ]);
        $request['status'] = 'active';
        $user = User::create($request->all());
        Auth::login($user);
        return redirect('/users');
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
