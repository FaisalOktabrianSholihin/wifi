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
        Schema::create('pelanggan', function (Blueprint $table) {
            $table->id();
            $table->string('no_pelanggan', 20)->unique()->nullable();
            $table->string('nama')->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('username_pppoe', 10)->nullable();
            $table->string('password_pppoe', 10)->nullable();
            $table->date('tgl_pasang')->nullable();
            $table->date('tgl_isolir')->nullable();
            $table->string('status_aktif', 20)->nullable();
            $table->string('aktivasi_router', 20)->nullable();
            $table->string('aktivasi_olt', 20)->nullable();
            $table->string('cara_bayar', 20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelanggan');
    }
};
