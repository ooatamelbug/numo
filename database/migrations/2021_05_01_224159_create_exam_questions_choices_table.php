<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamQuestionsChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_questions_choices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('anwser')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->unsignedBigInteger('exam_question_id');
            $table->foreign('exam_question_id')
                ->references('id')
                ->on('exam_questions')
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
        Schema::dropIfExists('exam_questions_choices');
    }
}
