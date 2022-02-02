<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIpaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ipa', function (Blueprint $table) {
            $table->id();
            
            $table->string('ipa_no')->nullable();
            $table->string('ipa_nilai')->nullable();
            $table->string('sumber_dana')->nullable();
            $table->date('ipa_tgl_dibuat')->nullable();
            $table->date('ipa_tgl_diajukan')->nullable();
            $table->date('ipa_tgl_approval')->nullable();
            $table->date('ipa_tgl_msk_finance')->nullable();
            $table->date('ipa_tgl_selesai')->nullable();
            $table->integer('ipa_status')->nullable();


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
        Schema::dropIfExists('ipa');
    }
}
