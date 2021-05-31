<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('password');
            $table->string('last_name');
            $table->string('email')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('face_id')->unique()->nullable();
            $table->string('google_id')->unique()->nullable();
            $table->string('apple_id')->unique()->nullable();
            $table->string('image')->nullable();
            $table->string('imagecertificated')->nullable();
            $table->string('imagenationalid')->nullable();
            $table->tinyInteger('status')->default('0');
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
        Schema::dropIfExists('students');
    }
}
