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
        Schema::create('pasien', function (Blueprint $table) {
            $table->string('id', 25)->primary();
            $table->string('nama');
            $table->date('tanggal_lahir')->nullable(); // Assuming 'Tanggal Lahir' is optional
            $table->enum('gender', ['Pria', 'Wanita']); // Assuming 'Gender' is a predefined list
            $table->string('pekerjaan', 30)->nullable(); // Assuming 'Pekerjaan' refers to a string field for the job title
            $table->string('nomor_telepon', 20)->nullable(); // Assuming 'Nomor Telepon' refers to a string field for the phone number
            $table->boolean('sedang_melakukan_pengobatan')->default(false)->nullable(); // Assuming 'Sedang melakukan pengobatan/tidak?' is a boolean indicating treatment status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pasien');
    }
};
