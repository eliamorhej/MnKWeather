<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(["guest"]);
    }
    public function index()
    {
        return view("auth.register");
    }

    public function store(Request $request)
    {
        #dd($request);
        #validate
        $this->validate($request,[
            'username'=>'required|max:255',
            'password'=>'required|confirmed'
        ]);

        if ( DB::table("Users")->where('username',$request->username)->first()) {
            return back()->withErrors(['message' => 'User already exists']);
        } 
        #dd($request);
        #store
        User::create([
            "username"=>$request->username,
            "password_hash"=> Hash::make($request->password)
        ]);
        #sign user in
        $x = auth()->attempt( ['username' =>$request->username, 'password' =>$request->password]);      #request
        
        return redirect()->route('home');
    }
}
