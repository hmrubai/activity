@extends('layouts.master') 
@section('content') 
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body"> 
                    <div class="row">
                        <div class="col-lg-12">
                            @if(session('success')) 
                              <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <strong>Congrats! </strong> {{session('success')}} 
                              </div>
                              <script>
                                  Swal.fire({
                                      position: 'top-end',
                                      type: 'success',
                                      title: 'The Data has been added successful.',
                                      showConfirmButton: false,
                                      timer: 5000
                                  });
                              </script> 
                            @endif 
                          <form action="{{ route('saveDailyActivity') }}" class="form-horizontal" data-toggle="validator" role="form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                            @csrf
                            Entry Daily Activity 
                            <table class="table table-striped table-bordered">
                              <tbody>
                                <tr>
                                    <td colspan="2" style="background: #358253; text-align: center; font-size: 20px; color: #ffffff;">
                                      Daily Activity
                                    </td>
                                </tr>
                                <tr>
                                    <td class="col-md-12" colspan="2" style="text-align:center; background-color:#eeeeee;">
                                        <strong>Visited Information</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 30%" onclick="getLocationValue()">Visited area</td>
                                    <td style="width: 70%">
                                      <input type="text" name="latitude" id="latitude" value="0" hidden/>
                                      <input type="text" name="longitude" id="longitude" value="0" hidden/>
                                      <input name="visited_area" type="text" required="required" placeholder="Visited area" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>No. of visited pharmacy</td>
                                    <td>
                                        <select class="form-control form-control-lg" required="required" name="no_of_visited_pharmacy" id="no_of_visited_pharmacy">
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                          <option value="4">4</option>
                                          <option value="5">5</option>
                                          <option value="6">6</option>
                                          <option value="7">7</option>
                                          <option value="8">8</option>
                                          <option value="9">9</option>
                                          <option value="10">10</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td>No. of depot</td>
                                    <td>
                                      <input type="number" name="no_of_depot" placeholder="No. of depot" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>No. of identified pharmacy without license</td>
                                    <td>
                                      <input type="number" name="no_of_identified_pharmacy_without_license" placeholder="No. of identified pharmacy without license" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>No. of identified not renewed license</td>
                                    <td>
                                      <input type="number" name="no_of_identified_not_renewed_license" placeholder="No. of identified not renewed license" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>No. of sample collected</span></td>
                                    <td>
                                      <input type="number" name="no_of_sample_collected" placeholder="No. of sample collected" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td  colspan="2">
                                        <table class="table-responsive">
                                          <tr>
                                            <td>
                                                Description of seized medicine
                                            </td>
                                            <td class="col-lg-12">
                                                <table  class="table-responsive"  cellpadding="1" cellspacing="1">
                                                    <tr>
                                                        <td style="width:20%"><span>Unregistered drug</span></td>
                                                        <td style="width:20%">
                                                          <input name="unregistered_drug" class="entrytrueonly" type="checkbox">
                                                        </td>
                                                        <td style="width:20%"><span>Unregistered drug Name</span></td>
                                                        <td style="width:40%"><input name="unregistered_drug_name" placeholder="Unregistered drug Name" type="text" class="entryfield form-control">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Misbranded drug</span></td>
                                                        <td><input name="misbranded_drug" class="entrytrueonly" type="checkbox">
                                                        </td>
                                                        <td><span>Government medicine</span></td>
                                                        <td>
                                                          <input name="government_medicine" class="entrytrueonly" type="checkbox">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Physician sample</span></td>
                                                        <td>
                                                          <input name="physician_sample" class="entrytrueonly" type="checkbox">
                                                        </td>
                                                        <td><span>Food supplement</span></td>
                                                        <td>
                                                          <input name="food_supplement" class="entrytrueonly" type="checkbox">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Expired medicine</span></td>
                                                        <td><input name="expired_medicine" class="entrytrueonly" type="checkbox">
                                                        </td>
                                                        <td><span>Imitated medicine</span></td>
                                                        <td>
                                                          <input name="imitated_medicine" class="entrytrueonly" type="checkbox">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>Spurious&nbsp;<span>drug</span></td>
                                                        <td>
                                                          <input name="spurious_drug" class="entrytrueonly" type="checkbox">
                                                        </td>
                                                        <td><span>Others</span></td>
                                                        <td>
                                                          <input name="seized_medicine_others" class="entrytrueonly" type="checkbox">
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><span>Other Name</span></td>
                                                        <td colspan="4">
                                                          <input type="text" name="seized_medicine_others_name" placeholder="Other Name" class="entryfield form-control">
                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                          </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Name of the visited pharmaceutical company</td>
                                    <td>
                                      <input type="text" name="name_of_the_visited_pharmaceutical_company" placeholder="Name of the visited pharmaceutical company" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>No. of the visited pharmaceutical company</td>
                                    <td><input type="number" name="no_of_the_visited_pharmaceutical_company" placeholder="No. of the visited pharmaceutical company" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Approved model pharmacy</td>
                                    <td>
                                      <input type="number" name="approved_model_pharmacy" placeholder="Approved model pharmacy" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Approved medicine shop</td>
                                    <td>
                                      <input type="number" name="approved_medicine_shop" placeholder="Approved medicine shop" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>No of pharmacy completely ready to be approved as model pharmacy<br>
                                    </td>
                                    <td>
                                      <input type="number" name="no_of_pharmacy_completely_ready_to_be_approved_as_model_pharmacy" placeholder="No of pharmacy completely ready to be approved as model pharmacy" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>No of pharmacy completely ready to be approved as medicine shop</td>
                                    <td>
                                      <input type="number" name="no_of_pharmacy_completely_ready_to_be_approved_as_medicine_shop" placeholder="No of pharmacy completely ready to be approved as medicine shop" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Value of seized medicine</td>
                                    <td>
                                      <input type="text" name="value_of_seized_medicine" placeholder="Value of seized medicine" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Enforcement Information</td>
                                    <td>
                                        <select class="form-control form-control-lg" name="enforcement_information" onchange="changeValueForm(this.value)" id="enforcement_information">
                                          <option value="">-- Select None --</option>
                                          <option value="Mobile_Court">Mobile Court</option>
                                          <option value="Magistrate_Court">Magistrate Court</option>
                                          <option value="Drug_Court">Drug Court</option>
                                        </select>
                                    </td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="table table-striped table-bordered" id="Mobile_Court" style="display:none;">
                              <tbody>
                                <!------->
                                <tr>
                                    <td colspan="2" style="text-align:center; background-color:#eeeeee;">
                                        <b>Mobile Court</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Company name &amp; address</td>
                                    <td>
                                      <input type="text" name="mobile_court_company_name_address" placeholder="Company name & address" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pharmacy name &amp; address</td>
                                    <td>
                                      <input type="text" name="mobile_court_pharmacy_name_address" placeholder="Pharmacy name & address" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>No. of cases filed</td>
                                    <td>
                                      <input type="number" name="mobile_court_no_of_cases_filed" placeholder="No. of cases filed" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>No. of convicted person</td>
                                    <td><input type="number" name="mobile_court_no_of_convicted_person" placeholder="No. of convicted person" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td style="text-align:left;"><strong>Punishment</strong></td>
                                </tr>
                                <tr>
                                    <td>Fine amount</td>
                                    <td>
                                      <input type="number" name="mobile_court_fine_amount" placeholder="Fine amount" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jail</td>
                                    <td>
                                      <input type="number" name="mobile_court_jail" placeholder="Jail" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Value of seized medicine</td>
                                    <td>
                                      <input type="number" name="mobile_court_value_of_seized_medicine" placeholder="Value of seized medicine" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Case Paper</td>
                                    <td>
                                      <input type="file" id="mobile_court_case_paper" class="form-control" placeholder="Case Paper" name="mobile_court_case_paper">
                                      <span class="help-block red" style="font-size:12px;">Only .pdf, .jpg, .png, .jpeg file and max file size 10MB</span>
                                    </td>
                                </tr>
                                <!------->
                              </tbody>
                            </table>
                            <table class="table table-striped table-bordered" id="Magistrate_Court" style="display:none;">
                              <tbody>
                                <tr>
                                    <td class="col-md-12" colspan="2" style="text-align:center; background-color:#eeeeee;">
                                        <b>Magistrate Court</b>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pharmacy name &amp; address</td>
                                    <td>
                                      <input type="text" name="magistrate_court_company_name_address" placeholder="Pharmacy name & address" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td><span style="line-height: 18.5714px;">No. of case filed</span></td>
                                    <td>
                                      <input type="number" name="magistrate_court_no_of_case_filed" placeholder="No. of case filed" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td><span style="line-height: 18.5714px;">Case No.</span></td>
                                    <td><input type="number" name="magistrate_court_case_no" placeholder="Case No." class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Case Paper</td>
                                    <td>
                                      <input type="file" id="magistrate_court_case_paper" class="form-control" placeholder="Case Paper" name="magistrate_court_case_paper">
                                      <span class="help-block red" style="font-size:12px;">Only .pdf, .jpg, .png, .jpeg file and max file size 10MB</span>
                                    </td>
                                </tr>
                                <!------->
                              </tbody>
                            </table>
                            <table class="table table-striped table-bordered" id="Drug_Court" style="display:none;">
                              <tbody>
                                <tr>
                                    <td class="col-md-12" colspan="2" style="text-align:center; background-color:#eeeeee;">
                                        <b>Drug Court</b></td>
                                </tr>
                                <tr>
                                    <td>Company name &amp; address</td>
                                    <td>
                                      <input type="text" name="drug_court_company_name_address" placeholder="Company name & address" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Pharmacy name &amp; address</td>
                                    <td>
                                      <input type="text" name="drug_court_pharmacy_name_address" placeholder="Pharmacy name & address" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Nature of the case filed</td>
                                    <td>
                                        <table border="1" cellpadding="1" cellspacing="1" style="width:800px;">
                                            <tbody>
                                                <tr>
                                                    <td><span style="line-height: 18.5714px; background-color: rgb(249, 249, 249);">Substandard drug </span></td>
                                                    <td>
                                                      <input name="drug_court_substandard_drug" class="entrytrueonly" type="checkbox">
                                                    </td>
                                                    <td><span style="line-height: 18.5714px; background-color: rgb(249, 249, 249);">Unregistered drug</span></td>
                                                    <td>
                                                      <input name="drug_court_unregistered_drug" class="entrytrueonly" type="checkbox">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span style="line-height: 18.5714px; background-color: rgb(249, 249, 249);">Govt. medicine</span></td>
                                                    <td>
                                                      <input name="drug_court_govt_medicine" class="entrytrueonly" type="checkbox">
                                                    </td>
                                                    <td>Adulterated/spurious/Misbranded</td>
                                                    <td>
                                                      <input name="drug_court_adulterated_spurious_misbranded" class="entrytrueonly" type="checkbox">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                      <span style="line-height: 18.5714px; background-color: rgb(249, 249, 249);">Unauthorized raw material</span>
                                                    </td>
                                                    <td>
                                                      <input name="drug_court_unauthorized_raw_material" class="entrytrueonly" type="checkbox">
                                                    </td>
                                                    <td><span style="line-height: 18.5714px; background-color: rgb(249, 249, 249);">Over pricing</span></td>
                                                    <td>
                                                      <input name="drug_court_over_pricing" class="entrytrueonly" type="checkbox">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span style="line-height: 18.5714px; background-color: rgb(249, 249, 249);">Illegal Advertisement</span></td>
                                                    <td>
                                                      <input name="drug_court_illegal_advertisement" class="entrytrueonly" type="checkbox">
                                                    </td>
                                                    <td>
                                                      <span style="line-height: 18.5714px; background-color: rgb(249, 249, 249);">Not registered </span>
                                                    </td>
                                                    <td>
                                                      <input name="drug_court_not_registered" class="entrytrueonly" type="checkbox">
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><span style="line-height: 18.5714px; background-color: rgb(249, 249, 249);">Others</span>
                                                    </td>
                                                    <td>
                                                      <input name="drug_court_others" class="entrytrueonly" type="checkbox">
                                                    </td>
                                                    <td>
                                                      <span style="line-height: 18.5714px; background-color: rgb(249, 249, 249);">Description</span>
                                                    </td>
                                                    <td colspan="4">
                                                      <input type="text" name="drug_court_description" class="entryfield form-control">
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td><span style="line-height: 18.5714px;">No. of case filed</span></td>
                                    <td><input type="number" name="drug_court_no_of_case_filed" placeholder="No. of case filed" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td><span>Case No. with Date</span></td>
                                    <td><input type="text" name="drug_court_case_no_with_date" placeholder="Case No. with Date" class="entryfield form-control">
                                    </td>
                                </tr>
                                <tr>
                                    <td>Case Paper</td>
                                    <td>
                                      <input type="file" id="drug_court_case_paper" class="form-control" placeholder="Case Paper" name="drug_court_case_paper">
                                      <span class="help-block red" style="font-size:12px;">Only .pdf, .jpg, .png, .jpeg file and max file size 10MB</span>
                                    </td>
                                </tr>
                              </tbody>
                            </table>
                            <table class="table table-striped table-bordered">
                              <tbody>
                                <!------->
                                <tr>
                                  <td class="col-md-12" colspan="2" style="text-align:center; background-color:#eeeeee;">
                                    <b>Official Activities</b>
                                  </td>
                                </tr>
                                <tr>
                                  <td colspan="2">
                                    <table style="width:100%;">
                                        <tbody>
                                            <tr>
                                                <td style="width: 25%">No. of new drug licenses issued</td>
                                                <td style="width: 25%">
                                                  <input type="number" name="official_no_of_new_drug_licenses_issued"  id="official_no_of_new_drug_licenses_issued" value="0" onkeyup="calculateDrugLicense()" placeholder="No. of new drug licenses issued" class="entryfield form-control">
                                                </td>
                                                <td style="width: 25%">No. of drug licenses calncelled</td>
                                                <td style="width: 25%">
                                                  <input type="number" name="official_no_of_drug_licenses_calncelled" id="official_no_of_drug_licenses_calncelled" value="0" onkeyup="calculateDrugLicense()" placeholder="No. of drug licenses calncelled" class="entryfield form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>No. of drug licenses Transfer In</td>
                                                <td>
                                                  <input type="number" name="official_no_of_drug_licenses_transfer_in" id="official_no_of_drug_licenses_transfer_in" value="0" onkeyup="calculateDrugLicense()" placeholder="No. of drug licenses Transfer In" class="entryfield form-control">
                                                </td>
                                                <td>No. of drug licenses Transfer Out</td>
                                                <td>
                                                  <input type="number" name="official_no_of_drug_licenses_transfer_out" id="official_no_of_drug_licenses_transfer_out" value="0" onkeyup="calculateDrugLicense()" placeholder="No. of drug licenses Transfer out" class="entryfield form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Total No. of drug license</b></td>
                                                <td colspan="3">
                                                  <input type="number" name="official_total_no_of_drug_licenses" id="official_total_no_of_drug_licenses" placeholder="Total No. of drug license" class="indicator form-control" readonly>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>No. of drug license renewed</td>
                                                <td>
                                                  <input type="number" name="official_no_of_drug_license_renewed" placeholder="No. of drug license renewed" class="entryfield form-control">
                                                </td>
                                                <td><span>No. of drug license ownership transferred</span></td>
                                                <td>
                                                  <input type="number" name="official_no_of_drug_license_ownership_transferred" class="entryfield form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span>No. of drug license address changed</span></td>
                                                <td>
                                                  <input type="number" name="official_no_of_drug_license_address_changed" placeholder="No. of drug license address changed" class="entryfield form-control">
                                                </td>
                                                <td>Total revenue receipt</td>
                                                <td>
                                                  <input type="text" name="official_total_revenue_receipt" placeholder="Total revenue receipt" class="entryfield form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>No. of sample(s) sent</td>
                                                <td>
                                                  <input type="number" name="official_no_of_sample_sent" placeholder="No. of sample(s) sent" class="entryfield form-control">
                                                </td>
                                                <td><span>No. of test report received </span></td>
                                                <td>
                                                  <input type="number" name="official_no_of_test_report_received" placeholder="No. of test report received" class="entryfield form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span>No. of substandard drugs</span></td>
                                                <td>
                                                  <input type="number" name="official_no_of_substandard_drugs" placeholder="No. of substandard drugs" class="entryfield form-control">
                                                </td>
                                                <td>
                                                  <span>Description of substandard drugs </span>
                                                </td>
                                                <td>
                                                  <input type="text" name="official_description_of_substandard_drugs" placeholder="Description of substandard drugs" class="entryfield form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Others</td>
                                                <td colspan="3">
                                                  <input type="text" name="official_others" placeholder="Others" class="entryfield form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>Sealed</td>
                                                <td colspan="3">
                                                  <input type="text" name="official_sealed" placeholder="Sealed" class="entryfield form-control">
                                                </td>
                                            </tr>
                                            <tr>
                                              <td></td>
                                              <td>
                                                  <button type="submit" class="btn btn-success btn-fw">Save</button>
                                              </td>
                                              <td>
                                                  <!--<button type="button" class="btn btn-info btn-fw">Preview</button>-->
                                              </td>
                                              <td></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                          </form>
                        </div>
                    </div>
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
        //Get GEO Location
        var x = document.getElementById("demo");
        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition);
            } else { 
                //x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }
        function showPosition(position) {
            $('#latitude').val(position.coords.latitude);
            $('#longitude').val(position.coords.longitude);
        }
        //end of GEO Location

        getLocation();

        $("#entry_activity").addClass("active");

        function changeValueForm(form_name){
          if(form_name === 'Mobile_Court') {
            $("#Mobile_Court").show(500);
            $("#Magistrate_Court").hide(500);
            $("#Drug_Court").hide(500);
          }
          else if(form_name === 'Magistrate_Court'){
            $("#Magistrate_Court").show(500);
            $("#Mobile_Court").hide(500);
            $("#Drug_Court").hide(500);
          }
          else if(form_name === 'Drug_Court'){
            $("#Drug_Court").show(500);
            $("#Mobile_Court").hide(500);
            $("#Magistrate_Court").hide(500);
          }else{
            $("#Drug_Court").hide(500);
            $("#Mobile_Court").hide(500);
            $("#Magistrate_Court").hide(500);
          }
        }

        function calculateDrugLicense(){
          var total = parseInt($("#official_no_of_new_drug_licenses_issued").val()) + parseInt($("#official_no_of_drug_licenses_calncelled").val()) + parseInt($("#official_no_of_drug_licenses_transfer_in").val()) + parseInt($("#official_no_of_drug_licenses_transfer_out").val());
          console.log(total);
          $("#official_total_no_of_drug_licenses").val(total);
        }
    </script>
</div> @endsection
