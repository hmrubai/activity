<?php

namespace App\Http\Controllers;

use App\User;
use App\DailyActivity;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // $ip = \Request::ip();
        // $data = \Location::get($ip);
        // $position = \Location::get('192.168.1.19');
        
        $activities = DailyActivity::all()->count();
        $user = User::all()->count();
        return view('home', compact('activities', 'user'));
    }

    public function entryDailyActivity(){
        return view('dataEntry');
    }
}
