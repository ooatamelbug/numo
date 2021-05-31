<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnairesQuestionsChoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires_questions_choices', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->tinyInteger('status')->default('1');
            $table->unsignedBigInteger('questionnaires_q_id');
            $table->foreign('questionnaires_q_id')
                ->references('id')
                ->on('questionnaires_questions')
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
        Schema::dropIfExists('questionnaires_questions_choices');
    }
}