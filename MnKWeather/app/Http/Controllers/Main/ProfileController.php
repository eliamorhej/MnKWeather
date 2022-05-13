<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\PinnedLocation;
class ProfileController extends Controller
{

    public function pin($id)
    {
        if(!( Auth::user() ))
            return redirect()->route('login');
        //dd($id,Auth::user()->getAttributes()['username']);

        if(!DB::table("PinnedLocation")->where('username', Auth::user()->getAttributes()['username'])->where('id',$id)->first())
            PinnedLocation::create([
                "username"=> Auth::user()->getAttributes()['username'],
                "id"=> $id
            ]);
    }
}