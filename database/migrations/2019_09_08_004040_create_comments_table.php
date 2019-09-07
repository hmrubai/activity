<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('details')->nullable();
            $table->string('comment_date')->nullable();
            $table->unsignedBigInteger('post_id')->nullable();
            $table->unsignedBigInteger('commented_by')->nullable();
            $table->timestamps();
        });

        Schema::table('comments', function(Blueprint $table){
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('commented_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
