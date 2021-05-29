<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index($id){
        $user = DB::table('users')->find($id);
        return view('user.profile', compact('user'));
    }
    public function update(Request $request,$id){
        $user = DB::table('users')->find($id);
        if($file = $request->file('image')){
            $fileName =  time() . '_' . $file->getClientOriginalName() ;
            $file->move(public_path('images') , $fileName);
            $user->update([
                'name' => $request->name,
                'image' => 'images/' . $fileName,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'address' => $request->address
            ]);
        }
        else{
            $user->update([
                'name' => $request->name,
                'email'=> $request->email,
                'phone'=> $request->phone,
                'address' => $request->address
            ]);
        }
        
        return redirect('/profile/'.$request->id.'')->with('status', 'Update successful!');
    }
}
