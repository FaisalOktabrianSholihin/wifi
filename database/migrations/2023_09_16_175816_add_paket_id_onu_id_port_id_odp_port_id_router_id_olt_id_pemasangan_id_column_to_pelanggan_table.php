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
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->unsignedBigInteger('paket_id')->after('cara_bayar');
            $table->unsignedBigInteger('onu_id')->after('paket_id');
            $table->unsignedBigInteger('port_id')->after('onu_id');
            $table->unsignedBigInteger('odp_port_id')->after('port_id');
            $table->unsignedBigInteger('router_id')->after('odp_port_id');
            $table->unsignedBigInteger('olt_id')->after('router_id');
            $table->unsignedBigInteger('pemasangan_id')->after('olt_id');
            $table->foreign('paket_id')->references('id')->on('paket')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('onu_id')->references('id')->on('onu')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('port_id')->references('id')->on('port')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('odp_port_id')->references('id')->on('odp_port')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('router_id')->references('id')->on('routers')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('olt_id')->references('id')->on('olt')->onDelete('restrict')->onUpdate('restrict');
            $table->foreign('pemasangan_id')->references('id')->on('pemasangan')->onDelete('restrict')->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pelanggan', function (Blueprint $table) {
            $table->dropForeign(['paket_id']);
            $table->dropColumn('paket_id');
            $table->dropForeign(['onu_id']);
            $table->dropColumn('onu_id');
            $table->dropForeign(['port_id']);
            $table->dropColumn('port_id');
            $table->dropForeign(['odp_port_id']);
            $table->dropColumn('odp_port_id');
            $table->dropForeign(['router_id']);
            $table->dropColumn('router_id');
            $table->dropForeign(['olt_id']);
            $table->dropColumn('olt_id');
            $table->dropForeign(['pemasangan_id']);
            $table->dropColumn('pemasangan_id');
        });
    }
};
