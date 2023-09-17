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
        Schema::create('transaksi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_pelanggan', 100)->nullable();
            $table->string('action', 20)->nullable();
            $table->date('periode')->nullable();
            $table->date('tgl_transaksi')->nullable();
            $table->date('tgl_isolir')->nullable();
            $table->string('user_action', 20)->nullable();
            $table->date('tgl_action')->nullable();
            $table->string('paket', 30)->nullable();
            $table->integer('iuran')->default(0);
            $table->integer('instalasi')->default(0);
            $table->integer('ubah_paket')->default(0);
            $table->integer('diskon')->default(0);
            $table->integer('bayar')->default(0);
            $table->string('status_lunas', 5)->nullable();
            $table->text('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksi');
    }
};
