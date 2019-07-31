@extends('layouts.master') 
@section('content') 
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<div class="content-wrapper">
<?php if(Auth::user()->user_type == "ADMIN"){ ?>
    <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-cube text-danger icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Daily Activities</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $count_daily_activities }}</h3>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="nav-link"><p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-alert-octagon mr-1" aria-hidden="true"></i> Show Daily Activities </p></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-receipt text-warning icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Total Activities</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $count_activities }}</h3>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="nav-link"><p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-bookmark-outline mr-1" aria-hidden="true"></i> Show All Activities </p></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-poll-box text-success icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Active Staff</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $active_stuff }}</h3>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="nav-link"><p class="text-muted mt-3 mb-0">
                        <i class="mdi mdi-calendar mr-1" aria-hidden="true"></i> See All </p></a>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-account-location text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Inavtive Staff</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">{{ $inactive_staff }}</h3>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="nav-link"> <p class="text-muted mt-3 mb-0"><i class="mdi mdi-reload mr-1" aria-hidden="true"></i> See Active List </p></a>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <?php if(Auth::user()->user_type == "ADMIN"){ ?>
                    <div class="row">
                        <div class="col-lg-12">
                            Current Location <br/><br/>
                            <div id="map" style="width: 500px; height: 400px;"></div>
                        </div>
                    </div>
                    <?php 
                    }
                    else{
                    ?>
                    Activity List 
                    <br/><br/>
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
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
                              <td>
                                <?php echo date("Y-m-d", strtotime($activity->created_at)); ?>
                              </td>
                              <td>{{ $activity->name }}</td>
                              <td>{{ $activity->visited_area }}</td>
                              <td>{{ $activity->no_of_visited_pharmacy }}</td>
                              <td>{{ $activity->no_of_depot }}</td>
                              <td>{{ $activity->no_of_identified_pharmacy_without_license }}</td>
                              <td>{{ $activity->no_of_identified_not_renewed_license }}</td>
                              <td>{{ $activity->no_of_sample_collected }}</td>
                              <td>
                                <button type="button" data-toggle="modal" data-target="#DetailsModal_<?php echo $activity->id; ?>" class="btn btn-success btn-fw">Details</button>
                                <div class="modal fade" id="DetailsModal_<?php echo $activity->id; ?>" tabindex="-1" role="dialog" aria-labelledby="DetailsModal_<?php echo $activity->id; ?>" aria-hidden="true">
                                  <div class="modal-dialog custom-dialog-position" role="document">
                                    <div class="modal-content custom-modal-size">
                                      <div class="modal-header">
                                        <h5 class="modal-title">Details (Added by {{ $activity->name }} | Date: <?php echo date("Y-m-d", strtotime($activity->created_at)); ?>)</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      <div class="modal-body">
                                          <div class="card">
                                            <div class="card-body">
                                              <ul class="list-star">
                                                <li>Visited Area: {{ $activity->visited_area }}</li>
                                                <li>No. of Visited Pharmacy: {{ $activity->no_of_visited_pharmacy }}</li>
                                                <li>No. of depot: {{ $activity->no_of_depot }}</li>
                                                <li>No. of identified pharmacy without license: {{ $activity->no_of_identified_pharmacy_without_license }}</li>
                                                <li>No. of identified not renewed license: {{ $activity->no_of_identified_not_renewed_license }}</li>
                                                <li>No. of sample collected: {{ $activity->no_of_sample_collected }}</li>
                                                <li><b>Description of seized medicine:</b></li>
                                                <table>
                                                  <tr>
                                                    <td>Unregistered drug</td>
                                                    <td>{{ $activity->unregistered_drug ? "Yes" : "No" }}</td>
                                                    <td>Unregistered drug name</td>
                                                    <td>{{ $activity->unregistered_drug_name }}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Misbranded drug</td>
                                                    <td>{{ $activity->misbranded_drug ? "Yes" : "No" }}</td>
                                                    <td>Government medicine</td>
                                                    <td>{{ $activity->government_medicine ? "Yes" : "No"  }}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Physician sample</td>
                                                    <td>{{ $activity->physician_sample ? "Yes" : "No" }}</td>
                                                    <td>Food supplement</td>
                                                    <td>{{ $activity->food_supplement ? "Yes" : "No"  }}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Expired medicine</td>
                                                    <td>{{ $activity->expired_medicine ? "Yes" : "No" }}</td>
                                                    <td>Imitated medicine</td>
                                                    <td>{{ $activity->imitated_medicine ? "Yes" : "No"  }}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Spurious drug</td>
                                                    <td>{{ $activity->spurious_drug ? "Yes" : "No" }}</td>
                                                    <td>Seized medicine</td>
                                                    <td>{{ $activity->seized_medicine_others ? "Yes" : "No"  }}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Others name</td>
                                                    <td>{{ $activity->seized_medicine_others_name }}</td>
                                                    <td></td>
                                                    <td></td>
                                                  </tr>
                                                </table>
                                                <table>
                                                  <tr>
                                                    <td>Name of the visited pharmaceutical company</td>
                                                    <td>{{ $activity->name_of_the_visited_pharmaceutical_company }}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>No. of the visited pharmaceutical company</td>
                                                    <td>{{ $activity->no_of_the_visited_pharmaceutical_company }}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Approved model pharmacy</td>
                                                    <td>{{ $activity->approved_model_pharmacy }}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Approved medicine shop</td>
                                                    <td>{{ $activity->approved_medicine_shop }}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>No of pharmacy completely ready to be approved as model pharmacy</td>
                                                    <td>{{ $activity->no_of_pharmacy_completely_ready_to_be_approved_as_model_pharmacy }}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>No of pharmacy completely ready to be approved as medicine shop</td>
                                                    <td>{{ $activity->no_of_pharmacy_completely_ready_to_be_approved_as_medicine_shop }}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Value of seized medicine</td>
                                                    <td>{{ $activity->value_of_seized_medicine }}</td>
                                                  </tr>
                                                </table>
                                                <li>
                                                  <?php 
                                                  if($activity->enforcement_information == "Mobile_Court"){
                                                    ?> <img src="files/mobile_court/<?php echo $activity->mobile_court_case_paper; ?>" width="100%" alt="FingurePrint"  class="img-rounded user_image_shadow user-img-center"> <?php
                                                  }elseif($activity->enforcement_information == "Magistrate_Court"){
                                                    ?> <img src="files/magistrate_court/<?php echo $activity->magistrate_court_case_paper; ?>" width="100%" alt="FingurePrint"  class="img-rounded user_image_shadow user-img-center"> <?php
                                                  }elseif($activity->enforcement_information == "Drug_Court"){
                                                    ?> <img src="files/drug_court/<?php echo $activity->drug_court_case_paper; ?>" width="100%" alt="FingurePrint"  class="img-rounded user_image_shadow user-img-center"> <?php
                                                  }else{
                                                    echo "No Case Paper Uploaded!";
                                                  }
                                                  ?>
                                                </li>
                                                
                                              </ul>
                                            </div>
                                          </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </td>
                            </tr>
                          <?php 
                          endforeach; 
                          ?>
                          
                        </tbody>
                    </table>
                    
                    <?php
                    }
                    ?>
                    
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
        $("#home").addClass("active");
    
        //Get GEO Location
        var x = document.getElementById("demo");
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
        function showPosition(position) {
            x.innerHTML = "Latitude: " + position.coords.latitude + 
            "<br>Longitude: " + position.coords.longitude;
        }
        //end of GEO Location

        //get location via google map
        if (navigator.geolocation) { 
            navigator.geolocation.getCurrentPosition(function(position) {  
                var point = new google.maps.LatLng(position.coords.latitude, 
                                                position.coords.longitude);
                // Initialize the Google Maps API v3
                var map = new google.maps.Map(document.getElementById('map'), {
                zoom: 15,
                center: point,
                mapTypeId: google.maps.MapTypeId.ROADMAP
                });
                // Place a marker
                new google.maps.Marker({
                position: point,
                map: map
                });
                
                
                google.maps.event.addListener(map, 'click', function (event) {
                    //alert(event.latLng);          
                    geocoder.geocode({
                        'latLng': event.latLng
                    }, function (results, status) {
                        console.log(results);
                        // if (status ==
                        //     google.maps.GeocoderStatus.OK) {
                        //     if (results[1]) {
                        //         alert(results[1].formatted_address);
                        //     } else {
                        //         alert('No results found');
                        //     }
                        // } else {
                        //     alert('Geocoder failed due to: ' + status);
                        // }
                    });
                }); 
                //google.maps.event.addDomListener(window, 'load', initialize);



            }); 
        } 
        else {
            alert('W3C Geolocation API is not available');
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

        th, td {
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

        .custom-dialog-position{
            left: -100px !important;
        }
    </style>
</div> 
@endsection
