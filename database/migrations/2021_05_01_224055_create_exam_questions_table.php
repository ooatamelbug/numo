<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_questions', function (Blueprint $table) {
            $table->id();
            $table->longText('body');
            $table->tinyInteger('status')->default('1');
            $table->string('type');
            $table->integer('number_of_question');
            $table->unsignedBigInteger('exam_questions_title_id');
            $table->foreign('exam_questions_title_id')
                ->references('id')
                ->on('exam_questions_titles')
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
        Schema::dropIfExists('exam_questions');
    }
}
