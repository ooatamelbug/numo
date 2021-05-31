<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_details', function (Blueprint $table) {
            $table->id();
            $table->integer('units');
            $table->string('total_time');
            $table->longText('desc');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
              ->references('id')
              ->on('courses')
              ->onUpdate('cascade')
              ->onDelete('cascade');
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
        Schema::dropIfExists('courses_details');
    }
}
