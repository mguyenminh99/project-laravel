<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    public function checkLogin(Request $request){
       
        $username = $request->username;
        $password = $request->password;
        
        if(auth()->attempt(array('username' => $username, 'password' => $password))){
            $user = auth()->user();
            Session::put('user' , $user);
            return redirect()->route('home');
        }
        else {
            return redirect()->back()->with('error' , ' Invalid credentials');;
        }
    }
    public function register(RegisterUserRequest $request){
        User::query()->create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone
        ]);
        $user = [
            'username' => $request->username,
            'name'     => $request->name,
            'email'    => $request->email,
            'phone'    => $request->phone
        ];
        Session::put('user', $user);
        $user = Session()->get('user');
        return redirect()->route('home' , 'user');
    }
    public function logOut(){
        Auth::logout();
        Session::invalidate();
        Session::regenerateToken();
        return redirect()->route('home');
    }
}
