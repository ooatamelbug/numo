<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMeetingOnlineCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_online_courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('password')->nullable();
            $table->string('join_url')->nullable();
            $table->string('start_url')->nullable();
            $table->dateTime('start_at')->nullable();
            $table->tinyInteger('status')->default('0');
            $table->unsignedBigInteger('course_id');
            $table->foreign('course_id')
              ->references('id')
              ->on('courses')
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->unsignedBigInteger('unit_id');
              $table->foreign('unit_id')
                ->references('id')
                ->on('courses_details_unites')
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
        Schema::dropIfExists('meeting_online_courses');
    }
}
