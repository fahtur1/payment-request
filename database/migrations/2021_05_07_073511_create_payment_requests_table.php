<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('payment_requests');
        Schema::create('payment_requests', function (Blueprint $table) {
            $table->string('id_request')->primary();
            $table->string('id_staff');
            $table->foreign('id_staff')->references('id_staff')->on('staff');
            $table->string('tanggal_pengajuan');
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payment_requests');
    }
}
