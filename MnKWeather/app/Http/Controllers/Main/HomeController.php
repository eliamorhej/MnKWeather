<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
class HomeController extends Controller
{
    public function index()
    {
        $this->getWeatherInfo();
        return view("main.home");
    }
    private function getWeatherInfo()
    {
        if( Auth::user() )
        {
            
        }
        else
        {

        }
    }
}
