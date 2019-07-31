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
                                      <h5 class="modal-title"> Added by {{ $activity->name }} | Date: <?php echo date("Y-m-d", strtotime($activity->created_at)); ?></h5>
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

        .custom-modal-size{
          width: 700px !important;
        }

        .custom-dialog-position{
          left: -100px !important;
        }
    </style>
</div> 
@endsection
