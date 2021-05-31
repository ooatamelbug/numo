<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnairesQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires_questions', function (Blueprint $table) {
            $table->id();
            $table->longText('body');
            $table->string('type');
            $table->tinyInteger('status')->default('1');
            $table->integer('number_of_question');
            $table->unsignedBigInteger('questionnaires_q_title_id');
            $table->foreign('questionnaires_q_title_id')
                ->references('id')
                ->on('questionnaires_questions_titles')
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
        Schema::dropIfExists('questionnaires_questions');
    }
}
