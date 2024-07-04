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
        Schema::create('users', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('nama');
            $table->date('tanggal_lahir'); // Assuming 'Tanggal Lahir' is optional
            $table->enum('gender', ['Pria', 'Wanita']); // Assuming 'Gender' is a predefined list
            $table->string('pekerjaan'); // Assuming 'Pekerjaan' refers to a string field for the job title
            $table->string('nomor_telepon'); // Assuming 'Nomor Telepon' refers to a string field for the phone number
            $table->boolean('sedang_melakukan_pengobatan')->default(false); // Assuming 'Sedang melakukan pengobatan/tidak?' is a boolean indicating treatment status
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
