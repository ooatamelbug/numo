<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermisionsTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permisions_teachers', function (Blueprint $table) {
            $table->id();
            $table->string('role');
            $table->unsignedBigInteger('permision_id');
            $table->foreign('permision_id')
              ->references('id')
              ->on('permisions')
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->unsignedBigInteger('actived_by_id');
            $table->foreign('actived_by_id')
              ->references('id')
              ->on('admins')
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
        Schema::dropIfExists('permisions_teachers');
    }
}
