@extends('layouts.master') 
@section('content') 
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0/dist/Chart.min.js"></script>
<div class="content-wrapper">
<?php if(Auth::user()->user_type == "ADMIN" || Auth::user()->user_type == "MEETING"){ ?>
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
        <div class="col-xl-3 col-lg-3 col-md-3 col-sm-6 grid-margin stretch-card">
            <div class="card card-statistics">
                <div class="card-body">
                    <div class="clearfix">
                        <div class="float-left">
                            <i class="mdi mdi-account-location text-info icon-lg"></i>
                        </div>
                        <div class="float-right">
                            <p class="mb-0 text-right">Meeting Minutes</p>
                            <div class="fluid-container">
                                <h3 class="font-weight-medium text-right mb-0">0</h3>
                            </div>
                        </div>
                    </div>
                    <a href="#" class="nav-link"> <p class="text-muted mt-3 mb-0"><i class="mdi mdi-reload mr-1" aria-hidden="true"></i> Meeting Minutes </p></a>
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
                        <div class="col-lg-4">
                            Current Location <br/><br/>
                            <div id="map" style="width: 400px; height: 390px;"></div>
                        </div>
                        <div class="col-lg-8">
                            <div class="chart-container" style="position: relative; height:40vh; width:49vw">
                                <canvas id="myChart" style="height:40vh; width:49vw"></canvas>
                            </div>
                            <div style="background-color: #d9edfc; width: 150px; text-align: center; margin: 20px; padding-top: 13px; display: inline-block;">
                                <p>Active User</p>
                            </div>
                            <div style="background-color: #ffe1e6; width: 150px; text-align: center; margin: 20px; padding-top: 13px; display: inline-block;">
                                <p>Inactive User</p>
                            </div>
                        </div>
                    </div>
                    <?php 
                    }
                    else{
                    ?>
                    Activity List 
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
                          $count = 0;
                          foreach ($activities as $activity):
                          $count++;
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
                                <button type="button" data-toggle="modal" <?php if($activity->lat){ ?> onclick="setGEOLocation(<?php echo $activity->id; ?>, <?php echo $activity->lat; ?>, <?php echo $activity->long; ?>)" <?php } ?> data-target="#DetailsModal_<?php echo $activity->id; ?>" class="btn btn-success btn-fw">Details</button>
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
                                              <p class="float-right">Lat: {{ $activity->lat }} | Long: {{ $activity->long }}</p>
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
                                                    <td>No. of pharmacy completely ready to be approved as model pharmacy</td>
                                                    <td>{{ $activity->no_of_pharmacy_completely_ready_to_be_approved_as_model_pharmacy }}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>No. of pharmacy completely ready to be approved as medicine shop</td>
                                                    <td>{{ $activity->no_of_pharmacy_completely_ready_to_be_approved_as_medicine_shop }}</td>
                                                  </tr>
                                                  <tr>
                                                    <td>Value of seized medicine</td>
                                                    <td>{{ $activity->value_of_seized_medicine }}</td>
                                                  </tr>
                                                </table>
                                                <?php 
                                                if($activity->enforcement_information == "Mobile_Court"){
                                                ?> 
                                                <br/><li> <strong>Mobile Court Information</strong></li>
                                                <br/> 
                                                <table>
                                                    <tr>
                                                        <td>Company name & address</td>
                                                        <td>{{ $activity->mobile_court_company_name_address }}</td>
                                                        <td>Pharmacy name & address</td>
                                                        <td>{{ $activity->mobile_court_pharmacy_name_address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No. of cases filed</td>
                                                        <td>{{ $activity->mobile_court_no_of_cases_filed }}</td>
                                                        <td>No. of convicted person</td>
                                                        <td>{{ $activity->mobile_court_no_of_convicted_person }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Fine amount</td>
                                                        <td>{{ $activity->mobile_court_fine_amount }}</td>
                                                        <td>No. of court jail</td>
                                                        <td>{{ $activity->mobile_court_jail }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Value of seized medicine</td>
                                                        <td colspan="3">{{ $activity->mobile_court_value_of_seized_medicine }}</td>
                                                    </tr>
                                                </table>
                                                <img src="files/mobile_court/<?php echo $activity->mobile_court_case_paper; ?>" width="100%" alt="FingurePrint"  class="img-rounded user_image_shadow user-img-center"> 
                                                <?php
                                                }elseif($activity->enforcement_information == "Magistrate_Court"){
                                                ?> 
                                                <br/><li> <strong>Magistrate Court Information</strong></li><br/> 
                                                <table>
                                                    <tr>
                                                        <td>Company name & address</td>
                                                        <td>{{ $activity->magistrate_court_company_name_address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No. of cases filed</td>
                                                        <td>{{ $activity->magistrate_court_no_of_case_filed }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Case no.</td>
                                                        <td>{{ $activity->magistrate_court_case_no }}</td>
                                                    </tr>
                                                </table>
                                                <img src="files/magistrate_court/<?php echo $activity->magistrate_court_case_paper; ?>" width="100%" alt="FingurePrint"  class="img-rounded user_image_shadow user-img-center"> 
                                                <?php
                                                }elseif($activity->enforcement_information == "Drug_Court"){
                                                ?> 
                                                <br/><li><strong>Drug Court Information</strong></li><br/> 
                                                <table>
                                                    <tr>
                                                        <td>Company name & address</td>
                                                        <td>{{ $activity->drug_court_company_name_address }}</td>
                                                        <td>Pharmacy name & address</td>
                                                        <td>{{ $activity->drug_court_pharmacy_name_address }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Substandard drug</td>
                                                        <td>{{ $activity->drug_court_substandard_drug ? 'Yes' : 'No' }}</td>
                                                        <td>Unregistered drug</td>
                                                        <td>{{ $activity->drug_court_unregistered_drug ? 'Yes' : 'No'  }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Govt. medicine</td>
                                                        <td>{{ $activity->drug_court_govt_medicine ? 'Yes' : 'No' }}</td>
                                                        <td>Adulterated/spurious/misbranded</td>
                                                        <td>{{ $activity->drug_court_adulterated_spurious_misbranded ? 'Yes' : 'No'  }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Unauthorized raw material</td>
                                                        <td>{{ $activity->drug_court_unauthorized_raw_material ? 'Yes' : 'No' }}</td>
                                                        <td>Over pricing</td>
                                                        <td>{{ $activity->drug_court_over_pricing ? 'Yes' : 'No'  }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Illegal advertisement</td>
                                                        <td>{{ $activity->drug_court_illegal_advertisement ? 'Yes' : 'No' }}</td>
                                                        <td>Not registered</td>
                                                        <td>{{ $activity->drug_court_not_registered ? 'Yes' : 'No'  }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Others</td>
                                                        <td>{{ $activity->drug_court_others ? 'Yes' : 'No' }}</td>
                                                        <td>Case no with date</td>
                                                        <td>{{ $activity->drug_court_case_no_with_date }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Description</td>
                                                        <td colspan="3">{{ $activity->drug_court_description }}</td>
                                                    </tr>
                                                </table>
                                                <img src="files/drug_court/<?php echo $activity->drug_court_case_paper; ?>" width="100%" alt="FingurePrint"  class="img-rounded user_image_shadow user-img-center"> 
                                                <?php
                                                }else{
                                                echo "No Case Paper Uploaded!";
                                                }
                                                ?>
                                                <br/><br/><li> <strong>Official Activities</strong></li><br/>
                                                <table>
                                                    <tr>
                                                        <td>No. of new drug licenses issued</td>
                                                        <td>{{ $activity->official_no_of_new_drug_licenses_issued }}</td>
                                                        <td>No. of new drug licenses calncelled</td>
                                                        <td>{{ $activity->official_no_of_drug_licenses_calncelled }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No. of drug licenses transfer in</td>
                                                        <td>{{ $activity->official_no_of_drug_licenses_transfer_in }}</td>
                                                        <td>No. of drug licenses transfer out</td>
                                                        <td>{{ $activity->official_no_of_drug_licenses_transfer_out }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total No. of drug license</td>
                                                        <td>{{ $activity->official_total_no_of_drug_licenses }}</td>
                                                        <td>No. of drug licenses renewed</td>
                                                        <td>{{ $activity->official_no_of_drug_license_renewed }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No. of drug licenses ownership transferred</td>
                                                        <td>{{ $activity->official_no_of_drug_license_ownership_transferred }}</td>
                                                        <td>No. of drug licenses address changed</td>
                                                        <td>{{ $activity->official_no_of_drug_license_address_changed }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Total revenue receipt</td>
                                                        <td>{{ $activity->official_total_revenue_receipt }}</td>
                                                        <td>No. of sample sent</td>
                                                        <td>{{ $activity->official_no_of_sample_sent }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>No. of test report received</td>
                                                        <td>{{ $activity->official_no_of_test_report_received }}</td>
                                                        <td>No. of substandard drugs</td>
                                                        <td>{{ $activity->official_no_of_substandard_drugs }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Description of substandard drugs</td>
                                                        <td colspan="3">{{ $activity->official_description_of_substandard_drugs }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Others</td>
                                                        <td>{{ $activity->official_others }}</td>
                                                        <td>Sealed</td>
                                                        <td>{{ $activity->official_sealed }}</td>
                                                    </tr>
                                                </table>
                                              </ul>
                                              <div class="col-lg-12">
                                                    <?php if($activity->lat){ ?>
                                                        <div id="map_<?php echo $activity->id; ?>" style="width: 100%; height: 350px;"></div>
                                                    <?php }else{ echo "No data found! Probably your location service was disabled!"; } ?>
                                              </div>
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
                          
                          if(!$count){
                            ?> 
                            <tr>
                                <td colspan="9">No Activity Found</td>
                            </tr>
                            <?php
                          }
                          ?>
                          
                        </tbody>
                    </table>
                    
                    <br><br>
                      Actions/Decisions List 
                      <table>
                        <thead>
                          <tr>
                            <th>SL#</th>
                            <th>New Actions/Decisions</th>
                            <th>Responsibilities</th>
                            <th>Dateline</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                          <tr>
                              <td>1.</td>
                              <td>ভলেন্টারি রিকল করলে ঔষূধ প্রশাশন কে জানাতে হবে</td>
                              <td>আমদানিকারি প্রতিষ্ঠান</td>
                              <td>2019-07-20</td>
                              <td>
                                <button type="button" class="btn btn-primary btn-rounded btn-fw">On Going</button>
                              </td>
                          </tr>
                          <tr>
                              <td>2.</td>
                              <td>বিভিন্ন মিডিয়ায় বিজ্ঞপ্তি প্রকাশ করতে হবে </td>
                              <td>আমদানিকারি প্রতিষ্ঠান</td>
                              <td>2019-07-03</td>
                              <td>
                                <button type="button" class="btn btn-danger btn-rounded btn-fw">Not Done</button>
                              </td>
                          </tr>
                          <tr>
                              <td>3.</td>
                              <td>পোস্ট মার্কেটিং সারভিলাঞ্চ সংক্রান্ত কার্যাদি পরিচালনা করার বাবস্থা থাকতে হবে</td>
                              <td>আমদানিকারি প্রতিষ্ঠান</td>
                              <td>2019-07-10</td>
                              <td>
                                <button type="button" class="btn btn-success btn-rounded btn-fw">Done</button>
                              </td>
                          </tr>
                          <tr>
                              <td>4.</td>
                              <td>মতামতের ভিত্তিতে গাইড লাইন টি চূড়ান্ত করতে হবে  </td>
                              <td>আমদানিকারি প্রতিষ্ঠান</td>
                              <td>2019-07-02</td>
                              <td>
                                <button type="button" class="btn btn-warning btn-rounded btn-fw">Attempted</button>
                              </td>
                          </tr>
                          <tr>
                              <td>5.</td>
                              <td>প্রডাক্ট রিকল ডিপো / ফার্মাসি / প্যাশেন্ট লেভেল পর্যন্ত থাকতে হবে</td>
                              <td>আমদানিকারি প্রতিষ্ঠান</td>
                              <td>2019-07-17</td>
                              <td>
                                <button type="button" class="btn btn-primary btn-rounded btn-fw">On Going</button>
                              </td>
                          </tr>
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
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © 2019 <a href="#"
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

        $(function () {
            var ctx = document.getElementById("myChart").getContext('2d');
            const months = ["JAN", "FEB", "MAR","APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OCT", "NOV", "DEC"];
            var current_datetime = new Date();
            var formatted_date = current_datetime.getDate() + "-" + months[current_datetime.getMonth()] + "-" + current_datetime.getFullYear();

            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: [formatted_date, formatted_date],
                    datasets: [{
                        label: 'Today\'s user activities',
                        data: [<?php echo $inactive_staff; ?>, <?php echo $active_stuff; ?>],
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    },
                    color: [
                        'green',  // color for data at index 2
                        'black',  // color for data at index 3
                    ]
                }
            });
        });

        function setGEOLocation(map_id, lat, long){
          if(lat){
            var point = new google.maps.LatLng(lat, long);
            // Initialize the Google Maps API v3
            var map = new google.maps.Map(document.getElementById("map_"+map_id), {
                zoom: 15,
                center: point,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            });
            // Place a marker
            new google.maps.Marker({
                position: point,
                map: map
            });
          }
        };
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
