<?php

namespace App\Http\Controllers;

use App\DailyActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailyActivityController extends Controller
{
    public function index()
    {}

    public function getAllList()
    {
        $activities = DailyActivity::select('daily_activities.*', 'users.name')->leftjoin('users', 'users.id', '=', 'daily_activities.user_id')->orderBy('daily_activities.id', 'desc')->get();
        return view('activityList', compact('activities'));
    }

    public function saveDailyActivity(Request $request)
    {
        $this->validate($request, [
            'visited_area'          => 'required',
            'no_of_visited_pharmacy'=> 'required',
        ]);

        $addActivity = new DailyActivity();
        $addActivity->user_id                                   = Auth::user()->id;
        $addActivity->visited_area                              = $request->visited_area;
        $addActivity->no_of_visited_pharmacy                    = $request->no_of_visited_pharmacy;
        $addActivity->no_of_depot                               = $request->no_of_depot;
        $addActivity->no_of_identified_pharmacy_without_license = $request->no_of_identified_pharmacy_without_license;
        $addActivity->no_of_identified_not_renewed_license      = $request->no_of_identified_not_renewed_license;
        $addActivity->no_of_sample_collected                    = $request->no_of_sample_collected;
        $addActivity->unregistered_drug                         = $request->unregistered_drug ? true : false;
        $addActivity->unregistered_drug_name                    = $request->unregistered_drug_name;
        $addActivity->misbranded_drug                           = $request->misbranded_drug ? true : false;
        $addActivity->government_medicine                       = $request->government_medicine ? true : false;
        $addActivity->physician_sample                          = $request->physician_sample ? true : false;
        $addActivity->food_supplement                           = $request->food_supplement ? true : false;
        $addActivity->expired_medicine                          = $request->expired_medicine ? true : false;
        $addActivity->imitated_medicine                         = $request->imitated_medicine ? true : false;
        $addActivity->spurious_drug                             = $request->spurious_drug ? true : false;
        $addActivity->seized_medicine_others                    = $request->seized_medicine_others ? true : false;
        $addActivity->seized_medicine_others_name               = $request->seized_medicine_others_name;
        $addActivity->name_of_the_visited_pharmaceutical_company= $request->name_of_the_visited_pharmaceutical_company;
        $addActivity->no_of_the_visited_pharmaceutical_company  = $request->no_of_the_visited_pharmaceutical_company;
        $addActivity->approved_model_pharmacy                   = $request->approved_model_pharmacy;
        $addActivity->approved_medicine_shop                    = $request->approved_medicine_shop;
        $addActivity->no_of_pharmacy_completely_ready_to_be_approved_as_model_pharmacy  = $request->no_of_pharmacy_completely_ready_to_be_approved_as_model_pharmacy;
        $addActivity->no_of_pharmacy_completely_ready_to_be_approved_as_medicine_shop   = $request->no_of_pharmacy_completely_ready_to_be_approved_as_medicine_shop;
        $addActivity->value_of_seized_medicine                  = $request->value_of_seized_medicine;
        $addActivity->enforcement_information                   = $request->enforcement_information;
        
        if($request->enforcement_information == "Mobile_Court")
        {
            $addActivity->mobile_court_company_name_address     = $request->mobile_court_company_name_address;
            $addActivity->mobile_court_pharmacy_name_address    = $request->mobile_court_pharmacy_name_address;
            $addActivity->mobile_court_no_of_cases_filed        = $request->mobile_court_no_of_cases_filed;
            $addActivity->mobile_court_no_of_convicted_person   = $request->mobile_court_no_of_convicted_person;
            $addActivity->mobile_court_fine_amount              = $request->mobile_court_fine_amount;
            $addActivity->mobile_court_jail                     = $request->mobile_court_jail;
            $addActivity->mobile_court_value_of_seized_medicine = $request->mobile_court_value_of_seized_medicine;

            if($request->mobile_court_case_paper){
                $mobile_court_case_paper  =  'mobile_court_'.time().'.'.$request->mobile_court_case_paper->getClientOriginalExtension();
                $request->mobile_court_case_paper->move(public_path('files/mobile_court'), $mobile_court_case_paper);
            }else{ $mobile_court_case_paper  = ""; }

            $addActivity->mobile_court_case_paper   = $mobile_court_case_paper;
        }

        if($request->enforcement_information == "Magistrate_Court")
        {
            $addActivity->magistrate_court_company_name_address = $request->magistrate_court_company_name_address;
            $addActivity->magistrate_court_no_of_case_filed     = $request->magistrate_court_no_of_case_filed;
            $addActivity->magistrate_court_case_no              = $request->magistrate_court_case_no;

            if($request->magistrate_court_case_paper){
                $magistrate_court_case_paper  =  'magistrate_court_'.time().'.'.$request->magistrate_court_case_paper->getClientOriginalExtension();
                $request->magistrate_court_case_paper->move(public_path('files/magistrate_court'), $magistrate_court_case_paper);
            }else{ $magistrate_court_case_paper  = ""; }

            $addActivity->magistrate_court_case_paper   = $magistrate_court_case_paper;
        }

        if($request->enforcement_information == "Drug_Court")
        {
            $addActivity->drug_court_company_name_address           = $request->drug_court_company_name_address;
            $addActivity->drug_court_pharmacy_name_address          = $request->drug_court_pharmacy_name_address;
            $addActivity->drug_court_substandard_drug               = $request->drug_court_substandard_drug ? true : false;
            $addActivity->drug_court_unregistered_drug              = $request->drug_court_unregistered_drug ? true : false;
            $addActivity->drug_court_govt_medicine                  = $request->drug_court_govt_medicine ? true : false;
            $addActivity->drug_court_adulterated_spurious_misbranded= $request->drug_court_adulterated_spurious_misbranded ? true : false;
            $addActivity->drug_court_unauthorized_raw_material      = $request->drug_court_unauthorized_raw_material ? true : false;
            $addActivity->drug_court_over_pricing                   = $request->drug_court_over_pricing ? true : false;
            $addActivity->drug_court_illegal_advertisement          = $request->drug_court_illegal_advertisement ? true : false;
            $addActivity->drug_court_not_registered                 = $request->drug_court_not_registered ? true : false;
            $addActivity->drug_court_others                         = $request->drug_court_others ? true : false;
            $addActivity->drug_court_description                    = $request->drug_court_description;
            $addActivity->drug_court_case_no_with_date              = $request->drug_court_case_no_with_date;

            if($request->drug_court_case_paper){
                $drug_court_case_paper  =  'drug_court_'.time().'.'.$request->drug_court_case_paper->getClientOriginalExtension();
                $request->drug_court_case_paper->move(public_path('files/drug_court'), $drug_court_case_paper);
            }else{ $drug_court_case_paper  = ""; }

            $addActivity->drug_court_case_paper   = $drug_court_case_paper;
        }

        $addActivity->official_no_of_new_drug_licenses_issued           = $request->official_no_of_new_drug_licenses_issued;
        $addActivity->official_no_of_drug_licenses_calncelled           = $request->official_no_of_drug_licenses_calncelled;
        $addActivity->official_no_of_drug_licenses_transfer_in          = $request->official_no_of_drug_licenses_transfer_in;
        $addActivity->official_no_of_drug_licenses_transfer_out         = $request->official_no_of_drug_licenses_transfer_out;
        $addActivity->official_total_no_of_drug_licenses                = $request->official_total_no_of_drug_licenses;
        $addActivity->official_no_of_drug_license_renewed               = $request->official_no_of_drug_license_renewed;
        $addActivity->official_no_of_drug_license_ownership_transferred = $request->official_no_of_drug_license_ownership_transferred;
        $addActivity->official_no_of_drug_license_address_changed       = $request->official_no_of_drug_license_address_changed;
        $addActivity->official_total_revenue_receipt                    = $request->official_total_revenue_receipt;
        $addActivity->official_no_of_sample_sent                        = $request->official_no_of_sample_sent;
        $addActivity->official_no_of_test_report_received               = $request->official_no_of_test_report_received;
        $addActivity->official_no_of_substandard_drugs                  = $request->official_no_of_substandard_drugs;
        $addActivity->official_description_of_substandard_drugs         = $request->official_description_of_substandard_drugs;
        $addActivity->official_others                                   = $request->official_others;
        $addActivity->official_sealed                                   = $request->official_sealed;
        $addActivity->lat                                               = $request->latitude;
        $addActivity->long                                              = $request->longitude;
        $addActivity->created_at                                        = now();

        $addActivity->save();

        return redirect()->action('HomeController@entryDailyActivity')->with('success', "Data has been added successfully added!");
    }

    public function show(DailyActivity $dailyActivity)
    {}

    public function edit(DailyActivity $dailyActivity)
    {}

    public function update(Request $request, DailyActivity $dailyActivity)
    {}

    public function destroy(DailyActivity $dailyActivity)
    {}
}
