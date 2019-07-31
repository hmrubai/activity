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
