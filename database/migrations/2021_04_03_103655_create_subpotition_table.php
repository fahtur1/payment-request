<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubpotitionTable extends Migration
{
    /**
     * Run the migrations.
     *
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('subposition');
        Schema::create('subposition', function (Blueprint $table) {
            $table->id('id_subposition');
            $table->string('nama_subposition');
            $table->boolean('allowed_to_accept_request');
            $table->boolean('allowed_to_input_donator');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('subposition');
    }
}
