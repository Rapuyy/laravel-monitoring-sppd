<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pp', function (Blueprint $table) {
            $table->id();

            $table->string('pp_no')->nullable();
            $table->date('pp_tgl_dibuat')->nullable();
            $table->date('pp_tgl_diajukan')->nullable();
            $table->date('pp_tgl_approval')->nullable();
            $table->date('pp_tgl_msk_finance')->nullable();
            $table->date('pp_tgl_selesai')->nullable();
            $table->integer('pp_status')->nullable();


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
        Schema::dropIfExists('pp');
    }
}
