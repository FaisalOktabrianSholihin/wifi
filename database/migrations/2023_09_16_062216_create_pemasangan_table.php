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
        Schema::create('pemasangan', function (Blueprint $table) {
            $table->id();
            $table->string('no_pendaftaran', 20)->nullable();
            $table->string('nama')->nullable();
            $table->string('nik', 16)->nullable();
            $table->text('alamat')->nullable();
            $table->string('telepon', 20)->nullable();
            $table->string('status_survey', 20)->nullable();
            $table->string('user_survey', 20)->nullable();
            $table->string('user_action', 30)->nullable();
            $table->date('tgl_action')->nullable();
            $table->integer('biaya')->nullable()->default(0);
            $table->integer('diskon')->default(0)->nullable();
            $table->integer('bayar')->default(0)->nullable();
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
        Schema::dropIfExists('pemasangan');
    }
};
