<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_rates', function (Blueprint $table) {
            $table->id();
            $table->double('degree');
            
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
              ->references('id')
              ->on('courses')
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
              ->references('id')
              ->on('students')
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
        Schema::dropIfExists('course_rates');
    }
}
