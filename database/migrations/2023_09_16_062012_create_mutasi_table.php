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
        Schema::create('mutasi', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_mutasi', 20)->nullable();
            $table->string('alamat_baru')->nullable();
            $table->string('status_mutasi', 20)->nullable();
            $table->string('user_action', 30)->nullable();
            $table->date('tgl_action')->nullable();
            $table->integer('biaya')->default(0);
            $table->integer('diskon')->default(0);
            $table->integer('bayar')->default(0);
            $table->string('lunas', 11)->default('Belum Lunas');
            $table->string('keterangan', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi');
    }
};
