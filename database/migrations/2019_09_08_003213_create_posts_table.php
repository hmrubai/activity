<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title')->nullable();
            $table->longText('details')->nullable();
            $table->string('category')->nullable();
            $table->enum('status', ['PENDING', 'PUBLISHED', 'REMOVED'])->default('PENDING');
            $table->string('attachment')->nullable();
            $table->string('post_date')->nullable();
            $table->unsignedBigInteger('posted_by')->nullable();
            $table->timestamps();
        });

        Schema::table('posts', function(Blueprint $table){
            $table->foreign('posted_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
