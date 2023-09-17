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
        Schema::create('odp', function (Blueprint $table) {
            $table->id();
            $table->string('odp', 50)->nullable();
            $table->string('kode_odp', 10)->nullable()->unique();
            $table->integer('jumlah_port')->nullable();
            $table->string('ket_odp')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odp');
    }
};
