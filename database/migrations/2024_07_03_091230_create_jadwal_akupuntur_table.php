<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('jadwal_akupuntur', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_kartu_pasien', 25);
            $table->foreign('nomor_kartu_pasien')->references('id')->on('pasien')->onDelete('cascade')->onUpdate('cascade');
            $table->date('tanggal_melakukan_terapi');
            $table->text('keluhan')->nullable();
            $table->string('jam_pelayanan', 5);
            $table->enum('status', ['Selesai', 'Reschedule', 'Batal', 'Belum Dilayani']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jadwal_akupuntur');
    }
};
