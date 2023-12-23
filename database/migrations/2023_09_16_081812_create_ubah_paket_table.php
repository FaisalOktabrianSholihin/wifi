<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ubah_paket', function (Blueprint $table) {
            $table->id();
            $table->string('paket_lama', 50)->nullable();
            $table->string('paket_baru', 50)->nullable();
            $table->string('user_action', 30)->nullable();
            $table->date('tgl_action')->nullable();
            $table->integer('biaya')->default(0);
            $table->integer('diskon')->default(0);
            $table->integer('bayar')->default(0);
            $table->string('lunas', 11)->nullable();
            $table->string('keterangan', 100)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ubah_paket');
    }
};
