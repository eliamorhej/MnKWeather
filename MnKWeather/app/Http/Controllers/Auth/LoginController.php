<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(["guest"]);
    }
    public function index()
    {
        return view("auth.login");
    }
    public function store(Request $request)
    {
        #validate
        $this->validate($request,[
            'username'=>'required|max:255',
            'password'=>'required'
        ]);
        #sign user in
        if(!auth()->attempt( ['username' =>$request->username, 'password' =>$request->password]))
            return back()->withErrors(['message' => 'Invalid Login Details']);      #request
        
        return redirect()->route('home');
    }
}
