<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_kegiatan');
            $table->string('tema_kegiatan');
            $table->date('tanggal');
            $table->string('waktu');
            $table->string('tempat');
            $table->text('struktur_panitia');
            $table->integer('jumlah_peserta');
            $table->integer('dana_masuk');
            $table->integer('dana_keluar');
            $table->foreignId('anggota_id')->constrained();
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
        Schema::dropIfExists('kegiatans');
    }
};
