<?php

namespace App\Http\Controllers;

use App\User;
use App\Agenda;
use App\Meeting;
use App\TaskList;
use App\ActionItem;
use Illuminate\Http\Request;

class MeetingController extends Controller
{
    public function index()
    {
        $meetingInformation = [];
        $users = User::orderBy('rank', 'asc')->get();
        $meetings = Meeting::orderBy('id', 'desc')->get();
        foreach($meetings as $meeting):
            $attendees = [];
            $assigned_attendee = [];

            $meeting_id = $meeting->id;
            $minutes_taken_by_id = $meeting->minutes_taken_by;
            $minutes_reviewed_by_id = $meeting->minutes_reviewed_by;

            $get_taken_by = User::select('name', 'designation')->where('id', $minutes_taken_by_id)->get();
            $get_reviewed_by = User::select('name', 'designation')->where('id', $minutes_reviewed_by_id)->get();

            $getAgenda = Agenda::where('meeting_id', $meeting_id)->get();
            $getActionItem = ActionItem::where('meeting_id', $meeting_id)->get();
            
            $attendee_list = explode(",", unserialize($meeting->attendees));
            // $assigned_attendee_list = explode(",", unserialize($meeting->assign_attendees_in_task));
            
            foreach($attendee_list as $attendee):
                $getUser = User::select('name', 'designation')->where('id', $attendee)->get();
                $attendees[] = array('name' => $getUser[0]->name, 'designation' => $getUser[0]->designation);
            endforeach;

            // foreach($assigned_attendee_list as $attendee):
            //     $getAttendeeUser = User::select('name', 'designation')->where('id', $attendee)->get();
            //     $assigned_attendee[] = array('name' => $getAttendeeUser[0]->name, 'designation' => $getAttendeeUser[0]->designation);
            // endforeach;

            $meetingInformation[] = array('meeting' => $meeting, 'taken_by_name' => $get_taken_by[0]->name,  'taken_by_designation' => $get_taken_by[0]->designation, 'reviewed_by_name' => $get_reviewed_by[0]->name, 'reviewed_by_designation' => $get_reviewed_by[0]->designation, 'attendee_list' => $attendees, 'assigned_attendee' => $assigned_attendee, 'agenda' => $getAgenda, 'action_item' => $getActionItem);
        endforeach;

        return view('meetingList', compact('users', 'meetingInformation'));
    }

    public function updateTaskStatus(Request $request)
    {
        $task_id = $request->task_id;
        $status = $request->status;

        if($status == 'done'){
            $updated_status = "DONE";
        }elseif($status == 'ongoing'){
            $updated_status = "ON-GOING";
        }elseif($status == 'removed'){
            $updated_status = "REMOVED";
        }else{
            $updated_status = "PENDING";
        }

        $tsakInfo = TaskList::find($task_id);
        $tsakInfo->status = $updated_status;
        $tsakInfo->save();

        return response()->json(array(
            'data' => 'Successful',
            'status' => 'Successful',
            'message' => 'Status has been updated successfully!'
        ));
        
    }

    public function store(Request $request)
    {
        $attendees = serialize($request->participants);
        $assign_attendees = serialize($request->assign_attendees_in_task);

        $req_agenda = $request->agenda;
        $req_action_list = $request->action_list;
        $req_task_list = $request->task_list;

        $agenda = json_decode($req_agenda);
        $action_list = json_decode($req_action_list);
        $task_list = json_decode($req_task_list);

        $AddMeeting = new Meeting();
        $AddMeeting->meeting_title = $request->meeting_title;
        $AddMeeting->chairperson = $request->chairperson;
        $AddMeeting->date_time = $request->meeting_date;
        $AddMeeting->meeting_time = $request->meeting_time;
        $AddMeeting->vanue = $request->vanue;
        $AddMeeting->minutes_taken_by = $request->minutes_taken_by;
        $AddMeeting->minutes_reviewed_by = $request->minutes_reviewed_by;
        $AddMeeting->attendees = $attendees;
        $AddMeeting->apologies = $request->apologies;
        $AddMeeting->discussions = $request->discussions;
        if($request->attachment){
            $meeting_attachment  =  'meetings_'.time().'.'.$request->attachment->getClientOriginalExtension();
            $request->attachment->move(public_path('files/meetings'), $meeting_attachment);
        }else{ $meeting_attachment  = ""; }

        $AddMeeting->attachments = $meeting_attachment;
        $AddMeeting->save();

        $meeting_id = $AddMeeting->id;

        if(sizeof($action_list))
        {
            foreach($action_list as $item):

                $AddActionItem = new ActionItem();
                $AddActionItem->meeting_id = $meeting_id;
                $AddActionItem->title = $item->title;
                $AddActionItem->responsibilities = $item->responsibilities;
                $AddActionItem->deadline = $item->deadline;
                $AddActionItem->save();

            endforeach;
        }

        if(sizeof($task_list))
        {
            foreach($task_list as $task):
                $task_attendee = $task->attendees;

                $ActionItem = new ActionItem();
                $ActionItem->title = $task->task;
                $ActionItem->deadline = $task->deadline;
                $ActionItem->save();

                $task_id = $ActionItem->id;

                foreach($task_attendee as $employee):
                    $AddTask = new TaskList();
                    $AddTask->user_id = $employee;
                    $AddTask->action_item_id = $task_id;
                    $AddTask->save();
                endforeach;

            endforeach;
        }

        if(sizeof($agenda))
        {
            foreach($agenda as $list):
                $AddAgenda = new Agenda();
                $AddAgenda->meeting_id = $meeting_id;
                $AddAgenda->title = $list;
                $AddAgenda->save();
            endforeach;
        }

        return response()->json(array(
            'data' => 'Successful',
            'status' => 'Successful',
            'message' => 'The metting has been saved successfully!'
        ));
    }

    public function assignTask(Request $request)
    {
        $users = User::orderBy('rank', 'asc')->get();
        return view('assignTask', compact('users'));
    }

    public function edit(Meeting $meeting)
    {
        
    }

    public function update(Request $request, Meeting $meeting)
    {
        
    }

    public function destroy(Meeting $meeting)
    {
        
    }
}
