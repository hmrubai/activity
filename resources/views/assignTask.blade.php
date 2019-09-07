@extends('layouts.master') 
@section('content') 
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"> 
                  Assign Task
                  <button type="button"  data-toggle="modal" data-target="#AssignTask" class="btn btn-secondary float-right">Assign Task</button>
                  {{-- Start Modal --}}
                  <div class="modal fade" id="AssignTask" tabindex="-1" role="dialog" aria-labelledby="AssignTask" aria-hidden="true">
                      <div class="modal-dialog custom-dialog-position" role="document">
                        <div class="modal-content custom-modal-size">
                          <div class="modal-header">
                            <h5 class="modal-title">Assign Task</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                              <div class="card">
                                <div class="card-body">
                                    
                                    <h4 class="card-title">Task Details</h4>
                                    <form class="forms-sample" onsubmit="event.preventDefault();" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                      <div class="form-group">
                                        <label for="meeting_date">Task</label>
                                        <input class="form-control" name="task_item" id="task_item" type="text" placeholder="Task">
                                      </div>
                                      <div class="form-group">
                                          <div class="input-group">
                                            <select class="form-control" name="attendees_to_be_in_task" id="attendees_to_be_in_task" multiple>
                                              <?php foreach($users as $user): ?>
                                                <option value="{{ $user->id }}" >{{ $user->name }}, {{ $user->designation }}</option>
                                              <?php endforeach; ?>
                                            </select>
                                          </div>
                                        </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                          <input type="date" name="task_deadline" id="task_deadline" class="form-control" placeholder="Deadline" aria-label="Deadline" aria-describedby="colored-addon3">
                                        </div>
                                      </div>
                                      <div class="form-group">
                                        <div class="input-group">
                                          <div class="input-group-append bg-primary border-primary">
                                            <span onclick="addTaskList()" class="input-group-text bg-transparent add-butn">
                                              <i class="mdi mdi-clipboard-plus text-white"></i>
                                            </span>
                                          </div>
                                        </div>
                                      </div>
                                      <br/>
                                      <div id="task_item_list">
                                        <ul class="list-group">
                                        </ul>
                                      </div>
                                      <br/>
                                      
                                      <button type="submit" onclick="SubmitTaskDetails()" class="btn btn-success mr-2">Submit</button>
                                      <button class="btn btn-light">Cancel</button>
                                    </form>
                                </div>
                              </div>
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          </div>
                        </div>
                      </div>
                    </div>
                    {{-- End Modal --}}
                  <br/><br/>
                  <table>
                      <thead>
                          <tr>
                              <th>Name</th>
                              <th>Task</th>
                              <th>Deadline</th>
                              <th>Status</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach($tasks as $task): ?>
                        <tr>
                            <td>{{ $task->name }} <br> {{ $task->designation }}</td>
                            <td>{{ $task->title }}</td>
                            <td>{{ $task->deadline }}</td>
                            <td>
                                <?php 
                                if($task->status == "PENDING"){ ?> <button type="button" class="btn btn-danger btn-rounded btn-fw">{{ $task->status }}</button> <?php } 
                                elseif($task->status == "ON-GOING"){ ?> <button type="button" class="btn btn-warning btn-rounded btn-fw">{{ $task->status }}</button> <?php } 
                                elseif($task->status == "DONE"){ ?> <button type="button" class="btn btn-success btn-rounded btn-fw">{{ $task->status }}</button> <?php } 
                                elseif($task->status == "REMOVED"){ ?> <button type="button" class="btn btn-default btn-rounded btn-fw">{{ $task->status }}</button> <?php } 
                                ?>
                            </td>

                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                  </table>
                </div>
            </div>
        </div>
    </div>
    <footer class="footer">
        <div class="container-fluid clearfix">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 <a href="#"
                    target="_blank">DGDA</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a href="#"
                    target="_blank">Cerebrum Technology Limited</a></span>
        </div>
    </footer>
    <script>
        $("#staff_list").addClass("active");

        var task_list = [];

        function addTaskList(){
          var task = $('#task_item').val();
          var attendees = $('#attendees_to_be_in_task').val();
          var task_deadline = $('#task_deadline').val();
          if(task && attendees && task_deadline){
            task_list.push({task: task, attendees: attendees, deadline: task_deadline});
            $('#task_item_list ul').empty();
            $.each( task_list, function( key, value ) {
              $("#task_item_list ul").append('<li id="task_list_no_'+ key +'" class="list-group-item d-flex justify-content-between align-items-center"> <span class="first-row-action">' + value.task + '</span><span class="third-row-action">' + value.deadline + '</span> <span onclick="deleteTaskList('+ key +')" class="badge badge-danger badge-pill add-butn">X</span></li>');
            });
            $('#task_item').val('');
            $('#attendees_to_be_in_task').val('');
            $('#task_deadline').val('');
          }
        }

        function deleteTaskList(delete_id)
        {
          task_list.splice(delete_id, 1);
          $('#task_list_no_'+delete_id).remove();
          $('#task_item_list ul').empty();
          if(task_list.length){
            $.each( task_list, function( key, value ) {
              $("#task_item_list ul").append('<li id="task_list_no_'+ key +'" class="list-group-item d-flex justify-content-between align-items-center"> <span class="first-row-action">' + value.task + '</span><span class="third-row-action">' + value.deadline + '</span> <span onclick="deleteTaskList('+ key +')" class="badge badge-danger badge-pill add-butn">X</span></li>');
            });
          }
        }

        function SubmitTaskDetails()
        {
          var params = { 
            task_list: task_list,
            '_token': '<?= csrf_token() ?>'
          }

          console.log(params)

          axios.post('/assigntaskToEmployee', params)
          .then(function (response) {
            Swal.fire({
              position: 'top-end',
              type: 'success',
              title: 'The Task has been saved!',
              showConfirmButton: false,
              timer: 1500
            });
            setTimeout(function() { location.reload();; }, 5000);
          })
          .catch(function (error) {
            console.log(error);
          });
        }

    </script>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th {
            text-align: left;
            background-color: #229f5e;
            color: white;
        }

        th,
        td {
            padding: 6px;
            text-align: left;
            font-weight: 300;
            font-size: 14px;
            border: 1px solid #ddd;
        }

        tr:hover {
            background-color: #d6d5d3;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .custom-modal-size{
          width: 700px !important;
        }

        .profile-image{
          width: 40px !important;
        }

        .custom-dialog-position{
          left: -100px !important;
        }
        .add-butn{
          cursor: pointer;
        }
    </style>
</div> 
@endsection
