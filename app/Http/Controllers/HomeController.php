<?php

namespace App\Http\Controllers;

use Auth;
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
        
        $activities = DailyActivity::select('daily_activities.*', 'users.name')->where('daily_activities.user_id', Auth::id())->leftjoin('users', 'users.id', '=', 'daily_activities.user_id')->orderBy('daily_activities.id', 'desc')->get();
        
        $count_daily_activities = DailyActivity::whereDate('created_at', date("Y-m-d"))->get()->count();
        $active_stuff = DailyActivity::select('user_id')->distinct()->whereDate('created_at', date("Y-m-d"))->get()->count();
        $count_activities = DailyActivity::all()->count();
        $user = User::all()->count();
        $inactive_staff = $user - $active_stuff;
        return view('home', compact('count_daily_activities', 'count_activities', 'activities', 'user', 'active_stuff', 'inactive_staff'));
    }

    public function entryDailyActivity(){
        return view('dataEntry');
    }
}
