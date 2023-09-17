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
        Schema::create('ip_pool', function (Blueprint $table) {
            $table->id();
            $table->string('pool', 50)->unique()->nullable();
            $table->string('ip_range', 100)->nullable();
            $table->integer('router_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ip_pool');
    }
};
