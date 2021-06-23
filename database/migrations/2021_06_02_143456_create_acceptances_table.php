<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcceptancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('acceptances');
        Schema::create('acceptances', function (Blueprint $table) {
            $table->string('id_acceptance')->primary();
            $table->string('id_staff');
            $table->foreign('id_staff')->references('id_staff')->on('staff');
            $table->string('id_request');
            $table->foreign('id_request')->references('id_request')->on('payment_requests');
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
        Schema::dropIfExists('acceptances');
    }
}
