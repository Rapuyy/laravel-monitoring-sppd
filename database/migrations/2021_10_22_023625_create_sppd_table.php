<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSppdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sppd', function (Blueprint $table) {
            $table->id();
            $table->string('sppd_no');
            $table->string('ipa_no')->nullable();
            $table->string('pp_no')->nullable();
            $table->string('sppd_tujuan');
            $table->string('sppd_alasan');
            $table->string('sppd_kendaraan');
            $table->string('keterangan')->nullable();
            $table->integer('status')->default(0);
            $table->date('tgl_berangkat');
            $table->date('tgl_pulang');
            $table->date('ipa_tgl_dibuat')->nullable();
            $table->date('ipa_tgl_approval')->nullable();
            $table->date('ipa_tgl_selesai')->nullable();
            $table->date('pp_tgl_dibuat')->nullable();
            $table->date('pp_tgl_approval')->nullable();
            $table->date('pp_tgl_selesai')->nullable();
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
        Schema::dropIfExists('sppd');
    }
}
