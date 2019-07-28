<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDailyActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('daily_activities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('visited_area');
            $table->string('no_of_visited_pharmacy')->nullable();
            $table->string('no_of_depot')->nullable();
            $table->string('no_of_identified_pharmacy_without_license')->nullable();
            $table->string('no_of_identified_not_renewed_license')->nullable();
            $table->string('no_of_sample_collected')->nullable();
            $table->binary('unregistered_drug')->nullable();
            $table->string('unregistered_drug_name')->nullable();
            $table->binary('misbranded_drug')->nullable();
            $table->binary('government_medicine')->nullable();
            $table->binary('physician_sample')->nullable();
            $table->binary('food_supplement')->nullable();
            $table->binary('expired_medicine')->nullable();
            $table->binary('imitated_medicine')->nullable();
            $table->binary('spurious_drug')->nullable();
            $table->binary('seized_medicine_others')->nullable();
            $table->string('seized_medicine_others_name')->nullable();
            $table->string('name_of_the_visited_pharmaceutical_company')->nullable();
            $table->string('no_of_the_visited_pharmaceutical_company')->nullable();
            $table->string('approved_model_pharmacy')->nullable();
            $table->string('approved_medicine_shop')->nullable();
            $table->string('no_of_pharmacy_completely_ready_to_be_approved_as_model_pharmacy')->nullable();
            $table->string('no_of_pharmacy_completely_ready_to_be_approved_as_medicine_shop')->nullable();
            $table->string('value_of_seized_medicine')->nullable();
            $table->string('enforcement_information')->nullable();
            $table->string('mobile_court_company_name_address')->nullable();
            $table->string('mobile_court_pharmacy_name_address')->nullable();
            $table->string('mobile_court_no_of_cases_filed')->nullable();
            $table->string('mobile_court_no_of_convicted_person')->nullable();
            $table->string('mobile_court_fine_amount')->nullable();
            $table->string('mobile_court_jail')->nullable();
            $table->string('mobile_court_value_of_seized_medicine')->nullable();
            $table->string('mobile_court_case_paper')->nullable();
            $table->string('magistrate_court_company_name_address')->nullable();
            $table->string('magistrate_court_no_of_case_filed')->nullable();
            $table->string('magistrate_court_case_no')->nullable();
            $table->string('magistrate_court_case_paper')->nullable();
            $table->string('drug_court_company_name_address')->nullable();
            $table->string('drug_court_pharmacy_name_address')->nullable();
            $table->binary('drug_court_substandard_drug')->nullable();
            $table->binary('drug_court_unregistered_drug')->nullable();
            $table->binary('drug_court_govt_medicine')->nullable();
            $table->binary('drug_court_adulterated_spurious_misbranded')->nullable();
            $table->binary('drug_court_unauthorized_raw_material')->nullable();
            $table->binary('drug_court_over_pricing')->nullable();
            $table->binary('drug_court_illegal_advertisement')->nullable();
            $table->binary('drug_court_not_registered')->nullable();
            $table->binary('drug_court_others')->nullable();
            $table->string('drug_court_description')->nullable();
            $table->string('drug_court_no_of_case_filed')->nullable();
            $table->string('drug_court_case_no_with_date')->nullable();
            $table->string('drug_court_case_paper')->nullable();
            $table->string('official_no_of_new_drug_licenses_issued')->nullable();
            $table->string('official_no_of_drug_licenses_calncelled')->nullable();
            $table->string('official_no_of_drug_licenses_transfer_in')->nullable();
            $table->string('official_no_of_drug_licenses_transfer_out')->nullable();
            $table->string('official_total_no_of_drug_licenses')->nullable();
            $table->string('official_no_of_drug_license_renewed')->nullable();
            $table->string('official_no_of_drug_license_ownership_transferred')->nullable();
            $table->string('official_no_of_drug_license_address_changed')->nullable();
            $table->string('official_total_revenue_receipt')->nullable();
            $table->string('official_no_of_sample_sent')->nullable();
            $table->string('official_no_of_test_report_received')->nullable();
            $table->string('official_no_of_substandard_drugs')->nullable();
            $table->string('official_description_of_substandard_drugs')->nullable();
            $table->string('official_others')->nullable();
            $table->string('official_sealed')->nullable();
            $table->timestamps();
        });

        Schema::table('daily_activities', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('daily_activities');
    }
}
