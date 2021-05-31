<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesDetailsUnitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses_details_unites', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->integer('ranged');
            $table->longText('desc');
            $table->string('image');
            $table->string('total_time');
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
        Schema::dropIfExists('courses_details_unites');
    }
}
