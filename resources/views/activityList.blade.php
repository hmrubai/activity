@extends('layouts.master') 
@section('content') 
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"> 
                  Activity List 
                  <br/><br/>
                  <table>
                      <thead>
                          <tr>
                              <th>Visited By</th>
                              <th>Visited Area</th>
                              <th>No. of visited pharmacy</th>
                              <th>No. of depot</th>
                              <th>Without license</th>
                              <th>Not renewed</th>
                              <th>Sample collected</th>
                              <th>Action</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php 
                        foreach ($activities as $activity):
                        ?>
                        <tr>
                            <td>{{ $activity->name }}</td>
                            <td>{{ $activity->visited_area }}</td>
                            <td>{{ $activity->no_of_visited_pharmacy }}</td>
                            <td>{{ $activity->no_of_depot }}</td>
                            <td>{{ $activity->no_of_identified_pharmacy_without_license }}</td>
                            <td>{{ $activity->no_of_identified_not_renewed_license }}</td>
                            <td>{{ $activity->no_of_sample_collected }}</td>
                            <td>Action</td>
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
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2018 <a href="#"
                    target="_blank">DGDA</a>. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"><a href="#"
                    target="_blank">Cerebrum Technology Limited</a></span>
        </div>
    </footer>
    <script>
        $("#activity_list").addClass("active");
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
    </style>
</div> 
@endsection
