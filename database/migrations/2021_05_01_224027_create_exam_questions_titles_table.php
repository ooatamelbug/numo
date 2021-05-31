<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamQuestionsTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_questions_titles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('status')->default('1');
            $table->integer('question_number');
            $table->unsignedBigInteger('exam_questions_type_id');
            $table->foreign('exam_questions_type_id')
                ->references('id')
                ->on('exam_questions_types')
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
        Schema::dropIfExists('exam_questions_titles');
    }
}
