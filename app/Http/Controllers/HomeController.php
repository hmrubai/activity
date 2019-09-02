<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Agenda;
use App\Meeting;
use App\TaskList;
use App\ActionItem;
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
        //Meeting Data
        $AllMonths = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
        foreach($AllMonths as $month_name):
            $first_date = date('Y-m-d',strtotime('first day of '.$month_name.' 2019'));
            $last_date = date('Y-m-d',strtotime('last day of '.$month_name.' 2019'));
            $count_meetings[] = Meeting::whereBetween('date_time',[$first_date, $last_date])->get()->count();
        endforeach;

        //Activity Data
        $previous_month = date("Y-m-d",strtotime("-2 month"));
        $date_from = strtotime($previous_month);
        $date_to = strtotime(date('Y-m-d'));
        
        for ($i=$date_from; $i<=$date_to; $i+=86400) {  
            $search_date = date("Y-m-d", $i);
            $all_dates[] = $search_date;
            $count_get_daily_activities = DailyActivity::whereDate('created_at', $search_date)->get()->count();
            $all_activity_count[] = $count_get_daily_activities;
        }
        $activities = DailyActivity::select('daily_activities.*', 'users.name')->where('daily_activities.user_id', Auth::id())->leftjoin('users', 'users.id', '=', 'daily_activities.user_id')->orderBy('daily_activities.id', 'desc')->get();
        
        $self_tasks = TaskList::select('task_lists.id', 'task_lists.status', 'action_items.title', 'action_items.responsibilities', 'action_items.deadline', 'meetings.meeting_title')
        ->leftjoin('meetings', 'meetings.id', '=', 'task_lists.meeting_id')
        ->leftjoin('action_items', 'action_items.id', '=', 'task_lists.action_item_id')
        ->where('user_id', Auth::id())
        ->get();

        //Count Task
        $pending = TaskList::where('status', 'PENDING')->get()->count();
        $ongoing = TaskList::where('status', 'ON-GOING')->get()->count();
        $done = TaskList::where('status', 'DONE')->get()->count();

        $task_count = array($ongoing, $pending, $done); 

        //Staff Wise Task count
        $allStaff = User::orderBy('rank', 'asc')->get();
        $staff_task_count = [];
        foreach($allStaff as $staff):
            $user_id = $staff->id;
            $staff_pending = TaskList::where('status', 'PENDING')->where('user_id', $user_id)->get()->count();
            $staff_ongoing = TaskList::where('status', 'ON-GOING')->where('user_id', $user_id)->get()->count();
            $staff_done = TaskList::where('status', 'DONE')->get()->where('user_id', $user_id)->count();

            $all_task = $staff_pending + $staff_ongoing + $staff_done;

            if($all_task){
                $pending_task_in_parcentage = number_format((100 * $staff_pending)/$all_task, 2);
                $ongoing_task_in_parcentage = number_format((100 * $staff_ongoing)/$all_task, 2);
                $done_task_in_parcentage = number_format((100 * $staff_done)/$all_task, 2);
            }else{
                $pending_task_in_parcentage = 0;
                $ongoing_task_in_parcentage = 0;
                $done_task_in_parcentage = 0;
            }

            $staff_tasks = TaskList::select('task_lists.id', 'task_lists.status', 'action_items.title', 'action_items.responsibilities', 'action_items.deadline', 'meetings.meeting_title')
            ->leftjoin('meetings', 'meetings.id', '=', 'task_lists.meeting_id')
            ->leftjoin('action_items', 'action_items.id', '=', 'task_lists.action_item_id')
            ->where('user_id', $user_id)
            ->get();

            $staff_task_count[] = array('user_id' => $user_id ,'name' => $staff->name, 'designation' => $staff->designation, 'all_task' => $all_task, 'pending' => $staff_pending, 'ongoing' => $staff_ongoing, 'done' => $staff_done, 'pending_percent' => $pending_task_in_parcentage, 'ongoing_percent' => $ongoing_task_in_parcentage, 'done_percent' => $done_task_in_parcentage, 'task_list' => $staff_tasks);
        endforeach;

        $count_daily_activities = DailyActivity::whereDate('created_at', date("Y-m-d"))->get()->count();
        $active_stuff = DailyActivity::select('user_id')->distinct()->whereDate('created_at', date("Y-m-d"))->get()->count();
        $count_activities = DailyActivity::all()->count();
        $user = User::all()->count();
        $inactive_staff = $user - $active_stuff;
        return view('home', compact('all_dates', 'all_activity_count', 'count_meetings', 'task_count', 'staff_task_count', 'count_daily_activities', 'count_activities', 'activities', 'user', 'active_stuff', 'inactive_staff', 'self_tasks'));
    }

    public function entryDailyActivity(){
        return view('dataEntry');
    }

    public function getAllOfficer(){
        $all_officer = User::orderBy('rank', 'asc')->get();
        return view('getAllOfficer', compact('all_officer'));
    }
}
