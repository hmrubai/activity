@extends('layouts.master') 
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"> 
                  Meeting List 
                  <?php 
                  
                  // echo "<pre>";
                  // print_r($meetingInformation);
                  // exit;
                  
                  ?>
                  <button type="button"  data-toggle="modal" data-target="#AddMeeting" class="btn btn-secondary float-right">Add New Meeting</button>
                  {{-- Start Modal --}}
                  <div class="modal fade" id="AddMeeting" tabindex="-1" role="dialog" aria-labelledby="AddMeeting" aria-hidden="true">
                    <div class="modal-dialog custom-dialog-position" role="document">
                      <div class="modal-content custom-modal-size">
                        <div class="modal-header">
                          <h5 class="modal-title">Add Meeting</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                            <div class="card">
                              <div class="card-body">
                                  
                                  <h4 class="card-title">Meeting Details</h4>
                                  <form class="forms-sample" onsubmit="event.preventDefault();" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                                    <div class="form-group">
                                      <label for="meeting_date">Reasone of meeting/Meeting Title</label>
                                      <input class="form-control" name="meeting_title" id="meeting_title" type="text" placeholder="Reasone of meeting/Meeting Title">
                                    </div>
                                    <div class="form-group">
                                      <label for="meeting_date">Date</label>
                                      <input class="form-control" name="meeting_date" id="meeting_date" type="date" placeholder="dd/mm/yyyy">
                                    </div>
                                    <div class="form-group">
                                      <label for="meeting_date">Time</label>
                                      <input class="form-control" name="meeting_time" id="meeting_time" type="text" placeholder="সকাল ১০ ঘটিকা">
                                    </div>
                                    <div class="form-group">
                                      <label for="Chairperson">Chairperson</label>
                                      <input type="text" class="form-control" name="chairperson" id="chairperson" placeholder="Chairperson">
                                    </div>
                                    <div class="form-group">
                                      <label for="participants">Attendees</label>
                                      <select class="form-control" name="participants" id="participants" multiple size="6">
                                        <?php foreach($users as $user): ?>
                                        <option value="{{ $user->id }}" >{{ $user->name }}, {{ $user->designation }}</option>
                                      <?php endforeach; ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="vanue">	Vanue</label>
                                      <input type="text" class="form-control" name="vanue" id="vanue" placeholder="Vanue">
                                    </div>
                                    <div class="form-group">
                                      <label for="minutes_taken_by">Minutes taken by</label>
                                      <select class="form-control" name="minutes_taken_by" id="minutes_taken_by">
                                        <?php foreach($users as $user): ?>
                                        <option value="{{ $user->id }}" >{{ $user->name }}, {{ $user->designation }}</option>
                                      <?php endforeach; ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="minutes_reviewed_by">Minutes reviewed by</label>
                                      <select class="form-control" name="minutes_reviewed_by" id="minutes_reviewed_by">
                                        <?php foreach($users as $user): ?>
                                        <option value="{{ $user->id }}" >{{ $user->name }}, {{ $user->designation }}</option>
                                      <?php endforeach; ?>
                                      </select>
                                    </div>
                                    <div class="form-group">
                                      <label for="apologies">Apologies</label>
                                      <textarea class="form-control" name="apologies" id="apologies" rows="3" ></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label for="discussions">Discussions</label>
                                      <textarea class="form-control" name="discussions" id="discussions" rows="3" ></textarea>
                                    </div>
                                    <div class="form-group">
                                      <label for="attachment">Attach File</label>
                                      <input type="file" name="attachment" class="form-control-file" id="attachment">
                                    </div>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <input type="text" name="task_item" id="task_item" class="form-control" placeholder="Task Item" aria-label="Task Item" aria-describedby="colored-addon3">
                                        
                                        <select class="form-control" name="attendees_to_be_in_task" id="attendees_to_be_in_task" multiple>
                                          <?php foreach($users as $user): ?>
                                            <option value="{{ $user->id }}" >{{ $user->name }}, {{ $user->designation }}</option>
                                          <?php endforeach; ?>
                                        </select>
                                        
                                        <input type="date" name="task_deadline" id="task_deadline" class="form-control" placeholder="Deadline" aria-label="Deadline" aria-describedby="colored-addon3">
                                        <div class="input-group-append bg-primary border-primary">
                                          <span onclick="addTaskList()" class="input-group-text bg-transparent add-butn">
                                            <i class="mdi mdi-clipboard-plus text-white"></i>
                                          </span>
                                        </div>
                                      </div>
                                    </div>

                                    <div id="task_item_list">
                                      <ul class="list-group">
                                      </ul>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <input type="text" name="agenda" id="agenda"  class="form-control" placeholder="Agenda" aria-label="Agenda" aria-describedby="colored-addon3">
                                        <div class="input-group-append bg-primary border-primary">
                                          <span onclick="addAgenda()" class="input-group-text bg-transparent add-butn">
                                            <i class="mdi mdi-clipboard-plus text-white"></i>
                                          </span>
                                        </div>
                                      </div>
                                    </div>
                                    <div id="agenda_item">
                                      <ul class="list-group">
                                      </ul>
                                    </div>
                                    <br/>
                                    <div class="form-group">
                                      <div class="input-group">
                                        <input type="text" name="action_item" id="action_item" class="form-control" placeholder="Action Items" aria-label="Action Items" aria-describedby="colored-addon3">
                                        <input type="text" name="responsibilities" id="responsibilities" class="form-control" placeholder="Responsibilities" aria-label="Responsibilities" aria-describedby="colored-addon3">
                                        <input type="date" name="deadline" id="deadline" class="form-control" placeholder="Deadline" aria-label="Deadline" aria-describedby="colored-addon3">
                                        <div class="input-group-append bg-primary border-primary">
                                          <span onclick="addActionList()" class="input-group-text bg-transparent add-butn">
                                            <i class="mdi mdi-clipboard-plus text-white"></i>
                                          </span>
                                        </div>
                                      </div>
                                    </div>
                                    <div id="action_list">
                                      <ul class="list-group">
                                      </ul>
                                    </div>
                                    <br/>
                                    
                                    <button type="submit" onclick="SubmitMettingDetails()" class="btn btn-success mr-2">Submit</button>
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
                              <th>Date</th>
                              <th>Title</th>
                              <th>Chairperson</th>
                              <th>Time</th>
                              <th>Vanue</th>
                              <th>Agenda</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach($meetingInformation as $meetingDetails):
                        $meetingInfo = $meetingDetails['meeting'];
                        $attendee_list = $meetingDetails['attendee_list'];
                        $assigned_attendee = $meetingDetails['assigned_attendee'];
                        $agenda = $meetingDetails['agenda'];
                        $action_item = $meetingDetails['action_item'];
                        ?>

                          <tr>
                            <td>{{ $meetingInfo->date_time }}</td>
                            <td>{{ $meetingInfo->meeting_title }}</td>
                            <td>{{ $meetingInfo->chairperson }}</td>
                            <td>{{ $meetingInfo->meeting_time }}</td>
                            <td>{{ $meetingInfo->vanue }}</td>
                            <td>
                              <?php 
                                foreach($agenda as $item):
                              ?>
                                {{ $item->title }}<br>
                              <?php 
                              endforeach; 
                              ?>
                            </td>
                            <td>
                              <button type="button" data-toggle="modal" data-target="#MeetingDetails_<?php echo $meetingInfo->id; ?>" class="btn btn-success"><i class="mdi mdi-eye"></i></button>
                              <button type="button" data-toggle="modal" data-target="#DetailsActionItem_<?php echo $meetingInfo->id; ?>" class="btn btn-warning"><i class="mdi mdi-view-list"></i></button>

                              {{-- Start Action item Modal --}}
                              <div class="modal fade" id="DetailsActionItem_<?php echo $meetingInfo->id; ?>" tabindex="-1" role="dialog" aria-labelledby="DetailsActionItem_<?php echo $meetingInfo->id; ?>" aria-hidden="true">
                                  <div class="modal-dialog custom-dialog-position" role="document">
                                    <div class="modal-content custom-modal-size">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Action items Of {{ $meetingInfo->meeting_title }}  (Date: {{ $meetingInfo->date_time }})</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                          <div class="card">
                                            <div class="card-body">
                                                <table>
                                                  <thead>
                                                    <tr>
                                                      <th>SL#</th>
                                                      <th>New Actions/Decisions</th>
                                                      <th>Responsibilities</th>
                                                      <th>Dateline</th>
                                                    </tr>
                                                  </thead>
                                                    <?php 
                                                      $sl = 1;
                                                      foreach($action_item as $list):
                                                    ?>
                                                      <tr>
                                                          <td>{{ $sl }}.</td>
                                                          <td>{{ $list->title }}</td>
                                                          <td>{{ $list->responsibilities }}</td>
                                                          <td>{{ $list->deadline }}</td>
                                                      </tr>
                                                    <?php 
                                                      $sl++;
                                                      endforeach; 
                                                    ?>
                                                </table>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                {{-- End Action item Modal --}}

                                {{-- Start Details Modal --}}
                                <div class="modal fade" id="MeetingDetails_<?php echo $meetingInfo->id; ?>" tabindex="-1" role="dialog" aria-labelledby="MeetingDetails_<?php echo $meetingInfo->id; ?>" aria-hidden="true">
                                  <div class="modal-dialog custom-dialog-position" role="document">
                                    <div class="modal-content custom-modal-size">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Meeting Details Of {{ $meetingInfo->meeting_title }}  (Date: {{ $meetingInfo->date_time }})</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                          <div class="card">
                                            <div class="card-body">
                                                <table>
                                                    <tr>
                                                        <td colspan="2"><strong>Meeting Minutes</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Reasone of meeting/Meeting Title</td>
                                                        <td>{{ $meetingInfo->meeting_title }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Chairperson</td>
                                                        <td>{{ $meetingInfo->chairperson }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Date</td>
                                                        <td>{{ $meetingInfo->date_time }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Time</td>
                                                        <td>{{ $meetingInfo->meeting_time }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Vanue</td>
                                                        <td>{{ $meetingInfo->vanue }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Minutes taken by</td>
                                                        <td>{{ $meetingDetails['taken_by_name'] }} , {{ $meetingDetails['taken_by_designation'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Minutes reviewed by</td>
                                                        <td>{{ $meetingDetails['reviewed_by_name'] }} , {{ $meetingDetails['reviewed_by_designation'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Attendees</td>
                                                        <td>
                                                            <?php 
                                                            $sl = 1;
                                                            foreach($attendee_list as $attendee):
                                                          ?>
                                                            {{ $attendee['name'] }} ( {{ $attendee['designation'] }} ), 
                                                          <?php 
                                                            $sl++;
                                                            endforeach; 
                                                          ?>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Apologies</td>
                                                        <td>{{ $meetingInfo->apologies }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discussions</td>
                                                        <td>{{ $meetingInfo->discussions }}</td>
                                                    </tr>
                                                    <tr>
                                                      <td colspan="2">
                                                        <table>
                                                          <thead>
                                                            <tr>
                                                              <th>SL#</th>
                                                              <th>New Actions/Decisions</th>
                                                              <th>Responsibilities</th>
                                                              <th>Dateline</th>
                                                            </tr>
                                                          </thead>
                                                            <?php 
                                                              $sl = 1;
                                                              foreach($action_item as $list):
                                                            ?>
                                                              <tr>
                                                                  <td>{{ $sl }}.</td>
                                                                  <td>{{ $list->title }}</td>
                                                                  <td>{{ $list->responsibilities }}</td>
                                                                  <td>{{ $list->deadline }}</td>
                                                              </tr>
                                                            <?php 
                                                              $sl++;
                                                              endforeach; 
                                                            ?>
                                                        </table>
                                                      </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Attachment</td>
                                                        <td>
                                                            <a href="files/meetings/<?php echo $meetingInfo->attachments; ?>" download="<?php echo $meetingInfo->attachments; ?>"><button type="button" class="btn btn-warning">Download</button>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                                {{-- End Action item Modal --}}

                            </td>
                          </tr>

                        <?php 
                      endforeach; 
                      ?>
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
        $("#meeting_list").addClass("active");
        var agenda = [];
        var action_list = [];
        var task_list = [];

        function addAgenda()
        {
          var newAgenda = $('#agenda').val();
          if(newAgenda){
            agenda.push(newAgenda);
            $('#agenda_item ul').empty();
            $.each( agenda, function( key, value ) {
              $("#agenda_item ul").append('<li id="agenda_list_no_'+ key +'" class="list-group-item d-flex justify-content-between align-items-center">'+ value +'<span onclick="deleteAgenda('+ key +')" class="badge badge-danger badge-pill add-butn">X</span></li>');
            });
            $('#agenda').val('');
          }
        }

        function deleteAgenda(delete_id)
        {
          agenda.splice(delete_id, 1);
          $('#agenda_list_no_'+delete_id).remove();
          $('#agenda_item ul').empty();
          if(agenda.length){
            $.each( agenda, function( key, value ) {
              $("#agenda_item ul").append('<li id="agenda_list_no_'+ key +'" class="list-group-item d-flex justify-content-between align-items-center">'+ value +'<span onclick="deleteAgenda('+ key +')" class="badge badge-danger badge-pill add-butn">X</span></li>');
            });
          }
        }

        function addActionList()
        {
          var title = $('#action_item').val();
          var responsibilities = $('#responsibilities').val();
          var deadline = $('#deadline').val();
          if(title && responsibilities && deadline){
            action_list.push({title: title, responsibilities: responsibilities, deadline: deadline});
            $('#action_list ul').empty();
            $.each( action_list, function( key, value ) {
              $("#action_list ul").append('<li id="item_list_no_'+ key +'" class="list-group-item d-flex justify-content-between align-items-center"> <span class="first-row-action">' + value.title + '</span><span class="second-row-action">' + value.responsibilities + '</span><span class="third-row-action">' + value.deadline + '</span> <span onclick="deleteActionList('+ key +')" class="badge badge-danger badge-pill add-butn">X</span></li>');
            });
            $('#action_item').val('');
            $('#responsibilities').val('');
            $('#deadline').val('');
          }
        }

        function addTaskList(){
          var task = $('#task_item').val();
          var attendees = $('#attendees_to_be_in_task').val();
          var task_deadline = $('#task_deadline').val();
          if(task && attendees && deadline){
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

        function deleteActionList(delete_id)
        {
          action_list.splice(delete_id, 1);
          $('#item_list_no_'+delete_id).remove();
          $('#action_list ul').empty();
          if(action_list.length){
            $.each( action_list, function( key, value ) {
              $("#action_list ul").append('<li id="item_list_no_'+ key +'" class="list-group-item d-flex justify-content-between align-items-center"> <span class="first-row-action">' + value.title + '</span><span class="second-row-action">' + value.responsibilities + '</span><span class="third-row-action">' + value.deadline + '</span> <span onclick="deleteActionList('+ key +')" class="badge badge-danger badge-pill add-butn">X</span></li>');
            });
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

        function SubmitMettingDetails()
        {
          const file = document.getElementById('attachment');

          let data = new FormData();
          data.append('attachment', file.files[0]);
          data.append('meeting_title', $('#meeting_title').val());
          data.append('meeting_date', $('#meeting_date').val());
          data.append('meeting_time', $('#meeting_time').val());
          data.append('chairperson', $('#chairperson').val());
          data.append('participants', $('#participants').val());
          data.append('vanue', $('#vanue').val());
          data.append('minutes_taken_by', $('#minutes_taken_by').val());
          data.append('minutes_reviewed_by', $('#minutes_reviewed_by').val());
          data.append('apologies', $('#apologies').val());
          data.append('discussions', $('#discussions').val());
          data.append('agenda', JSON.stringify(agenda));
          data.append('action_list', JSON.stringify(action_list));
          data.append('task_list', JSON.stringify(task_list));
          data.append('_token', '<?= csrf_token() ?>');

          axios.post('/saveMeeting', data, {
              headers: {
                'Content-Type': 'multipart/form-data'
              }
          })
          .then(function (response) {
            Swal.fire({
              position: 'top-end',
              type: 'success',
              title: 'The metting details has been saved!',
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
          width: 1000px !important;
        }

        .custom-dialog-position{
          left: -245px !important;
        }
        .add-butn{
          cursor: pointer;
        }

        .first-row-action{
          width: 40%;
        }
        .second-row-action{
          width: 40%;
        }
        .third-row-action{
          width: 20%;
        }
    </style>
</div> 
@endsection
