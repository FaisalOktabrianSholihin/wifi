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
        Schema::table('plan', function (Blueprint $table) {
            $table->unsignedBigInteger('ip_pool_id')->after('plan');
            $table->unsignedBigInteger('limit_id')->after('ip_pool_id');
            $table->unsignedBigInteger('paket_id')->after('router_id');
            $table->foreign('ip_pool_id')->references('id')->on('ip_pool')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('limit_id')->references('id')->on('limit_bw')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('paket_id')->references('id')->on('paket')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plan', function (Blueprint $table) {
            $table->dropForeign(['ip_pool_id']);
            $table->dropColumn('ip_pool_id');
            $table->dropForeign(['limit_id']);
            $table->dropColumn('limit_id');
            $table->dropForeign(['paket_id']);
            $table->dropColumn('paket_id');
        });
    }
};
