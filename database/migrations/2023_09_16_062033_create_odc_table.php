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
        Schema::create('odc', function (Blueprint $table) {
            $table->id();
            $table->string('odc',50)->nullable();
            $table->string('kode_odc',10)->nullable()->unique();
            $table->integer('vlan')->nullable();
            $table->string('ket_odc')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('odc');
    }
};
