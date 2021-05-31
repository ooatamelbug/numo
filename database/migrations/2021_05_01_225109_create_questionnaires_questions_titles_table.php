<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnairesQuestionsTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires_questions_titles', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('status')->default('1');
            $table->integer('question_number');
            $table->unsignedBigInteger('questionnaires_q_type_id');
            $table->foreign('questionnaires_q_type_id')
                ->references('id')
                ->on('questionnaires_questions_types')
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
        Schema::dropIfExists('questionnaires_questions_titles');
    }
}
