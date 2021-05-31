<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamFinialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_finials', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default('0');
            $table->double('degree');
            $table->unsignedBigInteger('exam_enter_id');
            $table->foreign('exam_enter_id')
              ->references('id')
              ->on('exam_enters')
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
              ->references('id')
              ->on('students')
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->unsignedBigInteger('exam_id');
            $table->foreign('exam_id')
              ->references('id')
              ->on('exams')
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
        Schema::dropIfExists('exam_finials');
    }
}
