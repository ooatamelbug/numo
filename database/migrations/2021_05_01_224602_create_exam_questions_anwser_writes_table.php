<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamQuestionsAnwserWritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_questions_anwser_writes', function (Blueprint $table) {
            $table->id();
            $table->integer('anwser_number');
            $table->string('anwser')->nullable();
            $table->unsignedBigInteger('exam_enter_id');
            $table->foreign('exam_enter_id')
                ->references('id')
                ->on('exam_enters')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('exam_question_id');
            $table->foreign('exam_question_id')
                ->references('id')
                ->on('exam_questions')
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
        Schema::dropIfExists('exam_questions_anwser_writes');
    }
}
