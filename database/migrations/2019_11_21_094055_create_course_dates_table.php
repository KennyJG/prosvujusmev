<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseDatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('course_dates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('course_id');
            $table->date('from_date');
            $table->date('to_date');
            $table->string('venue');
            $table->unsignedInteger('limit');
            $table->string('lecturer')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('course_dates');
    }
}
