<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionnairesFinishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questionnaires_finishes', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('status')->default('1');
            $table->unsignedBigInteger('questionnaires_enter_id');
            $table->foreign('questionnaires_enter_id')
              ->references('id')
              ->on('questionnaires_enters')
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
        Schema::dropIfExists('questionnaires_finishes');
    }
}
