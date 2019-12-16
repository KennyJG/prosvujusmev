<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationStatusRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservation_status_records', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('reservation_id');
            $table->string('old_status')->nullable();
            $table->string('new_status');
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
        Schema::dropIfExists('reservation_status_records');
    }
}
