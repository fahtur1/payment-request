<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staff', function (Blueprint $table) {
            $table->string('id_staff')->primary();
            $table->string('nama_staff');
            $table->string('email_staff');
            $table->string('tanggal_lahir');
            $table->string('tanggal_masuk');
            $table->string('password');
            $table->string('amount_pr_requested')->nullable();
            $table->foreignId('id_role')->references('id_role')->on('role');
            $table->foreignId('id_position')->references('id_position')->on('position');
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
        Schema::dropIfExists('staff');
    }
}
