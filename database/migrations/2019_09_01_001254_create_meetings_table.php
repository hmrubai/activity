<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meetings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('chairperson')->nullable();
            $table->string('date_time')->nullable();
            $table->string('vanue')->nullable();
            $table->string('minutes_taken_by')->nullable();
            $table->string('minutes_reviewed_by')->nullable();
            $table->string('attendees')->nullable();
            $table->string('apologies')->nullable();
            $table->string('discussions')->nullable();
            $table->string('distributions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meetings');
    }
}
