<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateListItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('list_items');
        Schema::create('list_items', function (Blueprint $table) {
            $table->string('id_item')->primary();
            $table->string('description')->nullable();
            $table->string('references')->nullable();
            $table->string('amount')->nullable();
            $table->string('budget_available')->nullable();
            $table->string('quantity')->nullable();
            $table->string('unit_of_measurement')->nullable();
            $table->string('estimated_unit_price')->nullable();
            $table->string('project')->nullable();
            $table->string('account_code')->nullable();
            $table->string('settlement')->nullable();
            $table->string('settlement_amount')->nullable();
            $table->string('id_request');
            $table->foreign('id_request')->references('id_request')->on('payment_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('list_items');
    }
}
