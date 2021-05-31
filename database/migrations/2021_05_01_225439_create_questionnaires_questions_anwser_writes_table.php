<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnairesQuestionsAnwserWritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires_questions_anwser_writes', function (Blueprint $table) {
            $table->id();
            $table->integer('anwser_number');
            $table->string('anwser')->nullable();
            $table->unsignedBigInteger('qnaires_e_id');
            $table->foreign('qnaires_e_id')
                ->references('id')
                ->on('questionnaires_enters')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->unsignedBigInteger('qnaires_q_id');
            $table->foreign('qnaires_q_id')
                ->references('id')
                ->on('questionnaires_questions')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')
                ->references('id')
                ->on('students')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('questionnaire_id');
            $table->foreign('questionnaire_id')
                ->references('id')
                ->on('questionnaires')
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
        Schema::dropIfExists('questionnaires_questions_anwser_writes');
    }
}
