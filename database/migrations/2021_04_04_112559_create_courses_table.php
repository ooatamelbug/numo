<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('title_slug')->unique();
            $table->tinyInteger('status')->default('0');
            $table->string('image');
            $table->double('price');
            $table->string('discount')->nullable();
            $table->string('desc')->nullable();
            $table->double('rate');
            $table->unsignedBigInteger('categories_id');
            $table->foreign('categories_id')
              ->references('id')
              ->on('categories')
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->unsignedBigInteger('admin_id');
            $table->foreign('admin_id')
              ->references('id')
              ->on('admins')
              ->onUpdate('cascade')
              ->onDelete('cascade');
            $table->unsignedBigInteger('teacher_id');
            $table->foreign('teacher_id')
                ->references('id')
                ->on('teachers')
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
        Schema::dropIfExists('courses');
    }
}
