<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('position');
        Schema::create('position', function (Blueprint $table) {
            $table->id('id_position');
            $table->string('nama_position');
            $table->string('is_active');
            $table->foreignId('id_subposition')->references('id_subposition')->on('subposition');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('position');
    }
}
