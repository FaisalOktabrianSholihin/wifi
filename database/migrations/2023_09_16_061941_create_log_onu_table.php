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
        Schema::create('log_onu', function (Blueprint $table) {
            $table->id();
            $table->string('no_pelanggan', 20)->nullable();
            $table->integer('vlan')->nullable();
            $table->integer('slot')->nullable();
            $table->integer('port')->nullable();
            $table->integer('index_inc')->nullable();
            $table->string('sn', 12)->nullable();
            $table->string('type_act', 30)->nullable();
            $table->string('user_act', 50)->nullable();
            $table->timestamp('time_act');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('log_onu');
    }
};
